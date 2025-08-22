<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class PerusahaanApplicationController extends Controller
{
    // Menampilkan semua lamaran untuk perusahaan yang login
    public function index()
    {
        $companyId = Auth::id(); // id perusahaan yang login
        $applications = Application::where('company_id', $companyId)
                                   ->orderBy('applied_at', 'desc')
                                   ->get();

        // Mengarahkan ke view perusahaan/applications/index.blade.php
        return view('perusahaan.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::where('company_id', Auth::id())
                                  ->findOrFail($id);

        return view('perusahaan.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::where('company_id', Auth::id())
                                  ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $application->status = $request->status;
        $application->save();

        return redirect()->back()->with('success', 'Status lamaran berhasil diupdate.');
    }
}
