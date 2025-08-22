<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'posisi' => 'required',
        'perusahaan' => 'required',
        'lokasi' => 'required',
        'tanggal_tutup' => 'required|date',
        'deskripsi' => 'required',
        'gaji_min' => 'required|numeric|min:0',
        'gaji_max' => 'required|numeric|min:0|gte:gaji_min',
        'tipe_kerja' => 'required',
        'pengalaman' => 'required|string|max:100',
    ]);

    Job::create([
        'posisi' => $request->posisi,
        'perusahaan' => $request->perusahaan,
        'lokasi' => $request->lokasi,
        'tanggal_tutup' => $request->tanggal_tutup,
        'deskripsi' => $request->deskripsi,
        'gaji_min' => $request->filled('gaji_min') ? $request->gaji_min : 5000000,
        'gaji_max' => $request->filled('gaji_max') ? $request->gaji_max : 10000000,
        'tipe_kerja' => $request->tipe_kerja,
        'pengalaman' => $request->pengalaman,
        'is_active' => 1,
    ]);



       
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'posisi' => 'required',
            'perusahaan' => 'required',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'tanggal_tutup' => 'required|date',
            'gaji_min' => 'nullable|numeric',
            'gaji_max' => 'nullable|numeric',
            'tipe_kerja' => 'nullable|string',
            'pengalaman' => 'required|string|max:100', 
        ]);

        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus.');
    }
    
}
