<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Perusahaan\PerusahaanController;
use App\Http\Controllers\Perusahaan\PerusahaanJobController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Middleware\AdminMiddleware;

// ================== DEFAULT REDIRECT ==================
Route::get('/', fn() => redirect('/jobs'));
Route::get('/home', fn() => redirect()->route('jobs.index'))->name('home');

// ================== AUTH ==================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ================== JOB APPLY ==================
Route::middleware('auth')->group(function () {
    // Apply untuk job umum
    Route::get('/jobs/{job}/apply', [JobController::class, 'showApplyForm'])->name('jobs.apply.form');
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/jobs/download/{id}', [JobApplicationController::class, 'downloadPDF'])->name('jobs.download.cv');
    
    // Apply untuk perusahaan job
    Route::get('/perusahaan-jobs/{job}/apply', [JobController::class, 'showApplyForm'])->name('perusahaan.jobs.apply.form');
    Route::post('/perusahaan-jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('perusahaan.jobs.apply');
});

// ================== ADMIN ROUTES ==================
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Jobs (Admin)
    Route::resource('jobs', AdminJobController::class);

    // Applications (Admin) - HANYA untuk job yang dibuat admin
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('applications.status');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::put('/applications/{id}/status', [LaporanController::class, 'updateStatus'])->name('lamaran.updateStatus');
});

// ================== PERUSAHAAN ROUTES ==================
Route::prefix('perusahaan')->name('perusahaan.')->middleware(['auth', 'perusahaan'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // 🔥 PERBAIKAN: Applications untuk perusahaan (hanya job yang dibuat mereka)
    Route::get('/applications', [PerusahaanJobController::class, 'allApplications'])->name('applications.index');
    Route::get('/applications/download/{id}', [PerusahaanJobController::class, 'downloadPDF'])->name('applications.download.cv');
    Route::get('/applications/{id}', [PerusahaanJobController::class, 'showApplication'])->name('applications.show');
    Route::put('/applications/{id}/status', [PerusahaanJobController::class, 'updateStatus'])->name('applications.updateStatus');

    // CRUD Lowongan Khusus Perusahaan
    Route::resource('jobs', PerusahaanJobController::class);

    // Menampilkan pelamar untuk lowongan tertentu
    Route::get('/jobs/{job}/pelamar', [PerusahaanJobController::class, 'pelamar'])->name('jobs.pelamar');
});

// ================== JOB SEEKER ROUTES ==================
Route::resource('jobs', JobController::class)->except(['create', 'store']);
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

// ================== LAMARAN KONFIRMASI ==================
Route::get('/lamaran/sukses', fn() => view('lamaran.sukses'))->name('lamaran.sukses');

// ================== JOBS PERUSAHAAN ==================
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/perusahaan/jobs/{job}', [PerusahaanJobController::class, 'show'])
     ->name('perusahaan.jobs.show');