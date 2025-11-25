<?php

namespace App\Http\Controllers\Curator;

use App\Models\Artifact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuratorArtifactController extends Controller
{
    public function index()
    {
        $artifacts = Artifact::whereIn('status', ['PENDING', 'REJECTED'])
            ->latest()
            ->paginate(15);

        return view('curator.artifacts.index', compact('artifacts'));
    }

    public function review(Artifact $artifact)
    {
        return view('curator.artifacts.review', compact('artifact'));
    }

    public function approve(Artifact $artifact)
    {
        $artifact->update([
            'status' => 'APPROVED',
            'curator_note' => null,
        ]);

        return back()->with('success', 'Artefak berhasil disetujui.');
    }

    public function reject(Request $request, Artifact $artifact)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $artifact->update([
            'status' => 'REJECTED',
            'curator_note' => $request->note,
        ]);

        return back()->with('success', 'Artefak berhasil ditolak.');
    }
}

