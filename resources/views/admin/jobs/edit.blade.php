@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('jobs.index') }}">
                    <i class="fas fa-home"></i> Beranda
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('jobs.index') }}">Lowongan Kerja</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Lowongan</li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-2 text-gray-800">
                <i class="fas fa-edit me-2"></i>Edit Lowongan Kerja
            </h1>
            <p class="text-muted">Perbarui informasi lowongan kerja yang sudah ada</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Form Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit me-2"></i>Form Edit Lowongan
                    </h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" id="editJobForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="posisi" class="form-label">
                                        <i class="fas fa-briefcase me-1"></i>Posisi *
                                    </label>
                                    <input type="text"
                                        name="posisi"
                                        id="posisi"
                                        value="{{ old('posisi', $job->posisi) }}"
                                        class="form-control @error('posisi') is-invalid @enderror"
                                        placeholder="Contoh: Software Developer"
                                        required>
                                    @error('posisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="perusahaan" class="form-label">
                                        <i class="fas fa-building me-1"></i>Perusahaan *
                                    </label>
                                    <input type="text"
                                        name="perusahaan"
                                        id="perusahaan"
                                        value="{{ old('perusahaan', $job->perusahaan) }}"
                                        class="form-control @error('perusahaan') is-invalid @enderror"
                                        placeholder="Contoh: PT. Teknologi Indonesia"
                                        required>
                                    @error('perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="lokasi" class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i>Lokasi *
                                    </label>
                                    <input type="text"
                                        name="lokasi"
                                        id="lokasi"
                                        value="{{ old('lokasi', $job->lokasi) }}"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        placeholder="Contoh: Jakarta, Indonesia"
                                        required>
                                    @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tanggal_tutup" class="form-label">
                                        <i class="fas fa-calendar-alt me-1"></i>Tanggal Tutup *
                                    </label>
                                    <input type="date"
                                        name="tanggal_tutup"
                                        id="tanggal_tutup"
                                        value="{{ old('tanggal_tutup', $job->tanggal_tutup) }}"
                                        class="form-control @error('tanggal_tutup') is-invalid @enderror"
                                        min="{{ date('Y-m-d') }}"
                                        required>
                                    @error('tanggal_tutup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Tanggal tidak boleh kurang dari hari ini
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="deskripsi" class="form-label">
                                <i class="fas fa-align-left me-1"></i>Deskripsi Pekerjaan *
                            </label>
                            <textarea name="deskripsi"
                                id="deskripsi"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                rows="6"
                                placeholder="Jelaskan detail pekerjaan, requirement, benefit, dll..."
                                required>{{ old('deskripsi', $job->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <span id="charCount">0</span> karakter
                            </small>
                        </div>

                        <!-- Additional Fields Section -->
                        <div class="card bg-light mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">
                                    <i class="fas fa-cogs me-2"></i>Informasi Detail Pekerjaan
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gaji_min" class="form-label">
                                                <i class="fas fa-money-bill-wave me-1"></i>Gaji
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number"
                                                    name="gaji_min"
                                                    id="gaji_min"
                                                    value="{{ old('gaji_min', $job->gaji_min ?? '') }}"
                                                    class="form-control @error('gaji_min') is-invalid @enderror"
                                                    placeholder="5000000">
                                                @error('gaji_min')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gaji_max" class="form-label">
                                                <i class="fas fa-money-bill-wave me-1"></i>Gaji Maximum
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number"
                                                    name="gaji_max"
                                                    id="gaji_max"
                                                    value="{{ old('gaji_max', $job->gaji_max ?? '') }}"
                                                    class="form-control @error('gaji_max') is-invalid @enderror"
                                                    placeholder="10000000">
                                                @error('gaji_max')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="tipe_kerja" class="form-label">
                                                <i class="fas fa-laptop me-1"></i>Tipe Pekerjaan
                                            </label>
                                            <select name="tipe_kerja"
                                                id="tipe_kerja"
                                                class="form-control @error('tipe_kerja') is-invalid @enderror">
                                                <option value="">Pilih Tipe Pekerjaan</option>
                                                <option value="full-time" {{ old('tipe_kerja', $job->tipe_kerja ?? '') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                                <option value="part-time" {{ old('tipe_kerja', $job->tipe_kerja ?? '') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                                <option value="contract" {{ old('tipe_kerja', $job->tipe_kerja ?? '') == 'contract' ? 'selected' : '' }}>Contract</option>
                                                <option value="freelance" {{ old('tipe_kerja', $job->tipe_kerja ?? '') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                                <option value="internship" {{ old('tipe_kerja', $job->tipe_kerja ?? '') == 'internship' ? 'selected' : '' }}>Magang</option>
                                            </select>
                                            @error('tipe_kerja')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pengalaman" class="form-label">
                                                <i class="fas fa-star me-1"></i>Pengalaman Minimal
                                            </label>
                                            <select name="pengalaman"
                                                id="pengalaman"
                                                class="form-control @error('pengalaman') is-invalid @enderror">
                                                <option value="">Pilih Pengalaman</option>
                                                <option value="fresh-graduate" {{ old('pengalaman', $job->pengalaman ?? '') == 'fresh-graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                                                <option value="1-year" {{ old('pengalaman', $job->pengalaman ?? '') == '1-year' ? 'selected' : '' }}>1 Tahun</option>
                                                <option value="2-years" {{ old('pengalaman', $job->pengalaman ?? '') == '2-years' ? 'selected' : '' }}>2 Tahun</option>
                                                <option value="3-years" {{ old('pengalaman', $job->pengalaman ?? '') == '3-years' ? 'selected' : '' }}>3 Tahun</option>
                                                <option value="5-years" {{ old('pengalaman', $job->pengalaman ?? '') == '5-years' ? 'selected' : '' }}>5+ Tahun</option>
                                            </select>
                                            @error('pengalaman')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Field ini bersifat opsional dan dapat membantu kandidat mendapatkan informasi yang lebih detail
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-info-circle me-2"></i>Informasi Tambahan
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small class="text-muted">
                                                <strong>Dibuat:</strong><br>
                                                {{ $job->created_at ? $job->created_at->format('d M Y H:i') : '-' }}
                                            </small>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">
                                                <strong>Terakhir Diupdate:</strong><br>
                                                {{ $job->updated_at ? $job->updated_at->format('d M Y H:i') : '-' }}
                                            </small>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted">
                                                <strong>Status:</strong><br>
                                                @if(\Carbon\Carbon::parse($job->tanggal_tutup)->isFuture())
                                                <span class="badge badge-success">Aktif</span>
                                                @else
                                                <span class="badge badge-danger">Tutup</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="submit" class="btn btn-success" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('jobs.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-warning" onclick="resetForm()">
                                    <i class="fas fa-undo me-2"></i>Reset Form
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-lightbulb me-2"></i>Tips Pengisian
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Posisi</h6>
                        <small class="text-muted">Gunakan nama posisi yang jelas dan spesifik</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Perusahaan</h6>
                        <small class="text-muted">Masukkan nama perusahaan lengkap</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Lokasi</h6>
                        <small class="text-muted">Sertakan kota dan negara untuk kejelasan</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Deskripsi</h6>
                        <small class="text-muted">Jelaskan tanggung jawab, kualifikasi, dan benefit</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Gaji</h6>
                        <small class="text-muted">Cantumkan range gaji untuk menarik kandidat</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Tipe Kerja</h6>
                        <small class="text-muted">Tentukan apakah full-time, part-time, atau contract</small>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-check-circle text-success me-2"></i>Pengalaman</h6>
                        <small class="text-muted">Sesuaikan dengan level posisi yang dibutuhkan</small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info btn-sm btn-block mb-2">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </a>
                    <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-sm btn-block mb-2">
                        <i class="fas fa-list me-2"></i>Semua Lowongan
                    </a>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary btn-sm btn-block">
                        <i class="fas fa-plus me-2"></i>Tambah Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    .card {
        border: none;
        border-radius: 0.35rem;
    }

    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .form-label {
        font-weight: 600;
        color: #5a5c69;
    }

    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    .btn-block {
        width: 100%;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }

    .breadcrumb-item a {
        text-decoration: none;
        color: #6c757d;
    }

    .breadcrumb-item a:hover {
        color: #4e73df;
    }

    .invalid-feedback {
        display: block;
    }

    .badge {
        font-size: 0.75rem;
    }

    .input-group-text {
        background-color: #e9ecef;
        border-color: #ced4da;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for description
        const deskripsiTextarea = document.getElementById('deskripsi');
        const charCount = document.getElementById('charCount');

        function updateCharCount() {
            charCount.textContent = deskripsiTextarea.value.length;
        }

        deskripsiTextarea.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count

        // Form validation
        const form = document.getElementById('editJobForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
        });
    });

    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua perubahan akan hilang.')) {
            document.getElementById('editJobForm').reset();
            // Update character count
            document.getElementById('charCount').textContent = document.getElementById('deskripsi').value.length;
        }
    }
</script>
@endpush
@endsection