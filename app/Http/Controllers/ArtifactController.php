<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use App\Models\Museum;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ArtifactController extends Controller
{
    // --- HALAMAN UTAMA ---

   public function index(Request $request)
{
    // Jika ini route 'home' (/) dan user BELUM login → tampilkan landing page
    if (!Auth::check() && $request->routeIs('home')) {
        return view('landing.home');
    }

    // Kalau sudah login ATAU route /artifacts → tampilkan galeri koleksi
    $query = Artifact::verified()->with(['user', 'museum']);

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $artifacts = $query->latest()->paginate(12);
    $artifacts->appends($request->all());

    return view('artifacts.index', compact('artifacts'));
}


    public function create()
    {
        $museums = Museum::all();
        $tags = Tag::all();
        return view('artifacts.create', compact('museums', 'tags'));
    }

    // --- LOGIKA SIMPAN & API TRIPO (ADAPTASI DARI KODE ANDA) ---

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:BENDA,TAK_BENDA,SITUS',
            'museum_id' => 'nullable|exists:museums,id',
            'image' => 'required_if:category,BENDA|image|max:10240', // Max 10MB (Sesuai kode Anda)
            'audio' => 'required_if:category,TAK_BENDA|mimes:mp3,wav,m4a|max:20480',
        ]);

        return DB::transaction(function () use ($request) {

            // 2. Simpan File Fisik
            $imagePath = null;
            $publicImageUrl = null; // Untuk dikirim ke Tripo

            if ($request->hasFile('image')) {
                // Simpan ke 'public/uploads' agar bisa diakses URL-nya (Sesuai strategi Mesh3DController)
                $imagePath = $request->file('image')->store('uploads/artifacts', 'public');
                $publicImageUrl = asset('storage/' . $imagePath);
            }

            $audioPath = null;
            if ($request->hasFile('audio')) {
                $audioPath = $request->file('audio')->store('uploads/audio', 'public');
            }

            // 3. Simpan ke Database
            $artifact = Artifact::create([
                'user_id' => Auth::id(),
                // 'user_id' => Auth::id() ?? 1,
                'museum_id' => $request->museum_id,
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'material' => $request->material,
                'function' => $request->function,
                'origin_region' => $request->origin_region,
                'image_path' => $imagePath,
                'audio_path' => $audioPath,
                'curation_status' => 'PENDING',
                'ai_status' => 'PENDING',
            ]);

            // 4. Simpan Tags
            if ($request->has('tags')) {
                $artifact->tags()->attach($request->tags);
            }

            // 5. TEMBAK API TRIPO (LOGIKA DARI KODE ANDA)
            if ($request->category === 'BENDA' && $request->hasFile('image')) {

                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                if ($extension == 'jpeg') $extension = 'jpg'; // Trik Jitu Anda

                // Kirim request ke Tripo
                try {
                    $apiKey = config('services.tripo.api_key') ?? env('TRIPO_API_KEY');

                    $response = Http::withToken($apiKey)->post('https://api.tripo3d.ai/v2/openapi/task', [
                        'type' => 'image_to_model',
                        'file' => [
                            'type' => $extension,
                            'url' => $publicImageUrl // URL Publik localhost/ngrok
                        ]
                    ]);

                    if ($response->successful()) {
                        $taskId = $response->json()['data']['task_id'];

                        // Update Artifact dengan Task ID
                        $artifact->update([
                            'tripo_task_id' => $taskId,
                            'ai_status' => 'PROCESSING'
                        ]);
                    } else {
                        Log::error('Tripo Fail: ' . $response->body());
                        // Jangan gagalkan upload, cukup set status FAILED
                        $artifact->update(['ai_status' => 'FAILED']);
                    }
                } catch (\Exception $e) {
                    Log::error('Tripo Exception: ' . $e->getMessage());
                    $artifact->update(['ai_status' => 'FAILED']);
                }
            }

            return redirect()->route('artifacts.index')
                ->with('success', 'Data berhasil disimpan! Cek status 3D beberapa saat lagi.');
        });
    }

    // --- FUNGSI CEK STATUS (POLLING DARI JS) ---
    // Dipanggil via AJAX: /artifacts/check-status/{id}
    public function checkStatus($id)
    {
        $artifact = Artifact::findOrFail($id);

        // Jika sudah sukses di DB, langsung return (Hemat API Call)
        if ($artifact->ai_status === 'SUCCESS' && $artifact->model_path) {
            return response()->json([
                'data' => [
                    'status' => 'SUCCESS',
                    'progress' => 100,
                    'model_url' => $artifact->model_path
                ]
            ]);
        }

        // Jika tidak ada Task ID (Bukan kategori BENDA atau Gagal Awal)
        if (!$artifact->tripo_task_id) {
            return response()->json(['data' => ['status' => 'FAILED', 'error' => 'No Task ID']]);
        }

        // TEMBAK API TRIPO (Cek Status Realtime)
        try {
            $apiKey = config('services.tripo.api_key') ?? env('TRIPO_API_KEY');

            $response = Http::withoutVerifying() // Penting untuk localhost
                ->withToken($apiKey)
                ->timeout(10)
                ->get("https://api.tripo3d.ai/v2/openapi/task/{$artifact->tripo_task_id}");

            if ($response->failed()) {
                return response()->json(['data' => ['status' => 'RUNNING']]); // Asumsikan running kalau error network
            }

            $data = $response->json();
            $tripoStatus = $data['data']['status']; // 'running', 'success', 'failed'

            // Jika SUKSES, Simpan URL Permanen ke Database
            if ($tripoStatus === 'success') {
                $modelUrl = $data['data']['output']['model']; // Link .glb dari Tripo

                $artifact->update([
                    'ai_status' => 'SUCCESS',
                    'model_path' => $modelUrl // Simpan link AWS S3 Tripo
                ]);

                return response()->json([
                    'data' => [
                        'status' => 'SUCCESS',
                        'progress' => 100,
                        'model_url' => $modelUrl
                    ]
                ]);
            }

            // Jika GAGAL
            elseif ($tripoStatus === 'failed') {
                $artifact->update(['ai_status' => 'FAILED']);
                return response()->json(['data' => ['status' => 'FAILED']]);
            }

            // Jika MASIH PROSES
            return response()->json(['data' => [
                'status' => 'RUNNING',
                'progress' => $data['data']['progress'] ?? 50
            ]]);
        } catch (\Exception $e) {
            return response()->json(['data' => ['status' => 'RUNNING']]);
        }
    }

    // --- FUNGSI PROXY (WAJIB ADA UNTUK 3D VIEWER) ---
    // Dipanggil di tag <model-viewer src="/artifacts/proxy?url=...">
    public function proxyModel(Request $request)
    {
        $url = $request->query('url');
        if (!$url) return response()->json(['error' => 'URL missing'], 400);

        try {
            $fileContent = Http::withoutVerifying()->get($url)->body();
            return response($fileContent)
                ->header('Content-Type', 'model/gltf-binary')
                ->header('Access-Control-Allow-Origin', '*');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Proxy Fail'], 500);
        }
    }

    // --- HALAMAN DETAIL ---
    public function show($id)
    {
        $artifact = Artifact::with(['user', 'museum', 'tags'])->findOrFail($id);
        return view('artifacts.show', compact('artifact'));
    }

    /**
     * Halaman 'Arsip Saya' untuk User Biasa.
     * Menampilkan status upload (Pending, Approved, Rejected, AI Status).
     */
    public function myArtifacts()
    {
        // Ambil data milik user yang sedang login (Auth::id())
        // Urutkan dari yang terbaru
        $myArtifacts = Artifact::where('user_id', Auth::id()) // Pastikan ID 1 jika pakai dummy
            ->with('museum')
            ->latest()
            ->paginate(10);

        return view('dashboard.user', compact('myArtifacts'));
    }
}
