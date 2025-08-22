<?php
namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    // Pastikan hanya perusahaan yang bisa akses
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Total lowongan perusahaan ini
        $totalJobs = Job::where('created_by', $user->id)->count(); // ✅


        // Total pelamar untuk lowongan perusahaan ini
        $totalApplications = Application::whereHas('job', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Pelamar dengan status pending
        $pendingApplications = Application::whereHas('job', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'pending')->count();

        return view('perusahaan.dashboard', compact('totalJobs', 'totalApplications', 'pendingApplications'));
    }
}
