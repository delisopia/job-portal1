@extends('layouts.app')

@section('content')


<div class="caontainer-fluid px-4 py-4">
    <!-- Hero Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-header bg-gradient-primary rounded-3 p-4 text-white position-relative overflow-hidden">
                <div class="hero-pattern"></div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold mb-3">
                            <i class="fas fa-briefcase me-3"></i>Temukan Karir Impian Anda
                        </h1>
                        <p class="lead mb-0 opacity-90">
                            Jelajahi lebih dari <span class="fw-bold">{{ $jobs->count() }}</span> lowongan kerja dari perusahaan terpercaya
                        </p>
                    </div>
                    <div class="col-lg-4 text-end d-none d-lg-block">
                        <div class="hero-icon">
                            <i class="fas fa-rocket fa-5x opacity-20"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Lowongan
                            </div>
                            <div class="h4 mb-0 fw-bold text-gray-800">{{ $jobs->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Lowongan Aktif
                            </div>
                            <div class="h4 mb-0 fw-bold text-gray-800">
                                {{ $jobs->filter(function($job) { return \Carbon\Carbon::parse($job->tanggal_tutup)->isFuture(); })->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Perusahaan
                            </div>
                            <div class="h4 mb-0 fw-bold text-gray-800">
                                {{ $jobs->pluck('perusahaan')->unique()->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-info">
                                <i class="fas fa-building text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Lokasi
                            </div>
                            <div class="h4 mb-0 fw-bold text-gray-800">
                                {{ $jobs->pluck('lokasi')->unique()->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-transparent border-0 py-3">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-primary me-3">
                    <i class="fas fa-filter text-white"></i>
                </div>
                <h5 class="mb-0 fw-bold">Filter & Pencarian</h5>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('jobs.index') }}">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="search" name="search"
                                placeholder="Cari posisi atau perusahaan..." value="{{ request('search') }}">
                            <label for="search">
                                <i class="fas fa-search me-2"></i>Cari Posisi/Perusahaan
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                placeholder="Pilih lokasi..." value="{{ request('lokasi') }}">
                            <label for="lokasi">
                                <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="status" name="status">
                                <option value="">Semua Status</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tutup" {{ request('status') == 'tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                            <label for="status">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                            <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-refresh me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Jobs Grid/List -->
    @if($jobs->count() > 0)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <i class="fas fa-list-ul me-2 text-primary"></i>
            Daftar Lowongan Tersedia
        </h4>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary active" id="gridView">
                <i class="fas fa-th-large"></i>
            </button>

        </div>
    </div>

    <!-- Grid View -->
    <div id="jobsGrid" class="row">
        @foreach($jobs as $job)
        <div class="col-xl-4 col-lg-6 mb-4">
            <div class="card job-card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="company-avatar">
                            <div class="avatar bg-gradient-primary">
                                {{ strtoupper(substr($job->perusahaan, 0, 2)) }}
                            </div>
                        </div>
                        <div class="job-status">
                            @if(\Carbon\Carbon::parse($job->tanggal_tutup)->isFuture())
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Aktif
                            </span>
                            @else
                            <span class="badge bg-danger">
                                <i class="fas fa-times-circle me-1"></i>Tutup
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <h5 class="card-title fw-bold mb-2">{{ $job->posisi }}</h5>
                    <h6 class="card-subtitle mb-3 text-muted">
                        <i class="fas fa-building me-2"></i>{{ $job->perusahaan }}
                    </h6>

                    <div class="job-details mb-3">
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span>{{ $job->lokasi }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-money-bill-wave text-success me-2"></i>

                            @php
                            $gajiMin = $job->gaji_min;
                            $gajiMax = $job->gaji_max;
                            @endphp

                            @if($gajiMin && $gajiMax)
                            <span class="badge bg-info text-dark">Rp {{ number_format($gajiMin, 0, ',', '.') }}</span>
                            <span class="badge bg-info text-dark">Rp {{ number_format($gajiMax, 0, ',', '.') }}</span>
                            @elseif($gajiMin)
                            <span class="badge bg-info text-dark">Rp {{ number_format($gajiMin, 0, ',', '.') }}</span>
                            @elseif($gajiMax)
                            <span class="badge bg-info text-dark">Rp {{ number_format($gajiMax, 0, ',', '.') }}</span>
                            @endif
                        </div>

                        <div class="detail-item">
                            <i class="fas fa-clock text-info me-2"></i>
                            <span>{{ $job->tipe_kerja }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-tie text-warning me-2"></i>
                            <span>{{ $job->pengalaman }} Tahun</span>
                        </div>
                    </div>

                    <p class="card-text text-muted small">
                        {{ Str::limit($job->deskripsi, 100) }}
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            Tutup {{ \Carbon\Carbon::parse($job->tanggal_tutup)->diffForHumans() }}
                        </small>
                        <div class="btn-group">
                            @if(\Carbon\Carbon::parse($job->tanggal_tutup)->isFuture())

                            @endif
                            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- List View (Hidden by default) -->
    <div id="jobsList" class="d-none">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @foreach($jobs as $index => $job)
                <div class="job-list-item p-4 {{ $index > 0 ? 'border-top' : '' }}">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar bg-gradient-primary">
                                {{ strtoupper(substr($job->perusahaan, 0, 2)) }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="fw-bold mb-1">{{ $job->posisi }}</h5>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-building me-2"></i>{{ $job->perusahaan }}
                                    </p>
                                    <div class="job-meta">
                                        <span class="badge bg-light text-dark me-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $job->lokasi }}
                                        </span>
                                        <span class="badge bg-light text-dark me-2">
                                            <i class="fas fa-clock me-1"></i>{{ $job->tipe_pekerjaan }}
                                        </span>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-user-tie me-1"></i>{{ $job->pengalaman }} Tahun
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-lg-end">
                                        <h5 class="text-success fw-bold mb-1">
                                            Rp {{ number_format($job->gaji, 0, ',', '.') }}
                                        </h5>
                                        <small class="text-muted">
                                            Tutup {{ \Carbon\Carbon::parse($job->tanggal_tutup)->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-lg-end">
                                        @if(\Carbon\Carbon::parse($job->tanggal_tutup)->isFuture())
                                        <span class="badge bg-success mb-2">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                        @else
                                        <span class="badge bg-danger mb-2">
                                            <i class="fas fa-times-circle me-1"></i>Tutup
                                        </span>
                                        @endif
                                        <div class="btn-group d-block">
                                            @if(\Carbon\Carbon::parse($job->tanggal_tutup)->isFuture())
                                            <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-paper-plane"></i>
                                            </a>
                                            @endif

                                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($jobs, 'links'))
    <div class="d-flex justify-content-center mt-4">
        {{ $jobs->links() }}
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <div class="empty-state-icon mb-4">
                <i class="fas fa-briefcase fa-5x text-muted"></i>
            </div>
            <h3 class="text-muted mb-3">Belum Ada Lowongan</h3>
            <p class="text-muted mb-4">Tidak ada lowongan kerja yang tersedia saat ini.</p>
        </div>
    </div>
    @endif
</div>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    :root {
        --primary: #4f46e5;
        --primary-dark: #3730a3;
        --success: #10b981;
        --info: #06b6d4;
        --warning: #f59e0b;
        --danger: #ef4444;
        --light: #f8fafc;
        --dark: #1e293b;
        --muted: #64748b;
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Hero Section */
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }

    .hero-header {
        position: relative;
        min-height: 200px;
    }

    .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    .hero-icon {
        transform: rotate(-15deg);
    }

    /* Stats Cards */
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .icon-circle {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* Job Cards */
    .job-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
        overflow: hidden;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
    }

    .company-avatar .avatar {
        width: 3rem;
        height: 3rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        color: white;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }

    .job-details .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .job-details .detail-item:last-child {
        margin-bottom: 0;
    }

    /* List View */
    .job-list-item {
        transition: all 0.2s ease;
    }

    .job-list-item:hover {
        background: var(--light);
    }

    .job-meta .badge {
        font-size: 0.75rem;
    }

    /* Form Styling */
    .form-floating>.form-control,
    .form-floating>.form-select {
        border-radius: 0.75rem;
        border: 2px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
    }

    /* Buttons */
    .btn {
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary);
        border-color: var(--primary);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        transform: translateY(-1px);
    }

    /* Cards */
    .card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Badges */
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
    }

    /* Empty State */
    .empty-state-icon {
        opacity: 0.3;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-header {
            text-align: center;
        }

        .display-5 {
            font-size: 2rem;
        }

        .btn-group {
            width: 100%;
        }

        .btn-group .btn {
            flex: 1;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .job-card,
    .stat-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .job-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .job-card:nth-child(3) {
        animation-delay: 0.2s;
    }

    .job-card:nth-child(4) {
        animation-delay: 0.3s;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gridViewBtn = document.getElementById('gridView');
        const listViewBtn = document.getElementById('listView');
        const jobsGrid = document.getElementById('jobsGrid');
        const jobsList = document.getElementById('jobsList');

        if (gridViewBtn && listViewBtn && jobsGrid && jobsList) {
            gridViewBtn.addEventListener('click', function() {
                gridViewBtn.classList.add('active');
                listViewBtn.classList.remove('active');
                jobsGrid.classList.remove('d-none');
                jobsList.classList.add('d-none');
            });

            listViewBtn.addEventListener('click', function() {
                listViewBtn.classList.add('active');
                gridViewBtn.classList.remove('active');
                jobsList.classList.remove('d-none');
                jobsGrid.classList.add('d-none');
            });
        }
    });
</script>
@endpush
@endsection