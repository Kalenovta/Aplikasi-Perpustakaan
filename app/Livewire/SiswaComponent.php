<?php

namespace App\Livewire;

use App\Models\kategori;
use Livewire\Component;
use App\Models\Buku;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class SiswaComponent extends Component
{
    use WithPagination,WithoutUrlPagination,WithFileUploads;
    protected $paginationTheme='bootstrap';
    public $tgl_pinjam, $tgl_batas, $buku_id,$id,$cari,$status;
    public $pinjam_id_to_delete;
    public function render()
    {
         if($this->cari!=""){
            $data['buku']=kategori::where('judul', 'like','%'. $this->cari . '%')
            ->paginate(10);
        }
        else{
             $data['buku'] = kategori::paginate(10);
        }
        $data['pinjamanku'] = Pinjam::with(['buku.kategori', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);
        $data['buku'] = Buku::paginate(10);
        $data['categori'] = kategori::all();
        $layout['title'] = 'Perpustakaan -Siswa';
        return view('livewire.siswa-component',$data)->layoutData($layout)->layout('components.layouts.Siswa');
    }



    public function confirmDelete($id)
    {
        $this->pinjam_id_to_delete = $id;

    }

    public function destroy()
    {
        $pinjam = Pinjam::find($this->pinjam_id_to_delete); 
        if (!$pinjam) {
            session()->flash('error', 'Riwayat pinjaman tidak ditemukan atau sudah dihapus.');
            $this->reset(['pinjam_id_to_delete']);
            return; 
        }

        if ($pinjam->pengembalian) {
            $pinjam->pengembalian->delete();
        }
        
        
        $pinjam->delete();
        
    
        $this->reset(['pinjam_id_to_delete']);
        session()->flash('success','Riwayat pinjaman berhasil dihapus.');
        
    }

    public function store(){
        $this->validate([
        'tgl_pinjam' => 'required|date',
        'tgl_batas'  => 'required|date|after_or_equal:tgl_pinjam',
        'buku_id'    => 'required|exists:bukus,id',
    ]);

    

    Pinjam::create([
        'tgl_pinjam' => $this->tgl_pinjam,
        'tgl_batas'  => $this->tgl_batas,
        'status'     => 'menunggu',
        'buku_id'    => $this->buku_id,
        'user_id'    => Auth::id(),
    ]);

    session()->flash('success','Berhasil mengajukan pinjam, menunggu persetujuan admin.');
    $this->reset(['tgl_pinjam','tgl_batas','buku_id']);
    }
}
