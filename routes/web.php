<?php

use App\Http\Controllers\AuthController;
use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get('/', HomeComponent::class)->name('home');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});
 // Route::post('/proseslogin',[AuthController::class, 'proseslogin']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'proseslogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
Route::middleware('guest')->group(function (){
   
});
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
