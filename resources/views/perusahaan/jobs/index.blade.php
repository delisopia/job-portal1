@extends('layouts.perusahaan')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-2 fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        📋 Manajemen Lowongan Kerja
                    </h2>
                    <p class="text-muted mb-0">Kelola semua lowongan kerja perusahaan Anda</p>
                </div>
                <a href="{{ route('perusahaan.jobs.create') }}"
                    class="btn btn-lg text-white fw-bold shadow-lg position-relative overflow-hidden"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px; padding: 12px 24px;">
                    <span class="d-flex align-items-center">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Lowongan
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if (session('success'))
    <div class="alert alert-success shadow-sm border-0 rounded-3 mb-4" style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2 text-success"></i>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                <div class="card-body text-center text-white">
                    <i class="fas fa-briefcase fa-2x mb-2"></i>
                    <h4 class="fw-bold">{{ $jobs->count() }}</h4>
                    <small>Total Lowongan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                <div class="card-body text-center text-white">
                    <i class="fas fa-clock fa-2x mb-2"></i>
                    <h4 class="fw-bold">{{ $jobs->where('tanggal_tutup', '>=', now())->count() }}</h4>
                    <small>Masih Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                <div class="card-body text-center text-white">
                    <i class="fas fa-times-circle fa-2x mb-2"></i>
                    <h4 class="fw-bold">{{ $jobs->where('tanggal_tutup', '<', now())->count() }}</h4>
                    <small>Ditutup</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-center text-white">
                    <i class="fas fa-chart-line fa-2x mb-2"></i>
                    <h4 class="fw-bold">{{ $jobs->where('created_at', '>=', now()->subDays(30))->count() }}</h4>
                    <small>Bulan Ini</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        <div class="card-header text-white py-4"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-list me-2"></i>
                Daftar Lowongan Kerja
            </h5>
        </div>

        <div class="card-body p-0">
            @if($jobs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center fw-bold border-0" style="width: 50px;">#</th>
                            <th class="fw-bold border-0">Posisi</th>
                            <th class="text-center fw-bold border-0">Tanggal Tutup</th>
                            <th class="text-center fw-bold border-0">Status</th>
                            <th class="fw-bold border-0">Deskripsi</th>
                            <th class="fw-bold border-0">Lokasi</th>
                            <th class="fw-bold border-0">Gaji</th>
                            <th class="text-center fw-bold border-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                        <tr class="border-bottom">
                            <td class="text-center">
                                <span class="badge bg-light text-dark rounded-circle p-2">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-primary">{{ $job->posisi }}</div>
                            </td>
                            <td class="text-center">
                                <div class="small">
                                    <i class="fas fa-calendar me-1 text-muted"></i>
                                    {{ \Carbon\Carbon::parse($job->tanggal_tutup)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($job->tanggal_tutup)))
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); color: white;">
                                    <i class="fas fa-times-circle me-1"></i>Ditutup
                                </span>
                                @else
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background: linear-gradient(135deg, #26d0ce 0%, #1dd1a1 100%); color: white;">
                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="text-muted" style="max-width: 200px;">
                                    {{ Str::limit($job->deskripsi, 80) }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                    {{ $job->lokasi }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold" style="color: #667eea;">
                                    Rp {{ number_format($job->gaji, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('perusahaan.jobs.edit', $job->id) }}"
                                        class="btn btn-sm text-white shadow-sm"
                                        style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; border-radius: 8px 0 0 8px;"
                                        data-bs-toggle="tooltip" title="Edit Lowongan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perusahaan.jobs.destroy', $job->id) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')"
                                            class="btn btn-sm text-white shadow-sm"
                                            style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); border: none; border-radius: 0 8px 8px 0;"
                                            data-bs-toggle="tooltip" title="Hapus Lowongan">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-briefcase" style="font-size: 4rem; color: #dee2e6;"></i>
                </div>
                <h4 class="text-muted fw-bold">Belum Ada Lowongan</h4>
                <p class="text-muted mb-4">Mulai tambahkan lowongan kerja pertama Anda</p>
                <a href="{{ route('perusahaan.jobs.create') }}"
                    class="btn btn-lg text-white fw-bold shadow-lg"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px; padding: 12px 32px;">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Lowongan Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .card {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }

    .btn-group .btn {
        transition: all 0.3s ease;
    }

    .btn-group .btn:hover {
        transform: scale(1.1);
        z-index: 2;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endpush
@endsection