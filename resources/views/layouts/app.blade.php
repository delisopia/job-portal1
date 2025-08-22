<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Job Portal')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Biar link Lowongan tulisannya hitam */
        .navbar .nav-lowongan {
            color: black !important;
            font-weight: bold;
        }
        /* Efek hover keren */
        .navbar .nav-lowongan:hover {
            color: #ff9800 !important;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm"
        style="background-color:rgb(60, 58, 204); padding-top: 1rem; padding-bottom: 1rem; font-size: 1.25rem;">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ route('home') }}">
                <i class="fas fa-briefcase"></i> Job Portal
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Nav -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('jobs.index') }}">Lowongan</a>
                    </li>
                </ul>

                <!-- Right Nav -->
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Daftar</a>
                    </li>
                    @else
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            </li>
                        @elseif(Auth::user()->isPerusahaan())
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('perusahaan.dashboard') }}">Dashboard Perusahaan</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5 border-top">
        <div class="container text-center">
            <small class="text-muted">&copy; {{ date('Y') }} Job Portal. All rights reserved.</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
