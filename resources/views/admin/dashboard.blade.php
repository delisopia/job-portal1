<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Lowongan Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --sidebar-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --content-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: var(--sidebar-bg);
            padding: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            color: white;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar-header .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            margin: 2px 0;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #fff;
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: #fff;
            color: white;
        }

        .sidebar-menu a i {
            width: 20px;
            margin-right: 15px;
            font-size: 1.1rem;
        }

        .sidebar-bottom {
            position: absolute;
            bottom: 20px;
            width: 100%;
            padding: 0 20px;
        }

        .sidebar-bottom a {
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logout-btn {
            background-color: rgba(231, 76, 60, 0.2);
            color: #fff;
            border: 1px solid rgba(231, 76, 60, 0.5);
        }

        .logout-btn:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }

        .whatsapp-btn {
            background-color: rgba(39, 174, 96, 0.2);
            color: #fff;
            border: 1px solid rgba(39, 174, 96, 0.5);
        }

        .whatsapp-btn:hover {
            background-color: var(--success-color);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation */
        .top-navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
        }

        .navbar-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .datetime {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .welcome-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-card p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        /* Stats Cards */
        .stats-row {
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card.jobs {
            border-left-color: var(--secondary-color);
        }

        .stat-card.applications {
            border-left-color: var(--success-color);
        }

        .stat-card.pending {
            border-left-color: var(--warning-color);
        }

        .stat-card.active {
            border-left-color: var(--accent-color);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.jobs {
            background-color: var(--secondary-color);
        }

        .stat-icon.applications {
            background-color: var(--success-color);
        }

        .stat-icon.pending {
            background-color: var(--warning-color);
        }

        .stat-icon.active {
            background-color: var(--accent-color);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .stat-label {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .quick-actions h5 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .action-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            margin: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            text-align: center;
            font-weight: 500;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 20px;
            }

            .welcome-card h2 {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-briefcase"></i> JobPortal</h4>
            <div class="subtitle">Admin Panel</div>
        </div>

        <nav class="sidebar-menu">
            <a href="{{ url('/admin/dashboard') }}" class="active">
                <i class="fas fa-chart-dashboard"></i>
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ url('/jobs') }}">
                <i class="fas fa-list-alt"></i>
                <span>Data Lowongan</span>
            </a>
            <a href="{{ url('admin/jobs/create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Lowongan</span>
            </a>
            <a href="{{ url('admin/jobs') }}">
                <i class="fas fa-file-alt"></i>
                <span>Edit Lowongan</span>
            </a>
            <a href="{{ url('/admin/applications') }}">
                <i class="fas fa-file-alt"></i>
                <span>Data Pelamar</span>
            </a>
            <a href="{{ url('/admin/laporan') }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
            @endif

            @if(auth()->user()->role === 'perusahaan')
            <a href="{{ url('/jobs') }}">
                <i class="fas fa-list-alt"></i>
                <span>Lowongan Saya</span>
            </a>
            <a href="{{ url('perusahaan/jobs/create') }}">
                <i class="fas fa-plus-circle"></i>
                <span>Buat Lowongan</span>
            </a>
            <a href="{{ url('/perusahaan/applications') }}">
                <i class="fas fa-users"></i>
                <span>Pelamar</span>
            </a>
            @endif
        </nav>


        <div class="sidebar-bottom">
    <!-- User bebas isi nomor WA siapa saja -->
    <input type="text" id="waNumber" class="form-control mb-2" placeholder="Nomor WA (contoh: 81234567890)">
    
    <!-- User juga bisa isi pesan bebas -->
    <textarea id="waMessage" class="form-control mb-2" rows="2" placeholder="Tulis pesan..."></textarea>
    
    <a href="#" onclick="sendWA()" class="whatsapp-btn">
        <i class="fab fa-whatsapp"></i>
        <span>Kirim WA</span>
    </a>
    <a href="{{ url('/login') }}" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>
</div>

<script>
function sendWA() {
    let number = document.getElementById("waNumber").value.trim();
    let message = document.getElementById("waMessage").value.trim();

    if (number) {
        // Hapus karakter non angka (spasi, tanda - dll)
        number = number.replace(/\D/g, "");

        // Kalau belum ada kode negara, otomatis tambahkan 62
        if (!number.startsWith("62")) {
            number = "62" + number;
        }

        // Encode pesan agar aman untuk URL
        let encodedMessage = encodeURIComponent(message || "Halo!");

        // Buka WA dengan nomor & pesan sesuai input user
        window.open("https://wa.me/" + number + "?text=" + encodedMessage, "_blank");
    } else {
        alert("Masukkan nomor WhatsApp terlebih dahulu!");
    }
}
</script>

    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-navbar">
            <h1 class="navbar-brand">
                <i class="fas fa-building"></i>
                PT. Karir Bersama
            </h1>
            <div class="navbar-info">
                <div class="datetime" id="datetime">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="current-time"></span>
                </div>
                <div class="admin-profile">
                    <div class="admin-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <span>
                        @if(Auth::user()->isAdmin())
                        Admin
                        @elseif(Auth::user()->isPerusahaan())
                        Perusahaan
                        @else
                        {{ Auth::user()->name }}
                        @endif
                    </span>
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Welcome Card -->
            <div class="welcome-card fade-in">
                @if(auth()->user()->role === 'admin')
                <h2>Selamat Datang, Admin!</h2>
                <p>Kelola sistem lowongan kerja dengan mudah dan efisien melalui dashboard ini.</p>
                @elseif(auth()->user()->role === 'perusahaan')
                <h2>Selamat Datang, {{ auth()->user()->name }}!</h2>
                <p>Kelola lowongan pekerjaan dan pantau pelamar di sini.</p>
                @endif
            </div>


            <!-- Statistics Row -->
            @if(auth()->user()->role === 'admin')
            {{-- Statistik untuk Admin --}}
            <div class="row stats-row fade-in">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card jobs">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $totalLowongan }}</h3>
                                <p class="stat-label">Total Lowongan</p>
                            </div>
                            <div class="stat-icon jobs">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card applications">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $totalApplications }}</h3>
                                <p class="stat-label">Total Pelamar</p>
                            </div>
                            <div class="stat-icon applications">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card pending">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $pendingApplications }}</h3>
                                <p class="stat-label">Pending Review</p>
                            </div>
                            <div class="stat-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card active">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $activeJobs }}</h3>
                                <p class="stat-label">Lowongan Aktif</p>
                            </div>
                            <div class="stat-icon active">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @elseif(auth()->user()->role === 'perusahaan')
            {{-- Statistik untuk Perusahaan --}}
            <div class="row stats-row fade-in">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card jobs">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $totalJobs }}</h3>
                                <p class="stat-label">Lowongan Saya</p>
                            </div>
                            <div class="stat-icon jobs">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card applications">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $totalApplications }}</h3>
                                <p class="stat-label">Pelamar ke Lowongan Saya</p>
                            </div>
                            <div class="stat-icon applications">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card pending">
                        <div class="stat-header">
                            <div>
                                <h3 class="stat-number">{{ $pendingApplications }}</h3>
                                <p class="stat-label">Menunggu Review</p>
                            </div>
                            <div class="stat-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Statistics Row End -->

            <!-- Quick Actions -->
            @if(auth()->user()->role === 'admin')
            <div class="quick-actions fade-in">
                <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                <div class="d-flex flex-wrap">
                    <a href="{{ url('/admin/jobs/create') }}" class="action-btn">
                        <i class="fas fa-plus"></i> Buat Lowongan Baru
                    </a>
                    <a href="{{ url('/admin/applications') }}" class="action-btn">
                        <i class="fas fa-eye"></i> Lihat Pelamar Terbaru
                    </a>
                    <a href="{{ url('/admin/applications') }}" class="action-btn">
                        <i class="fas fa-download"></i> Unduh Laporan
                    </a>
                    <a href="{{ url('/jobs') }}" class="action-btn">
                        <i class="fas fa-edit"></i> Kelola Lowongan
                    </a>
                </div>
            </div>
            @endif

            @if(auth()->user()->role === 'perusahaan')
            <div class="quick-actions fade-in">
                <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                <div class="d-flex flex-wrap">
                    <a href="{{ url('/perusahaan/jobs/create') }}" class="action-btn">
                        <i class="fas fa-plus"></i> Buat Lowongan Baru
                    </a>
                    <a href="{{ url('/admin/applications') }}" class="action-btn">
                        <i class="fas fa-eye"></i> Lihat Pelamar
                    </a>
                    <a href="{{ url('/perusahaan/jobs') }}" class="action-btn">
                        <i class="fas fa-edit"></i> Kelola Lowongan Saya
                    </a>
                </div>
            </div>
            @endif
            <!-- Quick Actions End -->
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <i class="fas fa-heart text-danger"></i>
                &copy; <span id="current-year"></span> PT. Karir Bersama | Sistem Lowongan Kerja | Built with
                <i class="fas fa-code"></i>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
            document.getElementById('current-year').textContent = now.getFullYear();
        }

        // Initialize
        updateTime();
        setInterval(updateTime, 1000);

        // Animate numbers
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const target = parseInt(number.textContent);
                let current = 0;
                const increment = target / 30;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        number.textContent = target;
                        clearInterval(timer);
                    } else {
                        number.textContent = Math.floor(current);
                    }
                }, 50);
            });
        }

        // Start animation when page loads
        window.addEventListener('load', animateNumbers);

        // Mobile sidebar toggle (if needed)
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>

</body>

</html>