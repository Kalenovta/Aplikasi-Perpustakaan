<div>
    <div class="card">
  <div class="card-header">
    Kelola User
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
                    <th scope="col">Email</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">proses</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->role}}</td>
                    <td>
                        <a href="#" wire:click="edit({{ $data->id }})" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPage">Ubah</a>
                        <a href="#" wire:click="confirm({{ $data->id }})" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#deletePage">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $user->links() }}
     </div>
  </div>
</div>
     <!-- EDIT -->
    <div wire:ignore.self class="modal fade" id="editPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" wire:model="name" value="{{ @old('name') }}">
                        @error('name')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" wire:model="email" value="{{ @old('email') }}">
                        @error('email')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                   
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" wire:model="role" value="">
                            <option value="">-- Pilih Role --</option>
                            <option name="{{ @old('role') }}" value="admin">admin</option>
                            <option name="{{ @old('role') }}" value="guru">Guru</option>
                            <option Name="{{ @old('role') }}" value="siswa">Siswa</option>
                        </select>
                        @error('password')
                         <small class="form-text text-danger">{{ $message }}</small>  
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="update" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
            </div>
        </div>
    </div>
     <!-- HAPUS -->
    <div wire:ignore.self class="modal fade" id="deletePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
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
