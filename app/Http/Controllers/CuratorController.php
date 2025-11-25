<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuratorController extends Controller
{
    /**
     * Dashboard Kurator: Menampilkan antrean benda yang statusnya PENDING.
     */
    public function index()
    {
        // Menggunakan Scope 'pending()' yang sudah kita buat di Model
        $pendingArtifacts = Artifact::pending()
            ->with(['user', 'museum'])
            ->latest()
            ->paginate(10);

        return view('dashboard.curator', compact('pendingArtifacts'));
    }

    /**
     * Logika untuk Menyetujui (Approve) Benda.
     */
    public function approve($id)
    {
        $artifact = Artifact::findOrFail($id);

        $artifact->update([
            'curation_status' => 'APPROVED',
            'curator_id' => Auth::id(), // Rekam siapa yang meng-approve
            'curator_note' => null, // Hapus catatan revisi jika ada
        ]);

        return back()->with('success', 'Koleksi berhasil disetujui dan tayang di publik.');
    }

    /**
     * Logika untuk Menolak (Reject) Benda.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|min:5', // Wajib kasih alasan
        ]);

        $artifact = Artifact::findOrFail($id);

        $artifact->update([
            'curation_status' => 'REJECTED',
            'curator_id' => Auth::id(),
            'curator_note' => $request->note, // Simpan alasan penolakan
        ]);

        return back()->with('warning', 'Koleksi ditolak & dikembalikan ke pengguna.');
    }
}
