@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Job Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-gradient-info text-white rounded-3 p-4 shadow">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-2 fw-bold">
                            <i class="fas fa-paper-plane me-2"></i>{{ $job->posisi }}
                        </h1>
                        <div class="row text-white-50">
                            <div class="col-sm-6">
                                <p class="mb-1">
                                    <i class="fas fa-building me-2"></i>{{ $job->perusahaan }}
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $job->lokasi }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-1">
                                    <i class="fas fa-calendar-alt me-2"></i>
                                    Tutup: {{ \Carbon\Carbon::parse($job->tanggal_tutup)->format('d M Y') }}
                                </p>
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($job->tanggal_tutup), false);
                                @endphp
                                <p class="mb-0">
                                    <i class="fas fa-clock me-2"></i>
                                    {{ $daysLeft >= 0 ? $daysLeft . ' hari tersisa' : 'Sudah ditutup' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white bg-opacity-20 rounded-3 p-3">
                            <i class="fas fa-users d-block mb-2" style="font-size: 2rem;"></i>
                            <h4 class="mb-0">{{ $job->applications->count() ?? 0 }}</h4>
                            <small>Pelamar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($daysLeft < 0)
        <!-- Expired Warning -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Lowongan Sudah Ditutup</h5>
                            <p class="mb-0">Maaf, periode pendaftaran untuk posisi ini telah berakhir pada {{ \Carbon\Carbon::parse($job->tanggal_tutup)->format('d M Y') }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Job Description -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="mb-0">
                        <i class="fas fa-info-circle text-info me-2"></i>
                        Deskripsi Pekerjaan
                    </h4>
                </div>
                <div class="card-body">
                    <div class="job-description">
                        {!! nl2br(e($job->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0 py-4">
                    <h4 class="mb-0 text-center">
                        <i class="fas fa-user-plus text-success me-2"></i>
                        Form Lamaran Kerja
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Oops!</strong> Ada beberapa masalah dengan input Anda:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($daysLeft >= 0)
                        <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" id="applicationForm">
                            @csrf
                            <input type="hidden" name="job_id" value="{{ $job->id }}">

                            <!-- Personal Information -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-user text-primary me-2"></i>
                                    Informasi Pribadi
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama" class="form-label fw-semibold">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                               id="nama" 
                                               name="nama" 
                                               placeholder="Masukkan nama lengkap"
                                               value="{{ old('nama') }}"
                                               required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label fw-semibold">
                                            Email Aktif <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               placeholder="contoh@email.com"
                                               value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="telepon" class="form-label fw-semibold">
                                        No.WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
       class="form-control form-control-lg" 
       id="telepon" 
       name="telepon" 
       placeholder="Masukkan nomor WhatsApp"
       value="{{ old('telepon') }}"
       required>

                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nomor yang dapat dihubungi untuk konfirmasi
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label fw-semibold">
                                        Alamat Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" 
                                              name="alamat" 
                                              rows="3" 
                                              placeholder="Masukkan alamat lengkap termasuk kota dan kode pos"
                                              required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- CV Upload -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-file-upload text-success me-2"></i>
                                    Dokumen Pendukung
                                </h5>
                                
                                <div class="mb-3">
                                    <label for="cv" class="form-label fw-semibold">
                                        Upload CV/Resume <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" 
                                           class="form-control form-control-lg @error('cv') is-invalid @enderror" 
                                           id="cv" 
                                           name="cv" 
                                           accept=".pdf,.doc,.docx" 
                                           required>
                                    @error('cv')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Format yang diterima: PDF, DOC, DOCX (Maksimal 5MB)
                                    </div>
                                    <div id="file-info" class="mt-2"></div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Saya menyetujui bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan. 
                                        Data ini akan digunakan untuk proses seleksi dan komunikasi terkait lamaran kerja.
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg fw-semibold" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Kirim Lamaran Sekarang
                                </button>
                                <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali ke Daftar Lowongan
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-lock text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                            <h4 class="text-muted">Pendaftaran Ditutup</h4>
                            <p class="text-muted">Maaf, lowongan ini sudah tidak menerima lamaran baru.</p>
                            <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>
                                Cari Lowongan Lain
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.form-control-lg {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
}

.form-control-lg:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    transform: translateY(-1px);
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.btn {
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
}

.job-description {
    line-height: 1.8;
    font-size: 1rem;
}

.form-check-input:checked {
    background-color: #28a745;
    border-color: #28a745;
}

.alert {
    border-radius: 10px;
    border: none;
}

#file-info {
    font-size: 0.875rem;
}

.file-valid {
    color: #28a745;
}

.file-invalid {
    color: #dc3545;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('applicationForm');
    const submitBtn = document.getElementById('submitBtn');
    const cvInput = document.getElementById('cv');
    const fileInfo = document.getElementById('file-info');
    
    // File validation
    cvInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            
            if (allowedTypes.includes(file.type) && file.size <= 5 * 1024 * 1024) {
                fileInfo.innerHTML = `<i class="fas fa-check-circle file-valid me-1"></i>File terpilih: ${file.name} (${fileSize} MB)`;
                fileInfo.className = 'mt-2 file-valid';
            } else {
                fileInfo.innerHTML = `<i class="fas fa-times-circle file-invalid me-1"></i>File tidak valid. Gunakan PDF/DOC/DOCX maksimal 5MB`;
                fileInfo.className = 'mt-2 file-invalid';
                this.value = '';
            }
        }
    });
    
    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim Lamaran...';
            }
        });
    }
    
    // Phone number formatting
   // Hanya hapus karakter non-angka
const phoneInput = document.getElementById('telepon');
phoneInput.addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');
});

});
</script>
@endsection