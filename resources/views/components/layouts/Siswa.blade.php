<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>{{ $title ?? 'Perpustakaan -Sekolah' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1e293b;
            color: white;
            padding: 15px 30px;
        }
        .navbar .menu a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 500;
        }
        .navbar .menu a:hover {
            color: #38bdf8;
        }
    </style>
</head>
<body>
    <div class="navbar sticky-top">
        <div class="logo"><strong>Perpustakaan</strong></div>
        <div class="menu">
            <a href="{{ url('/BukuSiswa') }}">Buku</a>
            <a href="{{ url('/Siswa') }}">Pinjam</a>
            <a href="{{ url('/logout') }}">Logout</a>
        </div>
    </div>
    {{ $slot }}
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
