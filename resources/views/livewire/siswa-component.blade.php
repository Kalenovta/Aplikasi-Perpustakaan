<div>

     <div class="card">
    <div class="card-body">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="#" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#addPage">Ajukan Pinjaman</a>
        <div class="">
        <div class="card-header">Daftar Pinjaman Saya</div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjamanku as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($data->buku->foto)
                                        <img src="{{ asset('storage/'.$data->buku->foto) }}" width="50">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>{{ $data->buku->judul }}</td>
                                <td>{{ $data->buku->kategori->nama }}</td>
                                <td>{{ $data->tgl_pinjam }}</td>
                                <td>{{ $data->tgl_batas }}</td>
                                <td>
                                    @if($data->pengembalian) 
                                        <span class="badge badge-info">Dikembalikan</span>
                                    @elseif($data->status == 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($data->status == 'dipinjam')
                                        <span class="badge badge-success">Dipinjam</span>
                                    @elseif($data->status == 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($data->status == 'ditolak' || $data->pengembalian)
                                    <a href="#" wire:click="confirmDelete({{ $data->id }})" class="btn btn-sm btn-danger"  title="Hapus Riwayat"  data-toggle="modal" data-target="#deletePage">Hapus</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pinjamanku->links() }}
            </div>
        {{ $buku->links() }}    
    </div>

  </div>
</div>
            <!-- PINJAM -->
    <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form>
                    <div class="form-group">
                        <label>tanggal pinjam</label>
                        <input type="date" class="form-control" wire:model="tgl_pinjam" value="{{ @old('tgl_pinjam') }}">
                        @error('tgl_pinjam')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>tanggal kembali</label>
                        <input type="date" class="form-control" wire:model="tgl_batas" value="{{ @old('tgl_batas') }}">
                        @error('tgl_batas')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <label>Pilih Buku</label>
                    <select class="form-control" wire:model="buku_id">
                        <option value="">-- Pilih Buku --</option>
                        @foreach($buku as $item)
                            <option value="{{ $item->id }}">{{ $item->judul }}</option>
                        @endforeach
                    </select>
                    @error('buku_id') <small class="text-danger">{{ $message }}</small> @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="store" class="btn btn-primary" >Save</button>
            </div>
            </div>
        </div>
    </div>
    <!-- HAPUS -->
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin nih mau di hapus??</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" wire:click="destroy" class="btn btn-danger" data-dismiss="modal">Ya, Hapus</button>
            </div>
            </div>
        </div>
    </div>
    
</div>
