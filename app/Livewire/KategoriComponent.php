<?php

namespace App\Livewire;

use App\Models\kategori;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class KategoriComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme='bootstrap';
    public $nama, $id, $deskripsi, $cari;
    public function render()
    {
        if($this->cari!=""){
            $data['kategori']=kategori::where('nama', 'like','%'. $this->cari . '%')
            ->paginate(10);
        }
        else{
             $data['kategori'] = kategori::paginate(10);
        }
         $layout['title'] = 'Kelola Kategori';
        return view('livewire.kategori-component', $data)->layoutData($layout);
    }
    public function store(){
        $this->validate([
            'nama'=>'required',
            'deskripsi'=>'required'
        ]);
        kategori::create([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);
        $this->reset();
        session()->flash('success','Berhasil tambah');
        return redirect()->route('kategori');
    }
    public function edit($id){
        $kategori=kategori::find($id);
        $this->id=$kategori->id;
        $this->nama=$kategori->nama;
        $this->deskripsi=$kategori->deskripsi;
    }
    public function update($id){
        $kategori=kategori::find($id);
        $kategori->update([
            'nama'=>$this->nama,
            'deskripsi'=>$this->deskripsi
        ]);
        $this->reset();
        session()->flash('success','Berhasil update');
        return redirect()->route('kategori');
    }
    public function confirm($id){
        $this->id = $id;
    }
    public function destroy(){
        $kategori=kategori::find($this->id);
        $kategori->delete();
        $this->reset();
        session()->flash('success','Berhasil hapus');
        return redirect()->route('kategori');
    }
}
