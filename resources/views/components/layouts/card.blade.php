<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="dashboard" class="mb-4">
    <h2>Overview</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card primary">
                <div class="icon-container">
                    <span data-feather="users"></span>
                </div>
                <div class="info-container">
                    <h5 class="stat-title">{{ $jumlahUser }}</h5>
                    <p class="stat-text">Active Members</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card success">
                <div class="icon-container">
                    <span data-feather="book"></span>
                </div>
                <div class="info-container">
                    <h5 class="stat-title">{{ $jumlahBuku }}</h5>
                    <p class="stat-text">Available Books</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card warning">
                <div class="icon-container">
                    <span data-feather="file-text"></span>
                </div>
                <div class="info-container">
                    <h5 class="stat-title">{{ $jumlahPinjam }}</h5>
                    <p class="stat-text">Books on Loan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card danger">
                <div class="icon-container">
                    <span data-feather="clock"></span>
                </div>
                <div class="info-container">
                    <h5 class="stat-title">{{ $jumlahKembali }}</h5>
                    <p class="stat-text">Total Kategori</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>