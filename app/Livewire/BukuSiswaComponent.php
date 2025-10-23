<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\pinjam;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class BukuSiswaComponent extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $cari = '';
    public $selectedBukuId;
    public $showConfirmModal = false;
    
    #[On('bukuUpdated')]
    public function refresh()
    {
        // Refresh component when book is updated
    }
    
    public function pinjamBuku($bukuId)
    {
        $this->selectedBukuId = $bukuId;
        $this->showConfirmModal = true;
    }
    
    public function confirmPinjam()
    {
        $buku = Buku::find($this->selectedBukuId);
        
        if (!$buku || $buku->jumlah <= 0) {
            session()->flash('error', 'Buku tidak tersedia untuk dipinjam.');
            $this->showConfirmModal = false;
            return;
        }
        
        $user = Auth::user();
        
        // Check if user already has this book on loan
        $existingPinjam = pinjam::where('user_id', $user->id)
            ->where('buku_id', $this->selectedBukuId)
            ->whereIn('status', ['menunggu', 'dipinjam'])
            ->exists();
        
        if ($existingPinjam) {
            session()->flash('warning', 'Anda sudah meminjam buku ini.');
            $this->showConfirmModal = false;
            return;
        }
        
        $tglPinjam = Carbon::today();
        $tglBatas = $tglPinjam->copy()->addDays(7);
        
        Pinjam::create([
            'user_id' => $user->id,
            'buku_id' => $this->selectedBukuId,
            'tgl_pinjam' => $tglPinjam,
            'tgl_batas' => $tglBatas,
            'status' => 'menunggu'
        ]);
        
        session()->flash('success', 'Permintaan peminjaman buku telah dikirim. Tunggu persetujuan dari admin.');
        $this->showConfirmModal = false;
        $this->selectedBukuId = null;
    }
    
    public function closePinjamModal()
    {
        $this->showConfirmModal = false;
        $this->selectedBukuId = null;
    }
    
    public function updatedCari()
    {
        $this->resetPage();
    }
    public function render()
    {
        $query = Buku::query();
        
        if ($this->cari != '') {
            $query->where('judul', 'like', '%' . $this->cari . '%')
                  ->orWhere('penulis', 'like', '%' . $this->cari . '%')
                  ->orWhere('penerbit', 'like', '%' . $this->cari . '%');
        }
        
        $data['buku'] = $query->with('kategori')->paginate(12);
        $layout['title'] = 'Daftar Buku';
        return view('livewire.buku-siswa-component', $data)->layoutData($layout)->layout('components.layouts.Siswa');
    }
}
