<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artifact;
use App\Models\Museum;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Statistik untuk Dashboard
        $stats = [
            'total_users' => User::count(),
            'total_artifacts' => Artifact::count(),
            'total_museums' => Museum::count(),
            'pending_artifacts' => Artifact::where('curation_status', 'PENDING')->count(),
        ];

        // Daftar User Terbaru
        $latestUsers = User::latest()->take(5)->get();

        return view('dashboard.admin.index', compact('stats', 'latestUsers'));
    }

    // Halaman Manajemen User Lengkap
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.admin.users', compact('users'));
    }

    // Fitur Ban/Unban User (Jika ada user nakal)
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        // Jangan biarkan Admin mem-ban dirinya sendiri
        if ($user->role === 'ADMIN') {
            return back()->with('error', 'Tidak bisa memblokir sesama Admin.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'diblokir';
        return back()->with('success', "User {$user->name} berhasil {$status}.");
    }
}
