<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;  // Adicionar a importação da classe Password
use Illuminate\Http\RedirectResponse;  // Adicionar a importação da classe RedirectResponse
use Illuminate\Support\Facades\Auth;
use App\Htpp\Controllers\Api\ViaCepController;

class RegisterController extends Controller
{
    // Exibe o formulário de criação de usuário
    public function create()
    {
        // Verifica se o usuário está autenticado e se tem a role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('usuario.create'); // A view está em resources/views/usuario/create.blade.php
        }
        // Caso não seja admin, redireciona para uma página com erro ou home
        return redirect()->route('dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }

    // Processa o envio do formulário e cria o usuário
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:6', Password::defaults()],  // Correção aqui
            'role' => ['required', 'in:user,admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redireciona após a criação
        return redirect()->route('usuario')->with('success', 'Usuário criado com sucesso!');
    }


    public function dashboard()
    {
        // Buscar dívidas associadas ao usuário logado
        $dividas = Auth::user()->dividas()->orderBy('vencimento', 'asc')->get();

        return view('dashboard', compact('dividas'));
    }
}
