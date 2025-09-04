<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @include('components.layout.sidebar')

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