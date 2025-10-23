<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\kategori;
use App\Models\pinjam;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengembaliansiswaComponent extends Component
{
     protected $paginationTheme='bootstrap';
    public $tgl_pinjam, $tgl_batas, $buku_id,$id,$cari,$status;
     public function render()
    {
         if($this->cari!=""){
            $data['buku']=kategori::where('judul', 'like','%'. $this->cari . '%')
            ->paginate(10);
        }
        else{
             $data['buku'] = kategori::paginate(10);
        }
        $data['pinjamanku'] = pinjam::with('buku.kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(5);
        $data['buku'] = Buku::paginate(10);
        $data['categori'] = kategori::all();
        $layout['title'] = 'Perpustakaan -Siswa';
        return view('livewire.pengembaliansiswa-component',$data)->layoutData($layout)->layout('components.layouts.Siswa');
    }
}
