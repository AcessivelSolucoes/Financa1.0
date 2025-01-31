<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Divida\DividaController;
use App\Http\Controllers\Relatorio\RelatorioController;
use App\Http\Controllers\Contrato\UserContractController;

// Página inicial (bem-vindo)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard da aplicação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota para criar uma dívida
    Route::get('/cadastrar-divida', [DividaController::class, 'create'])->name('divida.create');
    Route::post('/cadastrar-divida', [DividaController::class, 'store'])->name('divida.store');
});

// Rota para exibir o formulário de criação de usuário (admin)
Route::get('/usuario', [RegisterController::class, 'create'])->name('usuario');

// Rota para salvar o novo usuário (admin)
Route::post('/usuario', [RegisterController::class, 'store'])->name('usuario.store');

// Rota para o dashboard do usuário (redirecionamento pós-login)
Route::get('/dashboard', [RegisterController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::post('/dividas/{divida}/arquivar', [DividaController::class, 'arquivar'])->name('divida.arquivar');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');


//para teste
Route::get('/enviar-contrato', [UserContractController::class, 'index'])->name('enviar-contrato');
Route::post('/enviar-contrato/{id}', [UserContractController::class, 'sendContract'])->name('contrato.enviar');

// Importa rotas de autenticação padrão do Laravel
require __DIR__ . '/auth.php';
