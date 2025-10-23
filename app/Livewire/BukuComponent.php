<?php

namespace App\Livewire;

use App\Models\kategori;
use App\Models\Buku;    
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class BukuComponent extends Component
{
    use WithPagination,WithoutUrlPagination,WithFileUploads;
    protected $paginationTheme='bootstrap';
    public $kategori, $judul, $penulis, $penerbit,$isbn,$tahun,$jumlah,$cari,$id,$foto;
    public function render()
    {
         if($this->cari!=""){
            $data['buku']=kategori::where('judul', 'like','%'. $this->cari . '%')
            ->paginate(10);
        }
        else{
             $data['buku'] = kategori::paginate(10);
        }
        $data['buku'] = Buku::paginate(10);
        $data['categori'] = kategori::all();
        $layout['title'] = 'Kelola Kategori';
        return view('livewire.buku-component',$data)->layoutData($layout);
    }
    public function store()
    {
        $this->validate([
            'judul'    => 'required',
            'kategori' => 'required',
            'penulis'  => 'required',
            'penerbit' => 'required',
            'isbn'     => 'required|digits:13',
            'jumlah'   => 'required',
            'tahun'    => 'required',
            'foto'     => 'nullable|image|max:2048', // max 2MB
        ]);

        $path = null;
        if ($this->foto) {
            $path = $this->foto->store('buku', 'public');
        }

        Buku::create([
            'judul'       => $this->judul,
            'kategori_id' => $this->kategori,
            'penulis'     => $this->penulis,
            'penerbit'    => $this->penerbit,
            'tahun'       => $this->tahun,
            'isbn'        => $this->isbn,
            'jumlah'      => $this->jumlah,
            'foto'        => $path,
        ]);

        $this->reset();
        session()->flash('success','Berhasil tambah');
        return redirect()->route('buku');
    }
    public function edit($id){
        $buku=Buku::find($id);
        $this->id = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori->id;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun = $buku->tahun;
        $this->isbn = $buku->isbn;
        $this->jumlah = $buku->jumlah;
    }

    public function update(){
        $buku=Buku::find($this->id);
        $buku->update([
            'judul'=>$this->judul,
            'kategori_id'=>$this->kategori,
            'penulis'=>$this->penulis,
            'penerbit'=>$this->penerbit,
            'tahun'=>$this->tahun,
            'isbn'=>$this->isbn,
            'jumlah'=>$this->jumlah
        ]);
        $this->reset();
        session()->flash('success','Berhasil tambah');
        return redirect()->route('buku');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $buku=Buku::find($this->id);
        $buku->delete();
        $this->reset();
        session()->flash('success','Berhasil tambah');
        return redirect()->route('buku');
    }
}
