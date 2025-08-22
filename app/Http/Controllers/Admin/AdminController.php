<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !in_array(auth()->user()->role, ['admin', 'perusahaan'])) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function dashboard(): View
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        if ($user->isAdmin()) {
            $totalLowongan = Job::count();
            $totalJobs = Job::count();
            $activeJobs = Job::where('is_active', 1)->count();
            $totalApplications = Application::count();
            $pendingApplications = Application::where('status', 'pending')->count();
            $recentApplications = Application::with(['job', 'user'])->latest()->take(5)->get();
        } else {
            $totalLowongan = Job::where('perusahaan_id', $user->id)->count();
            $totalJobs = $totalLowongan;
            $activeJobs = Job::where('perusahaan_id', $user->id)
                            ->where('is_active', 1)
                            ->count();
            $totalApplications = Application::whereHas('job', function ($q) use ($user) {
                                    $q->where('perusahaan_id', $user->id);
                                })->count();
            $pendingApplications = Application::whereHas('job', function ($q) use ($user) {
                                        $q->where('perusahaan_id', $user->id);
                                    })
                                    ->where('status', 'pending')
                                    ->count();
            $recentApplications = Application::whereHas('job', function ($q) use ($user) {
                                        $q->where('perusahaan_id', $user->id);
                                    })
                                    ->with(['job', 'user'])
                                    ->latest()
                                    ->take(5)
                                    ->get();
        }

        return view('admin.dashboard', compact(
            'totalLowongan',
            'totalJobs',
            'activeJobs',
            'totalApplications',
            'pendingApplications',
            'recentApplications'
        ));
    }
}
