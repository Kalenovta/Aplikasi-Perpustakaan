<div>
    <div class="card mt-3">
        <div class="card-header">Kelola Pengembalian Buku</div>
        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Tombol tambah pengembalian -->
            <a href="#" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#addPage">
                <i class="fas fa-plus"></i> Catat Pengembalian
            </a>

            <!-- Daftar pengembalian -->
            <h5 class="mt-4">Daftar Pengembalian</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Batas</th>
                            <th>Tgl Kembali</th>
                            <th width="12%">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengembalian as $data)
                            <tr>
                                <td>{{ $loop->iteration + ($pengembalian->currentPage() - 1) * $pengembalian->perPage() }}</td>
                                <td>{{ $data->pinjam->user->name }}</td>
                                <td>{{ $data->pinjam->buku->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->pinjam->tgl_pinjam)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->pinjam->tgl_batas)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->tgl_kembali)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @if($data->denda > 0)
                                        <span class="badge badge-danger">Rp {{ number_format($data->denda,0,',','.') }}</span>
                                    @else
                                        <span class="badge badge-success">Tidak Ada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p>Belum ada data pengembalian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $pengembalian->links() }}
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="addPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-undo"></i> Catat Pengembalian Buku
                            </h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="user_id">Pilih Peminjam <span class="text-danger">*</span></label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" 
                                            wire:model.live="user_id" 
                                            id="user_id">
                                        <option value="">-- Pilih Peminjam --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id') 
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if(count($users) == 0)
                                        <small class="text-muted">Tidak ada peminjam aktif saat ini</small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="buku_id">Pilih Buku <span class="text-danger">*</span></label>
                                    <select class="form-control @error('buku_id') is-invalid @enderror" 
                                            wire:model="buku_id" 
                                            id="buku_id"
                                            {{ !$user_id ? 'disabled' : '' }}>
                                        <option value="">-- Pilih Buku --</option>
                                        @foreach($availableBooks as $buku)
                                            <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                        @endforeach
                                    </select>
                                    @error('buku_id') 
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if(!$user_id)
                                        <small class="text-muted">Pilih peminjam terlebih dahulu</small>
                                    @elseif($user_id && count($availableBooks) == 0)
                                        <small class="text-warning">Peminjam ini tidak memiliki buku yang dipinjam</small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="tgl_kembali">Tanggal Pengembalian <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           class="form-control @error('tgl_kembali') is-invalid @enderror" 
                                           wire:model="tgl_kembali"
                                           id="tgl_kembali"
                                          
                                    @error('tgl_kembali') 
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Tanggal tidak boleh melebihi hari ini</small>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button wire:click="store" 
                                    type="button" 
                                    class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Pengembalian
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('closeModal', () => {
            $('#addPage').modal('hide');
        });
    });
</script>
@endpush