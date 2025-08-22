@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="card shadow-lg border-0 rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white p-4 border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="h3 mb-2 fw-bold text-white">{{ $job->posisi }}</h1>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-building me-2"></i>
                                <span class="h5 mb-0">{{ $job->perusahaan }}</span>
                            </div>
                        </div>
                        <div class="text-end">
                            @php
                            $deadline = \Carbon\Carbon::parse($job->tanggal_tutup);
                            $daysLeft = now()->diffInDays($deadline, false); // hasil bisa negatif jika lewat deadline
                            $isUrgent = $daysLeft <= 7 && $daysLeft>= 0;
                                @endphp
                                </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Job Info Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-3">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-geo-alt-fill text-primary fs-2"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Lokasi</h6>
                                        <p class="fw-semibold mb-0">{{ $job->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-3">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-briefcase-fill text-success fs-2"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Tipe Kerja</h6>
                                        <p class="fw-semibold mb-0">{{ $job->tipe_kerja }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-3">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-cash-stack text-warning fs-2"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Gaji</h6>
                                        @php
                                        $gajiMin = $job->gaji_min;
                                        $gajiMax = $job->gaji_max;
                                        @endphp
                                        <div class="fw-semibold">
                                            @if($gajiMin && $gajiMax)
                                            <div class="small">Rp {{ number_format($gajiMin, 0, ',', '.') }}</div>
                                            <div class="text-muted">s/d</div>
                                            <div class="small">Rp {{ number_format($gajiMax, 0, ',', '.') }}</div>
                                            @elseif($gajiMin)
                                            <div>Rp {{ number_format($gajiMin, 0, ',', '.') }}</div>
                                            @elseif($gajiMax)
                                            <div>Rp {{ number_format($gajiMax, 0, ',', '.') }}</div>
                                            @else
                                            <div class="text-muted">Nego</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm rounded-3">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-star-fill text-info fs-2"></i>
                                        </div>
                                        <h6 class="text-muted mb-1">Pengalaman</h6>
                                        <p class="fw-semibold mb-0">{{ $job->pengalaman }} Tahun</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Description -->
                        <div class="card shadow-sm border-0 rounded-4 mb-4">
                            <div class="card-header bg-light border-0 p-4">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="bi bi-file-text me-2 text-primary"></i>
                                    Deskripsi Pekerjaan
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="job-description">
                                    {!! nl2br(e($job->deskripsi)) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Quick Info -->
                        <div class="card shadow-sm border-0 rounded-4 mb-4">
                            <div class="card-header bg-light border-0 p-4">
                                <h5 class="mb-0 fw-bold text-dark">
                                    <i class="bi bi-info-circle me-2 text-primary"></i>
                                    Informasi Singkat
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    <small class="text-muted">Tanggal Tutup</small>
                                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($job->tanggal_tutup)->format('d M Y') }}</div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Dipublikasi</small>
                                    <div class="fw-semibold">{{ $job->created_at->diffForHumans() }}</div>
                                </div>
                                @if(isset($job->kategori))
                                <div class="mb-3">
                                    <small class="text-muted">Kategori</small>
                                    <div>
                                        <span class="badge bg-primary rounded-pill">{{ $job->kategori }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body p-4">
                                <div class="d-grid gap-3">
                                    <a href="{{ route('jobs.apply', $job->id) }}" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                        <i class="bi bi-send me-2"></i>
                                        Lamar Sekarang
                                    </a>
                                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary rounded-pill">
                                        <i class="bi bi-arrow-left me-2"></i>
                                        Kembali ke Daftar
                                    </a>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary rounded-pill dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-share me-2"></i>
                                            Bagikan Lowongan
                                        </button>
                                        <ul class="dropdown-menu w-100">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="shareToWhatsApp()">
                                                    <i class="bi bi-whatsapp text-success me-2"></i>
                                                    WhatsApp
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="shareJob()">
                                                    <i class="bi bi-share me-2"></i>
                                                    Share Lainnya
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="copyLink()">
                                                    <i class="bi bi-copy me-2"></i>
                                                    Salin Link
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .job-description {
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .badge {
            font-weight: 500;
        }

        .dropdown-menu {
            min-width: 100%;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .toast-container {
            z-index: 1055;
        }

        @media (max-width: 768px) {
            .card-header .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .card-header .text-end {
                margin-top: 1rem;
            }
        }
    </style>

    <script>
        function shareToWhatsApp() {
            const jobTitle = '{{ $job->posisi }}';
            const company = '{{ $job->perusahaan }}';
            const location = '{{ $job->lokasi }}';
            const deadline = '{{ \Carbon\Carbon::parse($job->tanggal_tutup)->format("d M Y") }}';
            const url = window.location.href;

            const message = `🔥 *LOWONGAN KERJA TERBARU* 🔥\n\n` +
                `📋 *Posisi:* ${jobTitle}\n` +
                `🏢 *Perusahaan:* ${company}\n` +
                `📍 *Lokasi:* ${location}\n` +
                `⏰ *Deadline:* ${deadline}\n\n` +
                `Tertarik? Lihat detail lengkap di:\n${url}\n\n` +
                `#LowonganKerja #Karir #Job`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/?text=${encodedMessage}`;

            window.open(whatsappUrl, '_blank');
        }

        function shareJob() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $job->posisi }} - {{ $job->perusahaan }}',
                    text: 'Lihat lowongan kerja menarik ini!',
                    url: window.location.href
                });
            } else {
                copyLink();
            }
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                // Show success message with Bootstrap toast
                showToast('Link berhasil disalin ke clipboard!', 'success');
            }).catch(function() {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = window.location.href;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showToast('Link berhasil disalin!', 'success');
            });
        }

        function showToast(message, type = 'info') {
            // Create toast container if it doesn't exist
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
                toastContainer.style.zIndex = '1055';
                document.body.appendChild(toastContainer);
            }

            // Create toast
            const toastId = 'toast-' + Date.now();
            const toastHtml = `
        <div id="${toastId}" class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'primary'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;

            toastContainer.insertAdjacentHTML('beforeend', toastHtml);

            // Initialize and show toast
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 3000
            });
            toast.show();

            // Remove toast element after it's hidden
            toastElement.addEventListener('hidden.bs.toast', function() {
                toastElement.remove();
            });
        }

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    @endsection