<div class="card">
    <div class="card-header">Daftar Pengajuan Pinjam</div>
    <div class="card-body">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Buku</th>
                        <th>Kategori</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pinjam as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->buku->judul }}</td>
                        <td>{{ $data->buku->kategori->nama }}</td>
                        <td>{{ $data->tgl_pinjam }}</td>
                        <td>{{ $data->tgl_batas }}</td>
                        <td>
                            @if($data->status == 'menunggu')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($data->status == 'dipinjam')
                                <span class="badge badge-success">Disetujui</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if($data->status == 'menunggu')
                                <button wire:click="setujui({{ $data->id }})" class="btn btn-sm btn-success">Setujui</button>
                                <button wire:click="tolak({{ $data->id }})" class="btn btn-sm btn-danger">Tolak</button>
                            @else
                                <small>-</small>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pinjam->links() }}
        </div>
    </div>
</div>

