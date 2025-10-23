<div>
    <div class="card">
  <div class="card-header">
    Kelola Kategori Buku
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
                    <th scope="col">Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->nama }}</td>
                    <td>
                        <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPage">Ubah</a>
                        <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#deletePage">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $kategori->links() }}
     </div>
     <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addPage">Tambah</a>
  </div>
</div>
            <!-- TAMBAH -->
    <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="nama" value="{{ @old('nama') }}">
                        @error('nama')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" wire:model="deskripsi" value="{{ @old('deskripsi') }}">
                        @error('deskripsi')
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
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="name" value="{{ @old('nama') }}">
                        @error('nama')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" wire:model="deskripsi" value="{{ @old('deskripsi') }}">
                        @error('deskripsi')
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
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
