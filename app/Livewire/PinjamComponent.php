<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Pinjam;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PinjamComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public function setujui($id) {
        DB::transaction(function () use ($id) {
                $pinjam = Pinjam::where('id', $id)
                                ->where('status', 'menunggu')
                                ->firstOrFail(); 
                $buku = Buku::where('id', $pinjam->buku_id)
                            ->lockForUpdate()
                            ->firstOrFail();
                if ($buku->jumlah <= 0) {
                    $pinjam->update(['status' => 'ditolak']);
                    session()->flash('error', 'Gagal, stok buku sudah habis. Pinjaman otomatis ditolak.');
                    return;
                }
                $pinjam->update(['status' => 'dipinjam']);
                $buku->decrement('jumlah');
                session()->flash('success', 'Pinjaman telah disetujui.');
    });
}

    public function tolak($id) {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->update(['status' => 'ditolak']);
        $pinjam->delete();
        session()->flash('success','Pinjaman ditolak.');
    }

    public function render()
    {
        $data['buku'] = Buku::all();
        $data['pinjam'] = Pinjam::with(['user','buku.kategori'])->whereDoesntHave('pengembalian')->latest()->paginate(10);
        $layout['title'] = 'Kelola Peminjaman';
        return view('livewire.pinjam-component',$data)->layoutData($layout);
    }
}

