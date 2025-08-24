<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    public function create($id)
    {
        $job = Job::findOrFail($id);
        return view('applications.create', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $job = Job::findOrFail($request->job_id); // 🔥 ambil job yang dilamar

        $cvPath = $request->file('cv')->store('cv', 'public');

        Application::create([
            'job_id'     => $request->job_id,
            'company_id' => $job->perusahaan_id, // 🔥 simpan perusahaan pemilik job
            'nama'       => $request->nama,
            'email'      => $request->email,
            'telepon'    => $request->telepon,
            'alamat'     => $request->alamat,
            'cv'         => $cvPath,
        ]);
        

        return redirect()->back()->with('success', 'Lamaran berhasil dikirim!');
    }

    
}
