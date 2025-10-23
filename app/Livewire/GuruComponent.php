<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GuruComponent extends Component
{
    public function render()
    {
        $x['title'] = "Home Perpustakaan";
        $user = Auth::user();
        $jumlahUser = User::count();
        $layout['title'] = 'Perpustakaan -Siswa';
        return view('livewire.guru-component',compact('jumlahUser'))->layoutData($layout)->layout('components.layouts.guru')->with($x);
    }
}
