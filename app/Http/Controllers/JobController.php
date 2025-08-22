<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();


        if ($user && $user->role === 'perusahaan') {
            $jobs = Job::where('perusahaan_id', $user->id)->where('is_active', 1);

            if ($request->has('search')) {
                $jobs = $jobs->where('posisi', 'like', '%' . $request->search . '%');
            }

            $jobs = $jobs->get(); // <- Ensure this line is correctly formatted
        } elseif ($user && $user->role === 'admin') {
            $jobs = Job::where('is_active', 1);
            if ($request->has('search')) {
                $jobs = $jobs->where('posisi', 'like', '%' . $request->search . '%');
            }
            $jobs = $jobs->get(); // <- Ensure this line is correctly formatted
        } elseif ($request->has('search')) {
            $jobs = Job::where('is_active', 1)
                ->where('posisi', 'like', '%' . $request->search . '%')
                ->get();
        } elseif ($request->has('location')) {
            $jobs = Job::where('is_active', 1)
                ->where('lokasi', 'like', '%' . $request->location . '%')
                ->get();

        } else {
            $jobs = Job::where('is_active', 1);


            if ($request->has('search')) {
                $jobs = $jobs->where('posisi', 'like', '%' . $request->search . '%');
            }

            $jobs = $jobs->get(); // <- Ensure this line is correctly formatted
        }


        return view('jobs.index', compact('jobs'));
    }

    


    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    // Method untuk menyimpan data lowongan baru
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_tutup' => 'required|date',
            'deskripsi' => 'required|string',
            'gaji_min' => 'nullable|numeric',
            'gaji_max' => 'nullable|numeric',
            'tipe_kerja' => 'nullable|string|max:50',
            'pengalaman' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean', // <- tambahkan validasi ini

        ]);

       

    Job::create([
        'perusahaan_id' => Auth::id(), // id perusahaan yang buat lowongan
        'posisi' => $request->posisi,
        'perusahaan' => $request->perusahaan,
        'lokasi' => $request->lokasi,
        'tanggal_tutup' => $request->tanggal_tutup,
        'deskripsi' => $request->deskripsi,
        'gaji_min' => $request->gaji_min,
        'gaji_max' => $request->gaji_max,
        'tipe_kerja' => $request->tipe_kerja, // <- tambahkan ini
        'pengalaman' => $request->pengalaman, // <- dan ini
        'is_active' => 1,
        
        
    ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posisi' => 'required',
            'perusahaan' => 'required',
            'lokasi' => 'required',
            'tanggal_tutup' => 'required|date',
            'deskripsi' => 'nullable',
            'gaji_min' => 'nullable|numeric',
            'gaji_max' => 'nullable|numeric',
            'tipe_kerja' => 'nullable|string',
            'pengalaman' => 'required|string|max:100',
        ]);

        $job = Job::findOrFail($id);
        $job->update([
            'posisi' => $request->posisi,
            'perusahaan' => $request->perusahaan,
            'lokasi' => $request->lokasi,
            'tanggal_tutup' => $request->tanggal_tutup,
            'deskripsi' => $request->deskripsi,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'tipe_kerja' => $request->tipe_kerja,
            'pengalaman' => $request->pengalaman,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diperbarui.');
    }
    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Remove the specified job from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    /*******  064fa607-a837-446e-818e-6a28805c53f6  *******/
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus.');
    }
    public function showApplyForm($jobId)
    {
        $job = Job::findOrFail($jobId);
        return view('applications.apply', compact('job'));
    }
}
