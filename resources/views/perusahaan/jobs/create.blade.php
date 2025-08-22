@extends('layouts.perusahaan')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('perusahaan.jobs.index') }}" 
                   class="btn btn-outline-secondary me-3 rounded-circle d-flex align-items-center justify-content-center"
                   style="width: 45px; height: 45px;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="mb-1 fw-bold" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        ➕ Tambah Lowongan Baru
                    </h2>
                    <p class="text-muted mb-0">Buat lowongan kerja untuk menarik kandidat terbaik</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-header text-white py-4" 
                     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                        <i class="fas fa-plus-circle me-2"></i>
                        Form Tambah Lowongan
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle me-2 mt-1 text-danger"></i>
                                <div>
                                    <strong>Terdapat kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Info Card -->
                    <div class="alert border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); border-radius: 12px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            <div>
                                <strong>Tips:</strong> Pastikan semua informasi yang Anda masukkan akurat dan lengkap untuk menarik kandidat terbaik.
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('perusahaan.jobs.store') }}" method="POST" id="createJobForm">
                        @csrf

                        <div class="row">
                            <!-- Posisi -->
                            <div class="col-md-6 mb-4">
                                <label for="posisi" class="form-label fw-bold">
                                    <i class="fas fa-user-tie me-2 text-primary"></i>Posisi Pekerjaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="posisi" 
                                       id="posisi" 
                                       class="form-control form-control-lg @error('posisi') is-invalid @enderror" 
                                       value="{{ old('posisi') }}" 
                                       placeholder="Contoh: Software Developer"
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       required>
                                @error('posisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Perusahaan -->
                            <div class="col-md-6 mb-4">
                                <label for="perusahaan" class="form-label fw-bold">
                                    <i class="fas fa-building me-2 text-success"></i>Nama Perusahaan
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="perusahaan" 
                                       id="perusahaan" 
                                       class="form-control form-control-lg @error('perusahaan') is-invalid @enderror" 
                                       value="{{ old('perusahaan') }}" 
                                       placeholder="Contoh: PT. Teknologi Maju"
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       required>
                                @error('perusahaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Tanggal Tutup -->
                            <div class="col-md-6 mb-4">
                                <label for="tanggal_tutup" class="form-label fw-bold">
                                    <i class="fas fa-calendar-alt me-2 text-warning"></i>Tanggal Tutup
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       name="tanggal_tutup" 
                                       id="tanggal_tutup" 
                                       class="form-control form-control-lg @error('tanggal_tutup') is-invalid @enderror" 
                                       value="{{ old('tanggal_tutup') }}" 
                                       min="{{ date('Y-m-d') }}"
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       required>
                                @error('tanggal_tutup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Pilih tanggal minimal hari ini</small>
                            </div>

                            <!-- Lokasi -->
                            <div class="col-md-6 mb-4">
                                <label for="lokasi" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Lokasi
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       name="lokasi" 
                                       id="lokasi" 
                                       class="form-control form-control-lg @error('lokasi') is-invalid @enderror" 
                                       value="{{ old('lokasi') }}" 
                                       placeholder="Contoh: Jakarta Selatan"
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gaji -->
                        <div class="mb-4">
                            <label for="gaji" class="form-label fw-bold">
                                <i class="fas fa-money-bill-wave me-2 text-info"></i>Gaji (Rupiah)
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">
                                    Rp
                                </span>
                                <input type="text" 
                                       name="gaji" 
                                       id="gaji" 
                                       class="form-control @error('gaji') is-invalid @enderror" 
                                       value="{{ old('gaji') }}" 
                                       placeholder="5.000.000"
                                       style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;"
                                       required>
                                @error('gaji')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Masukkan angka tanpa titik atau koma. Contoh: 5000000</small>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-secondary"></i>Deskripsi Pekerjaan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="6"
                                      placeholder="Jelaskan detail pekerjaan, kualifikasi yang dibutuhkan, dan benefit yang ditawarkan...&#10;&#10;Contoh:&#10;- Mengembangkan aplikasi web menggunakan Laravel&#10;- Minimal S1 Teknik Informatika&#10;- Pengalaman 2 tahun di bidang yang sama&#10;- Gaji kompetitif + tunjangan kesehatan"
                                      style="border-radius: 12px; border: 2px solid #e9ecef; resize: vertical;"
                                      required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Minimal 50 karakter untuk deskripsi yang informatif</small>
                                <small class="text-muted" id="deskripsi-counter">0 karakter</small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-end pt-4 border-top">
                            <a href="{{ route('perusahaan.jobs.index') }}" 
                               class="btn btn-lg btn-light fw-bold px-4" 
                               style="border-radius: 12px; border: 2px solid #e9ecef;">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" 
                                    class="btn btn-lg text-white fw-bold px-4 shadow-lg" 
                                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px;">
                                <i class="fas fa-plus me-2"></i>Tambah Lowongan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>
                        Tips Membuat Lowongan yang Menarik
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Judul jelas:</strong> Gunakan nama posisi yang spesifik
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Deskripsi lengkap:</strong> Jelaskan tugas dan tanggung jawab
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Kualifikasi jelas:</strong> Sebutkan skill yang dibutuhkan
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Benefit menarik:</strong> Cantumkan tunjangan dan fasilitas
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Lokasi spesifik:</strong> Sebutkan alamat yang jelas
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    <strong>Deadline realistis:</strong> Berikan waktu cukup untuk melamar
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .btn:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    
    .form-label {
        color: #495057;
        margin-bottom: 8px;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    /* Custom styling for input focus */
    .form-control:focus,
    .form-select:focus {
        border-width: 2px;
    }
    
    /* Loading state for submit button */
    .btn-loading {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    /* Highlight required fields */
    .form-label .text-danger {
        font-size: 0.9em;
    }
</style>
@endpush

@push('scripts')
<script>
    // Format gaji input dengan validation
    document.getElementById('gaji').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            // Format dengan titik sebagai pemisah ribuan untuk display
            e.target.value = parseInt(value).toLocaleString('id-ID');
        }
    });
    
    // Handle form submission with loading state
    document.getElementById('createJobForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('btn-loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Remove dots from gaji before submission
        const gajiInput = document.getElementById('gaji');
        gajiInput.value = gajiInput.value.replace(/\./g, '');
    });
    
    // Character counter for description
    const deskripsiTextarea = document.getElementById('deskripsi');
    const counter = document.getElementById('deskripsi-counter');
    
    const updateCounter = () => {
        const count = deskripsiTextarea.value.length;
        counter.textContent = `${count} karakter`;
        if (count < 50) {
            counter.className = 'text-danger';
        } else {
            counter.className = 'text-success';
        }
    };
    
    deskripsiTextarea.addEventListener('input', updateCounter);
    updateCounter(); // Initial count
    
    // Auto-suggest for common positions
    const posisiInput = document.getElementById('posisi');
    const commonPositions = [
        'Software Developer',
        'Frontend Developer',
        'Backend Developer',
        'Full Stack Developer',
        'UI/UX Designer',
        'Data Analyst',
        'Digital Marketing',
        'Content Creator',
        'Sales Executive',
        'Customer Service',
        'Project Manager',
        'HR Specialist'
    ];
    
    // Simple autocomplete functionality
    posisiInput.addEventListener('input', function() {
        // This is a basic implementation - you might want to use a more sophisticated autocomplete library
        const value = this.value.toLowerCase();
        if (value.length > 2) {
            const matches = commonPositions.filter(pos => 
                pos.toLowerCase().includes(value)
            );
            // You can implement dropdown here if needed
        }
    });
    
    // Set minimum date to today
    document.getElementById('tanggal_tutup').min = new Date().toISOString().split('T')[0];
    
    // Form validation enhancement
    const form = document.getElementById('createJobForm');
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
</script>
@endpush
@endsection