<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\kategori;
use App\Models\pengembalian;
use App\Models\pinjam;
use Illuminate\Support\Facades\Auth as Auth;
use Livewire\Component;
use App\Models\User;

class HomeComponent extends Component
{
    public function render()
{
    $x['title'] = "Home Perpustakaan";
    $user = Auth::user();
    $jumlahUser = User::count();
    $jumlahBuku = Buku::count();
    $jumlahPinjam = pinjam::count();
    $jumlahKembali = kategori::count();
    return view('livewire.home-component', compact('jumlahUser','jumlahBuku','jumlahPinjam','jumlahKembali'))->with($x);
}
}
