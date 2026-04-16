<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('sbadmin/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

<!-- 🔥 NAVBAR -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="/">Perpustakaan</a>

    <button class="btn btn-link btn-sm" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">

    <!-- 🔥 SIDEBAR -->
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark">

            <div class="sb-sidenav-menu">
                <div class="nav">

                    <div class="sb-sidenav-menu-heading">Menu</div>

                    <a class="nav-link" href="/">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>

                    <a class="nav-link" href="{{ route('buku.index') }}">
                        <i class="fas fa-book me-2"></i> Buku
                    </a>

                    <a class="nav-link" href="{{ route('anggota.index') }}">
                        <i class="fas fa-users me-2"></i> Anggota
                    </a>

                    <a class="nav-link" href="{{ route('kategori.index') }}">
                        <i class="fas fa-tags me-2"></i> Kategori
                    </a>

                </div>
            </div>

            <div class="sb-sidenav-footer">
                <div class="small">Login sebagai:</div>
                {{ auth()->user()->name ?? 'Guest' }}
            </div>

        </nav>
    </div>

    <!-- 🔥 CONTENT -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mt-4">

                {{-- 🔥 ALERT --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- 🔥 ISI HALAMAN --}}
                @yield('content')

            </div>
        </main>

        <!-- 🔥 FOOTER -->
        <footer class="py-3 bg-light mt-auto">
            <div class="container-fluid text-center small">
                &copy; Perpustakaan {{ date('Y') }}
            </div>
        </footer>
    </div>
</div>

<!-- 🔥 SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('sbadmin/js/scripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>

@stack('scripts')

</body>
</html>