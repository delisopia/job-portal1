<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerusahaanJob;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class PerusahaanJobController extends Controller
{
    public function index()
    {
        $jobs = PerusahaanJob::where('perusahaan_id', Auth::id())->paginate(10);
        

        return view('perusahaan.jobs.index', compact('jobs'));
    }

    

    public function create()
    {
        return view('perusahaan.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'gaji' => 'nullable|numeric',
            'tanggal_tutup' => 'required|date',
        ]);

        $perusahaanJob = PerusahaanJob::create([
            'perusahaan_id' => Auth::id(),
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'gaji' => $request->gaji,
            'tanggal_tutup' => $request->tanggal_tutup,
        ]);

        $jobUmum = Job::create([
            'perusahaan_id' => Auth::id(),
            'perusahaan_job_id' => $perusahaanJob->id,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'gaji' => $request->gaji,
            'tanggal_tutup' => $request->tanggal_tutup,
            'source' => 'perusahaan',
        ]);

        $perusahaanJob->update(['job_id' => $jobUmum->id]);

        return redirect()->route('perusahaan.jobs.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function show(PerusahaanJob $job)
    {
        $this->authorizeJob($job);
        return view('perusahaan.jobs.show', compact('job'));
    }

    public function edit(PerusahaanJob $job)
    {
        $this->authorizeJob($job);
        return view('perusahaan.jobs.edit', compact('job'));
    }

    public function update(Request $request, PerusahaanJob $job)
    {
        $this->authorizeJob($job);

        $request->validate([
            'posisi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'gaji' => 'nullable|numeric',
            'tanggal_tutup' => 'required|date',
        ]);

        $job->update($request->only(['posisi','deskripsi','lokasi','gaji','tanggal_tutup']));

        if ($job->jobUmum) {
            $job->jobUmum->update($request->only(['posisi','deskripsi','lokasi','gaji','tanggal_tutup']));
        }

        return redirect()->route('perusahaan.jobs.index')->with('success', 'Lowongan berhasil diupdate!');
    }

    public function destroy(PerusahaanJob $job)
    {
        $this->authorizeJob($job);

        if ($job->jobUmum) {
            $job->jobUmum->delete();
        }

        $job->delete();

        return redirect()->route('perusahaan.jobs.index')->with('success', 'Lowongan berhasil dihapus!');
    }

    public function pelamar(PerusahaanJob $job)
    {
        $this->authorizeJob($job);

        $applications = $job->applications()->with('user')->paginate(10);

        return view('perusahaan.jobs.pelamar', compact('job', 'applications'));
    }

    public function allApplications()
    {
        $jobIds = PerusahaanJob::where('perusahaan_id', Auth::id())->pluck('id');

        $applications = DB::table('applications')
                      ->join('jobs', 'applications.job_id', '=', 'jobs.id')
                        ->join('users', 'jobs.perusahaan_id', '=', 'users.id')
                        ->where('jobs.perusahaan_id', Auth::id())
                      ->select('applications.*', 'jobs.posisi')
                      ->orderBy('applications.applied_at', 'desc')
                      ->paginate(10);


        return view('perusahaan.applications.index', compact('applications'));
    }


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

    // =================== Update Status Lamaran ===================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $application = JobApplication::findOrFail($id);

        $perusahaanJobIds = PerusahaanJob::where('perusahaan_id', Auth::id())->pluck('id');
        if (!in_array($application->job_id, $perusahaanJobIds->toArray())) {
            abort(403, 'Unauthorized action.');
        }

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status lamaran berhasil diupdate!');
    }

    // =================== Helper ===================
    private function authorizeJob(PerusahaanJob $job)
    {
        if ($job->perusahaan_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
