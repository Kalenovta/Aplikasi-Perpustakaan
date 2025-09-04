<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth as Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
{
    $x['title'] = "Home Perpustakaan";
    $user = Auth::user();
    return view('livewire.home-component')->with($x);
}
}
