<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MuseumController extends Controller
{
    /**
     * Halaman Utama Peta Persebaran (GIS).
     */
    public function index()
    {
        // Kita hanya return view, datanya nanti diambil via AJAX (mapData)
        // agar loading peta tidak memberatkan halaman awal.
        return view('museums.index');
    }

    /**
     * API untuk mengirim data JSON ke Peta (Leaflet/Google Maps).
     * Dipanggil via AJAX oleh Frontend.
     */
    public function mapData()
    {
        // Ambil semua data museum
        $museums = Museum::all();

        // Kita format ulang datanya agar sesuai dengan keinginan Javascript
        $data = $museums->map(function ($museum) {
            return [
                'id' => $museum->id,
                'name' => $museum->name,
                'type' => $museum->type, // MUSEUM, SITUS, SANGGAR
                'photo' => $museum->photo_url,

                // MAPPING PENTING:
                // Javascript minta 'lat', Database punya 'latitude'
                'lat' => (float) $museum->latitude,

                // Javascript minta 'lng', Database punya 'longitude'
                'lng' => (float) $museum->longitude,

                // HAPUS baris 'popup_content' yang menyebabkan error 500!
            ];
        });

        return response()->json($data);
    }

    /**
     * Menampilkan Detail Museum & Koleksi di dalamnya.
     */
    public function show($id)
    {
        // Eager load artifacts yang sudah diapprove saja
        $museum = Museum::with(['artifacts' => function ($query) {
            $query->verified()->latest();
        }])->findOrFail($id);

        return view('museums.show', compact('museum'));
    }

    /**
     * Form Tambah Museum (Hanya Admin).
     */
    public function store(Request $request)
    {
        // Validasi Admin (Bisa via Middleware nanti)
        // if (!auth()->user()->isAdmin()) abort(403);

        $request->validate([
            'name' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photo' => 'image|max:2048',
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('museums', 'public');
            $photoUrl = asset('storage/' . $path);
        }

        Museum::create([
            'name' => $request->name,
            'type' => $request->type ?? 'MUSEUM',
            'description' => $request->description,
            'address' => $request->address,
            'district' => $request->district,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'photo_url' => $photoUrl,
            // Meta data json
            'meta' => [
                'jam_buka' => $request->jam_buka,
                'tiket' => $request->tiket
            ]
        ]);

        return back()->with('success', 'Lokasi berhasil ditambahkan ke Peta!');
    }
}
