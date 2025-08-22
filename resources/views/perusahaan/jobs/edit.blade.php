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
                        ✏️ Edit Lowongan Kerja
                    </h2>
                    <p class="text-muted mb-0">Perbarui informasi lowongan kerja</p>
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
                        <i class="fas fa-edit me-2"></i>
                        Form Edit Lowongan
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

                    <form action="{{ route('perusahaan.jobs.update', $job->id) }}" method="POST" id="editJobForm">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Posisi -->
                            <div class="col-md-6 mb-4">
                                <label for="posisi" class="form-label fw-bold">
                                    <i class="fas fa-user-tie me-2 text-primary"></i>Posisi Pekerjaan
                                </label>
                                <input type="text" 
                                       name="posisi" 
                                       id="posisi" 
                                       class="form-control form-control-lg @error('posisi') is-invalid @enderror" 
                                       value="{{ old('posisi', $job->posisi) }}" 
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
                                </label>
                                <input type="text" 
                                       name="perusahaan" 
                                       id="perusahaan" 
                                       class="form-control form-control-lg @error('perusahaan') is-invalid @enderror" 
                                       value="{{ old('perusahaan', $job->perusahaan) }}" 
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
                                </label>
                                <input type="date" 
                                       name="tanggal_tutup" 
                                       id="tanggal_tutup" 
                                       class="form-control form-control-lg @error('tanggal_tutup') is-invalid @enderror" 
                                       value="{{ old('tanggal_tutup', \Carbon\Carbon::parse($job->tanggal_tutup)->format('Y-m-d')) }}" 
                                       min="{{ date('Y-m-d') }}"
                                       style="border-radius: 12px; border: 2px solid #e9ecef;"
                                       required>
                                @error('tanggal_tutup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div class="col-md-6 mb-4">
                                <label for="lokasi" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Lokasi
                                </label>
                                <input type="text" 
                                       name="lokasi" 
                                       id="lokasi" 
                                       class="form-control form-control-lg @error('lokasi') is-invalid @enderror" 
                                       value="{{ old('lokasi', $job->lokasi) }}" 
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
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light" style="border-radius: 12px 0 0 12px; border: 2px solid #e9ecef; border-right: none;">
                                    Rp
                                </span>
                                <input type="text" 
                                       name="gaji" 
                                       id="gaji" 
                                       class="form-control @error('gaji') is-invalid @enderror" 
                                       value="{{ old('gaji', number_format($job->gaji, 0, ',', '.')) }}" 
                                       placeholder="5.000.000"
                                       style="border-radius: 0 12px 12px 0; border: 2px solid #e9ecef; border-left: none;"
                                       required>
                                @error('gaji')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Gunakan titik (.) sebagai pemisah ribuan</small>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-secondary"></i>Deskripsi Pekerjaan
                            </label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="6"
                                      placeholder="Jelaskan detail pekerjaan, kualifikasi yang dibutuhkan, dan benefit yang ditawarkan..."
                                      style="border-radius: 12px; border: 2px solid #e9ecef; resize: vertical;"
                                      required>{{ old('deskripsi', $job->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 50 karakter</small>
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
                                <i class="fas fa-save me-2"></i>Update Lowongan
                            </button>
                        </div>
                    </form>
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
</style>
@endpush

@push('scripts')
<script>
    // Format gaji input dengan titik pemisah ribuan
    document.getElementById('gaji').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
            e.target.value = value;
        }
    });
    
    // Handle form submission with loading state
    document.getElementById('editJobForm').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.classList.add('btn-loading');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memperbarui...';
        submitBtn.disabled = true;
        
        // Remove dots from gaji before submission
        const gajiInput = document.getElementById('gaji');
        gajiInput.value = gajiInput.value.replace(/\./g, '');
    });
    
    // Character counter for description
    const deskripsiTextarea = document.getElementById('deskripsi');
    const createCounter = () => {
        const counter = document.createElement('small');
        counter.className = 'text-muted float-end';
        counter.id = 'deskripsi-counter';
        return counter;
    };
    
    let counter = createCounter();
    deskripsiTextarea.parentNode.insertBefore(counter, deskripsiTextarea.nextSibling);
    
    const updateCounter = () => {
        const count = deskripsiTextarea.value.length;
        counter.textContent = `${count} karakter`;
        if (count < 50) {
            counter.className = 'text-danger float-end';
        } else {
            counter.className = 'text-success float-end';
        }
    };
    
    deskripsiTextarea.addEventListener('input', updateCounter);
    updateCounter(); // Initial count
</script>
@endpush
@endsection