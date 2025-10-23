<?php

use App\Http\Controllers\AuthController;
use App\Livewire\BukuComponent;
use App\Livewire\BukuDetailComponent;
use App\Livewire\BukuGuruComponent;
use App\Livewire\BukuSiswaComponent;
use App\Livewire\GuruComponent;
use App\Livewire\HomeComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\KategoriGuruComponent;
use App\Livewire\MemberComponent;
use App\Livewire\PengembalianComponent;
use App\Livewire\PengembalianGuruComponent;
use App\Livewire\PengembaliansiswaComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\PinjamGuruComponent;
use App\Livewire\SiswaComponent;
use App\Livewire\UserComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get('/', HomeComponent::class)->name('home');
    Route::get('/guru', [AuthController::class, 'guru'])->name('guru');
    Route::get('/pinjam', PinjamComponent::class)->name('pinjam');
    Route::get('/Siswa',SiswaComponent::class)->name('Siswa');
    Route::get('/Pengembaliansiswa',PengembaliansiswaComponent::class)->name('Pengembaliansiswa');
    Route::get('/pengembalian',PengembalianComponent::class)->name('pengembalian');
    Route::get('/guru', GuruComponent::class)->name('guru');
    Route::get('/bukuguru', BukuGuruComponent::class)->name('bukuguru');
    Route::get('/kategoriguru', KategoriGuruComponent::class)->name('kategoriguru');
    Route::get('/pinjamguru', PinjamGuruComponent::class)->name('pinjamguru');
    Route::get('/pengembalianguru', PengembalianGuruComponent::class)->name('pengembalianguru');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
 // Route::post('/proseslogin',[AuthController::class, 'proseslogin']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'proseslogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
    Route::get('/user', UserComponent::class)->name('user')->middleware('auth');
    Route::get('/member',MemberComponent::class)->name('member')->middleware('auth');
    Route::get('/Kategori', KategoriComponent::class)->name('kategori')->middleware('auth');
    Route::get('/buku',BukuComponent::class)->name('buku')->middleware('auth');
    Route::get('/BukuSiswa', BukuSiswaComponent::class)->name('BukuSiswa')->middleware('auth');
    Route::get('/BukuDetail', BukuDetailComponent::class)->name('BukuDetail');
    
Route::middleware(['admin'])->prefix('admin')->group(function () {
            Route::get('/dashboard', [AuthController::class, 'dashboard']);
        });

        Route::middleware(['guru'])->prefix('guru')->group(function () {
            Route::get('/dashboard', [AuthController::class, 'dashboard']);
   
        });

     Route::middleware(['siswa'])->prefix('siswa')->group(function () {
            Route::get('/dashboard', [AuthController::class, 'dashboard']);
});



// Route::get('/login', [AuthController::class, 'login'])->name('login');
