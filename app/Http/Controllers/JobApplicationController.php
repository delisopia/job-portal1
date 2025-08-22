<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewApplicationMail;

class JobApplicationController extends Controller
{

    public function downloadPDF($id)
    {
        $application = DB::table('applications')
            ->join('jobs', 'applications.job_id', '=', 'jobs.id')
            ->where('applications.id', $id)
            ->where('jobs.perusahaan_id', Auth::id())
            ->select('applications.*')
            ->first();

        if ($application && $application->cv_path) {
            return response()->download(storage_path('app/public/' . $application->cv_path));
        }

        return redirect()->back()->with('error', 'CV tidak ditemukan.');
    }

    public function store(Request $request, $id)
    {
        $userId = Auth::id();

        // ✅ Cek jika user sudah pernah melamar
        $existing = Application::where('job_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Kamu sudah melamar ke lowongan ini.');
        }

        // Validasi form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Upload CV ke storage/app/public/cv/
        $cvPath = $request->file('cv')->store('cv', 'public');

        // Simpan ke database
        Application::create([
            'job_id' => $id,
            'company_id' => Job::findOrFail($id)->company_id, // Ambil company_id dari job   
            'user_id' => $userId,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'cv_path' => $cvPath,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        

        

        return redirect()->route('jobs.index')->with('success', 'Lamaran berhasil dikirim!');
    }
}
