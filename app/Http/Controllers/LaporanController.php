<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use App\Mail\ApplicationStatusMail;
use Illuminate\Support\Facades\Mail;

class LaporanController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'job'])->latest()->paginate(10);
        return view('admin.laporan.index', compact('applications'));
    }

    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // kirim email ke pelamar
        if ($application->user && $application->user->email) {
            Mail::to($application->user->email)
            ->send(new ApplicationStatusMail($application, $application->status));
        }        

        return redirect()->back()->with('success', 'Status lamaran diperbarui & email terkirim.');
    }
}
