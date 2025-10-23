<?php

namespace App\Livewire;

use App\Models\pinjam;
use Livewire\Component;
use Livewire\WithPagination;

class PinjamGuruComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';

    public function setujui($id) {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->update(['status' => 'dipinjam']);
        session()->flash('success','Pinjaman telah disetujui.');
    }

    public function tolak($id) {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->update(['status' => 'ditolak']);
        $pinjam->delete();
        session()->flash('success','Pinjaman ditolak.');
    }


    public function render()
    {
        $data['pinjam'] = pinjam::with(['user','buku.kategori'])->whereDoesntHave('pengembalian')->latest()->paginate(10);
        $layout['title'] = 'Kelola Peminjaman';
        return view('livewire.pinjam-guru-component', $data)->layoutData($layout)->layout('components.layouts.guru');
    }
}
