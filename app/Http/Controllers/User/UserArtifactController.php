<?php

namespace App\Http\Controllers\User;

use App\Models\Artifact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserArtifactController extends Controller
{
     // sementara: pakai user_id 1 sebagai pemilik semua artefak
    private int $demoUserId = 1;

    public function index()
    {
        // bisa juga diganti ->latest()->paginate(10) kalau mau semua
        $artifacts = Artifact::where('user_id', $this->demoUserId)
            ->latest()
            ->paginate(10);

        return view('user.artifacts.index', compact('artifacts'));
    }

    public function create()
    {
        return view('user.artifacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'material'      => 'nullable|string|max:255',
            'function'      => 'nullable|string|max:255',
            'origin_region' => 'nullable|string|max:255',
            'origin_province'=> 'nullable|string|max:255',
            'image'         => 'required|image|max:5120',
        ]);

        $imagePath = $request->file('image')->store('artifacts', 'public');

        Artifact::create([
            'user_id'       => $this->demoUserId, // sementara fix 1
            'title'         => $validated['title'],
            'description'   => $validated['description'] ?? null,
            'material'      => $validated['material'] ?? null,
            'function'      => $validated['function'] ?? null,
            'origin_region' => $validated['origin_region'] ?? null,
            'origin_province'=> $validated['origin_province'] ?? null,
            'image_path'    => $imagePath,
            'status'        => 'PENDING',
        ]);

        return redirect()
            ->route('user.artifacts.index')
            ->with('success', 'Artefak berhasil disimpan (demo tanpa auth).');
    }
}

