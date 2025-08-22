@extends('layouts.app')

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
            <li class="breadcrumb-item active" aria-current="page">Tambah Lowongan</li>
        </ol>
    </nav>

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-2 text-gray-800">
                <i class="fas fa-plus-circle me-2"></i>Tambah Lowongan Kerja Baru
            </h1>
            <p class="text-muted">Buat lowongan kerja baru untuk menarik kandidat terbaik</p>
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
                        <i class="fas fa-plus me-2"></i>Form Lowongan Baru
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

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-check-circle me-2"></i>Berhasil!</strong>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('jobs.store') }}" method="POST" id="createJobForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="posisi" class="form-label">
                                        <i class="fas fa-briefcase me-1"></i>Posisi *
                                    </label>
                                    <input type="text" 
                                           name="posisi" 
                                           id="posisi"
                                           value="{{ old('posisi') }}" 
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
                                           value="{{ old('perusahaan') }}" 
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
                                           value="{{ old('lokasi') }}" 
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
                                           value="{{ old('tanggal_tutup') }}" 
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
                                      required>{{ old('deskripsi') }}</textarea>
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
                                    <i class="fas fa-cogs me-2"></i>Informasi Tambahan (Opsional)
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="gaji_min" class="form-label">
                                                <i class="fas fa-money-bill-wave me-1"></i>Gaji Min
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" 
                                                       name="gaji_min" 
                                                       id="gaji_min"
                                                       value="{{ old('gaji_min') }}" 
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
                                                <i class="fas fa-money-bill-wave me-1"></i>Gaji Max
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" 
                                                       name="gaji_max" 
                                                       id="gaji_max"
                                                       value="{{ old('gaji_max') }}" 
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
                                                <i class="fas fa-laptop me-1"></i>Tipe Kerja
                                            </label>
                                            <select name="tipe_kerja" 
                                                    id="tipe_kerja" 
                                                    class="form-control @error('tipe_kerja') is-invalid @enderror">
                                                <option value="">Pilih Tipe Kerja</option>
                                                <option value="full-time" {{ old('tipe_kerja') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                                <option value="part-time" {{ old('tipe_kerja') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                                <option value="contract" {{ old('tipe_kerja') == 'contract' ? 'selected' : '' }}>Contract</option>
                                                <option value="freelance" {{ old('tipe_kerja') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                                <option value="internship" {{ old('tipe_kerja') == 'internship' ? 'selected' : '' }}>Magang</option>
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
                                                <option value="fresh-graduate" {{ old('pengalaman') == 'fresh-graduate' ? 'selected' : '' }}>Fresh Graduate</option>
                                                <option value="1-year" {{ old('pengalaman') == '1-year' ? 'selected' : '' }}>1 Tahun</option>
                                                <option value="2-years" {{ old('pengalaman') == '2-years' ? 'selected' : '' }}>2 Tahun</option>
                                                <option value="3-years" {{ old('pengalaman') == '3-years' ? 'selected' : '' }}>3 Tahun</option>
                                                <option value="5-years" {{ old('pengalaman') == '5-years' ? 'selected' : '' }}>5+ Tahun</option>
                                            </select>
                                            @error('pengalaman')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="submit" class="btn btn-success" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Simpan Lowongan
                                </button>
                                <a href="{{ route('jobs.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                            <div>
                                <button type="button" class="btn btn-warning" onclick="resetForm()">
                                    <i class="fas fa-undo me-2"></i>Reset Form
                                </button>
                                <button type="button" class="btn btn-info" onclick="previewData()">
                                    <i class="fas fa-eye me-2"></i>Preview
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Tips Card -->
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

            <!-- Template Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clipboard-list me-2"></i>Template Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Gunakan template untuk mempercepat pengisian:</p>
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="fillTemplate('developer')">
                            <i class="fas fa-code me-2"></i>Developer
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="fillTemplate('marketing')">
                            <i class="fas fa-chart-line me-2"></i>Marketing
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="fillTemplate('admin')">
                            <i class="fas fa-user-tie me-2"></i>Admin
                        </button>
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
                    <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-sm btn-block mb-2">
                        <i class="fas fa-list me-2"></i>Semua Lowongan
                    </a>
                    <button type="button" class="btn btn-info btn-sm btn-block mb-2" onclick="saveDraft()">
                        <i class="fas fa-save me-2"></i>Simpan Draft
                    </button>
                    <button type="button" class="btn btn-warning btn-sm btn-block" onclick="loadDraft()">
                        <i class="fas fa-folder-open me-2"></i>Muat Draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">
                    <i class="fas fa-eye me-2"></i>Preview Lowongan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="previewContent">
                <!-- Preview content will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="submitFormFromPreview()">
                    <i class="fas fa-save me-2"></i>Simpan Lowongan
                </button>
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

.input-group-text {
    background-color: #e9ecef;
    border-color: #ced4da;
}

.d-grid {
    display: grid !important;
}

.gap-2 {
    gap: 0.5rem !important;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    const form = document.getElementById('createJobForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});

function resetForm() {
    if (confirm('Apakah Anda yakin ingin mereset form? Semua data akan hilang.')) {
        document.getElementById('createJobForm').reset();
        // Update character count
        document.getElementById('charCount').textContent = '0';
    }
}

function previewData() {
    const posisi = document.getElementById('posisi').value || 'Tidak diisi';
    const perusahaan = document.getElementById('perusahaan').value || 'Tidak diisi';
    const lokasi = document.getElementById('lokasi').value || 'Tidak diisi';
    const tanggal_tutup = document.getElementById('tanggal_tutup').value || 'Tidak diisi';
    const deskripsi = document.getElementById('deskripsi').value || 'Tidak diisi';
    const gaji_min = document.getElementById('gaji_min').value || '0';
    const gaji_max = document.getElementById('gaji_max').value || '0';
    const tipe_kerja = document.getElementById('tipe_kerja').value || 'Tidak diisi';
    const pengalaman = document.getElementById('pengalaman').value || 'Tidak diisi';
    
    // Format salary display
    const formatGaji = (min, max) => {
        if (min === '0' && max === '0') return 'Tidak dicantumkan';
        if (min !== '0' && max !== '0') return `Rp ${parseInt(min).toLocaleString('id-ID')} - Rp ${parseInt(max).toLocaleString('id-ID')}`;
        if (min !== '0') return `Mulai dari Rp ${parseInt(min).toLocaleString('id-ID')}`;
        if (max !== '0') return `Hingga Rp ${parseInt(max).toLocaleString('id-ID')}`;
        return 'Tidak dicantumkan';
    };
    
    // Format work type display
    const formatTipeKerja = (tipe) => {
        const types = {
            'full-time': 'Full Time',
            'part-time': 'Part Time',
            'contract': 'Contract',
            'freelance': 'Freelance',
            'internship': 'Magang'
        };
        return types[tipe] || tipe;
    };
    
    // Format experience display
    const formatPengalaman = (exp) => {
        const experiences = {
            'fresh-graduate': 'Fresh Graduate',
            '1-year': '1 Tahun',
            '2-years': '2 Tahun',
            '3-years': '3 Tahun',
            '5-years': '5+ Tahun'
        };
        return experiences[exp] || exp;
    };
    
    const previewContent = `
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-primary">${posisi}</h3>
                <h5 class="text-muted mb-3">${perusahaan}</h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i><strong>Lokasi:</strong> ${lokasi}</p>
                        <p class="mb-2"><i class="fas fa-calendar-alt text-info me-2"></i><strong>Tutup:</strong> ${tanggal_tutup}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><i class="fas fa-laptop text-success me-2"></i><strong>Tipe:</strong> ${formatTipeKerja(tipe_kerja)}</p>
                        <p class="mb-2"><i class="fas fa-star text-warning me-2"></i><strong>Pengalaman:</strong> ${formatPengalaman(pengalaman)}</p>
                    </div>
                </div>
                
                <div class="alert alert-info mb-3">
                    <h6 class="mb-2"><i class="fas fa-money-bill-wave me-2"></i>Gaji:</h6>
                    <strong>${formatGaji(gaji_min, gaji_max)}</strong>
                </div>
                
                <div class="mb-3">
                    <h6><i class="fas fa-align-left me-2"></i>Deskripsi Pekerjaan:</h6>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-0">${deskripsi.replace(/\n/g, '<br>')}</p>
                    </div>
                </div>
                
                <div class="text-center">
                    <span class="badge badge-primary">Preview Mode</span>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('previewContent').innerHTML = previewContent;
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}

function submitFormFromPreview() {
    document.getElementById('createJobForm').submit();
}

function fillTemplate(type) {
    const templates = {
        developer: {
            posisi: 'Software Developer',
            perusahaan: 'PT. Teknologi Indonesia',
            lokasi: 'Jakarta, Indonesia',
            deskripsi: 'Kami mencari Software Developer yang berpengalaman untuk bergabung dengan tim kami.\n\nTanggung Jawab:\n- Mengembangkan aplikasi web dan mobile\n- Melakukan testing dan debugging\n- Berkolaborasi dengan tim\n\nKualifikasi:\n- S1 Teknik Informatika atau sejenis\n- Menguasai PHP, JavaScript, MySQL\n- Pengalaman minimal 2 tahun',
            gaji_min: '8000000',
            gaji_max: '15000000',
            tipe_kerja: 'full-time',
            pengalaman: '2-years'
        },
        marketing: {
            posisi: 'Marketing Executive',
            perusahaan: 'PT. Pemasaran Digital',
            lokasi: 'Bandung, Indonesia',
            deskripsi: 'Bergabunglah dengan tim marketing kami untuk mengembangkan strategi pemasaran yang inovatif.\n\nTanggung Jawab:\n- Membuat strategi marketing\n- Mengelola social media\n- Menganalisis data marketing\n\nKualifikasi:\n- S1 Marketing atau sejenis\n- Kreatif dan inovatif\n- Menguasai digital marketing',
            gaji_min: '5000000',
            gaji_max: '10000000',
            tipe_kerja: 'full-time',
            pengalaman: '1-year'
        },
        admin: {
            posisi: 'Administrative Staff',
            perusahaan: 'PT. Administrasi Prima',
            lokasi: 'Surabaya, Indonesia',
            deskripsi: 'Mencari staff administrasi yang teliti dan bertanggung jawab.\n\nTanggung Jawab:\n- Mengelola dokumen perusahaan\n- Membantu kegiatan operasional\n- Melayani customer\n\nKualifikasi:\n- Min. D3 semua jurusan\n- Teliti dan detail oriented\n- Menguasai MS Office',
            gaji_min: '4000000',
            gaji_max: '7000000',
            tipe_kerja: 'full-time',
            pengalaman: 'fresh-graduate'
        }
    };
    
    const template = templates[type];
    if (template) {
        document.getElementById('posisi').value = template.posisi;
        document.getElementById('perusahaan').value = template.perusahaan;
        document.getElementById('lokasi').value = template.lokasi;
        document.getElementById('deskripsi').value = template.deskripsi;
        document.getElementById('gaji_min').value = template.gaji_min;
        document.getElementById('gaji_max').value = template.gaji_max;
        document.getElementById('tipe_kerja').value = template.tipe_kerja;
        document.getElementById('pengalaman').value = template.pengalaman;
        
        // Update character count
        document.getElementById('charCount').textContent = template.deskripsi.length;
    }
}

function saveDraft() {
    const formData = {
        posisi: document.getElementById('posisi').value,
        perusahaan: document.getElementById('perusahaan').value,
        lokasi: document.getElementById('lokasi').value,
        tanggal_tutup: document.getElementById('tanggal_tutup').value,
        deskripsi: document.getElementById('deskripsi').value,
        gaji_min: document.getElementById('gaji_minimal').value,
        gaji_max: document.getElementById('gaji_maxsimal').value,
        tipe_kerja: document.getElementById('tipe_kerja').value,
        pengalaman: document.getElementById('pengalaman').value
    };
    
    localStorage.setItem('job_draft', JSON.stringify(formData));
    alert('Draft berhasil disimpan!');
}

function loadDraft() {
    const draft = localStorage.getItem('job_draft');
    if (draft) {
        const formData = JSON.parse(draft);
        
        document.getElementById('posisi').value = formData.posisi || '';
        document.getElementById('perusahaan').value = formData.perusahaan || '';
        document.getElementById('lokasi').value = formData.lokasi || '';
        document.getElementById('tanggal_tutup').value = formData.tanggal_tutup || '';
        document.getElementById('deskripsi').value = formData.deskripsi || '';
        document.getElementById('gaji_minimal').value = formData.gaji_minimal || '';
        document.getElementById('gaji_maxsimal').value = formData.gaji_maxsimal || '';
        document.getElementById('tipe_kerja').value = formData.tipe_kerja || '';
        document.getElementById('pengalaman').value = formData.pengalaman || '';
        
        // Update character count
        document.getElementById('charCount').textContent = formData.deskripsi ? formData.deskripsi.length : 0;
        
        alert('Draft berhasil dimuat!');
    } else {
        alert('Tidak ada draft yang tersimpan.');
    }
}
</script>
@endpush
@endsection