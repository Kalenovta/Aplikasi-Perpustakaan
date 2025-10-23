<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan -Sekolah' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body>
    <nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        
        <div class="sidebar-header">
            <h3>Perpustakaan</h3>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/guru">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#books') ? 'active' : '' }}" href="{{ route('bukuguru')}}">
                    <span data-feather="book"></span>
                    Lihat Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#loans') ? 'active' : '' }}" href="{{ route('pinjamguru')}}">
                    <span data-feather="file"></span>
                    Daftar Pinjaman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#returns') ? 'active' : '' }}" href="{{ route('pengembalianguru') }}">
                    <span data-feather="check-circle"></span>
                    Manage Returns
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#categories') ? 'active' : '' }}" href="{{ route('kategoriguru') }}">
                    <span data-feather="tag"></span>
                    Manage Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}">
                    <span data-feather="log-out" class=""></span>
                   Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
    <div class="container-fluid">
        <div class="row">

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 main-content">
                <button class="btn d-md-none menu-toggle">
                    <span data-feather="menu"></span>
                </button>

                <div class="page-header">
                    <h1 class="h2">Dashboard</h1>
                    
                    @auth
                    <div class="user-profile dropdown">
                        <a class="dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="user-name">Selamat Datang, {{ Auth::user()->name }}</span>
                            <span data-feather="user"></span>
                            <span data-feather="chevron-down" style="width:20px; height:20px; margin-left:5px;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <span data-feather="user" class="mr-2"></span> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                <span data-feather="log-out" class="mr-2"></span> Logout
                            </a>
                        </div>
                    </div>
                    @endauth

                </div>
                
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();

        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('open');
        });
    </script>
</body>
</html>