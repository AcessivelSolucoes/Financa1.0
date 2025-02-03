<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Adicionar a importação da classe Passwor
use Illuminate\Support\Facades\Hash;  
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('usuario.create');
        }
        return redirect()->route('dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:6', Password::defaults()],  // Correção aqui
            'role' => ['required', 'in:user,admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('usuario')->with('success', 'Usuário criado com sucesso!');
    }
    public function dashboard()
    {
        $dividas = Auth::user()->dividas()->orderBy('vencimento', 'asc')->get();
        return view('dashboard', compact('dividas'));
    }
}
