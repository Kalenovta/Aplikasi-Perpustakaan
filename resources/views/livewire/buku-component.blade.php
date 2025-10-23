<div>
    <div class="card">
  <div class="card-header">
    Kelola Buku
  </div>
  <div class="card-body">
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    <input type="text" wire:model.live="cari" class="form-control w-50" placeholder="cari...">
     <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                  <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">penerbit</th>
                    <th scope="col">tahun</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        @if ($data->foto)
                            <a href="{{ asset('storage/'.$data->foto) }}" target="_blank">
                                <img src="{{ asset('storage/'.$data->foto) }}" alt="Sampul" width="50">
                            </a>
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $data->judul }}</td>
                    <td>{{ $data->kategori->nama }}</td>
                    <td>{{ $data->penulis}}</td>
                    <td>{{ $data->penerbit}}</td>
                    <td>{{ $data->tahun}}</td>
                    <td>
                        <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#editPage">Ubah</a>
                        <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#deletePage">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $buku->links() }}
     </div>
     <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPage">Tambah</a>
  </div>
</div>
            <!-- TAMBAH -->
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
                        <label>Judul</label>
                        <input type="text" class="form-control" wire:model="judul" value="{{ @old('judul') }}">
                        @error('judul')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select wire:model="kategori" id="" class="form-control">
                            <option value="">--Pilih--</option>
                            @foreach ($categori as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('categori')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" wire:model="penulis" value="{{ @old('penulis') }}">
                        @error('penulis')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input type="text" class="form-control" wire:model="penerbit" value="{{ @old('penerbit') }}">
                        @error('penerbit')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" wire:model="isbn" value="{{ @old('penulis') }}">
                        @error('isbn')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input type="text" class="form-control" wire:model="jumlah" value="{{ @old('penulis') }}">
                        @error('jumlah')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Foto Sampul</label>
                        <input type="file" class="form-control" wire:model="foto">
                        @error('foto') 
                            <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                        @if ($foto)
                            <img src="{{ $foto->temporaryUrl() }}" alt="Preview" class="img-fluid mt-2" width="100">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" class="form-control" wire:model="tahun" value="{{ @old('penulis') }}">
                        @error('tahun')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="store" class="btn btn-primary" >Save</button>
            </div>
            </div>
        </div>
    </div>
     <!-- EDIT -->
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" wire:model="judul" value="{{ @old('judul') }}">
                        @error('judul')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select wire:model="kategori" id="" class="form-control">
                            <option value="">--Pilih--</option>
                            @foreach ($categori as $data)
                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        @error('categori')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Penulis</label>
                        <input type="text" class="form-control" wire:model="penulis" value="{{ @old('penulis') }}">
                        @error('penulis')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input type="text" class="form-control" wire:model="penerbit" value="{{ @old('penerbit') }}">
                        @error('penerbit')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input type="text" class="form-control" wire:model="isbn" value="{{ @old('penulis') }}">
                        @error('isbn')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input type="text" class="form-control" wire:model="jumlah" value="{{ @old('penulis') }}">
                        @error('jumlah')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="date" class="form-control" wire:model="tahun" value="{{ @old('penulis') }}">
                        @error('tahun')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="update" class="btn btn-primary" >Save</button>
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
                <button type="button" wire:click="destroy" class="btn  btn-danger" data-dismiss="modal">Hapus</button>
            </div>
            </div>
        </div>
    </div>
</div>
