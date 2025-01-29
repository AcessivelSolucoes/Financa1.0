<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Divida\DividaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/cadastrar-divida', [DividaController::class, 'create'])->name('divida.create');
    Route::post('/cadastrar-divida', [DividaController::class, 'store'])->name('divida.store');
});

// Exibe o formulário de criação de usuário
Route::get('/usuario', [RegisterController::class, 'create'])->name('usuario');

// Salva o novo usuário
Route::post('/usuario', [RegisterController::class, 'store'])->name('usuario.store');

// Exibe a divida
Route::get('/dashboard', [RegisterController::class, 'dashboard'])->name('dashboard')->middleware('auth');





require __DIR__ . '/auth.php';
