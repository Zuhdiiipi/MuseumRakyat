<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    // public function index()
    // {
    //     $artifacts = Artifact::where('status', 'APPROVED')
    //         ->latest()
    //         ->paginate(12);

    //     return view('artifacts.index', compact('artifacts'));
    // }

    public function index()
{
    return view('artifacts.index'); // nanti isi sesuai kebutuhan
}


    public function show(Artifact $artifact)
    {
        if ($artifact->status !== 'APPROVED') abort(404);
        return view('artifacts.show', compact('artifact'));
    }
}
