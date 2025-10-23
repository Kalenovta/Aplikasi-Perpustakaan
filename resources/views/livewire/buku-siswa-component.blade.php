<div class="container-fluid py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-4">Daftar Buku</h2>
            <div class="input-group mb-4">
                <input type="text" class="form-control" placeholder="Cari buku, penulis, atau penerbit..." 
                       wire:model.live="cari">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($buku as $book)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm book-card">
                    <div class="book-image-container">
                        @if($book->foto)
                            <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->judul }}" 
                                 class="card-img-top book-image">
                        @else
                            <div class="card-img-top book-image-placeholder d-flex align-items-center justify-content-center">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title book-title" title="{{ $book->judul }}">
                            {{ Str::limit($book->judul, 50) }}
                        </h6>
                        
                        <p class="card-text small mb-2">
                            <strong >Kategori:</strong> 
                            <span class="badge bg-info text-light ">{{ $book->kategori->nama ?? 'N/A' }}</span>
                        </p>
                        
                        <p class="card-text  small mb-3">
                            <strong>Stok:</strong> 
                            <span class="badge  {{ $book->jumlah > 0 ? 'bg-success' : 'bg-danger' }} text-light ">
                                {{ $book->jumlah }} tersedia
                            </span>
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-sm btn-primary"
                                        wire:click="pinjamBuku({{ $book->id }})"
                                        {{ $book->jumlah <= 0 ? 'disabled' : '' }}
                                        data-toggle="modal" data-target="#confirmPinjamModal">
                                    <i class="fas fa-download me-1"></i> Pinjam
                                </button>
                                
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                    <strong>Tidak ada buku ditemukan</strong>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            {{ $buku->links() }}
        </div>
    </div>

    <!-- Modal Konfirmasi Pinjam -->
    <div class="modal fade" id="confirmPinjamModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Peminjaman</h5>
                </div>
                <div class="modal-body">
                    @if($selectedBukuId)
                        @php
                            $selectedBook = \App\Models\Buku::find($selectedBukuId);
                        @endphp
                        @if($selectedBook)
                            <p>Apakah Anda yakin ingin meminjam buku berikut?</p>
                            <div class="alert alert-info    ">
                                <strong>{{ $selectedBook->judul }}</strong><br>
                                <small>Penulis: {{ $selectedBook->penulis }}</small><br>
                                <small>Durasi peminjaman: <strong>7 hari</strong></small><br>
                                <small>Batas pengembalian: <strong>{{ \Carbon\Carbon::today()->addDays(7)->format('d M Y') }}</strong></small>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="confirmPinjam()">Ya, Pinjam Buku</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .book-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
        }

        .book-image-container {
            height: 280px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .book-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .book-image-placeholder {
            width: 100%;
            height: 100%;
            background-color: #f0f0f0;
        }

        .book-title {
            min-height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
</div>