<?php

namespace App\Http\Controllers\Divida;

use App\Http\Controllers\Controller;
use App\Models\Divida; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DividaController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $clientes = user::where('role', 'user')->get();
            return view('divida.create', compact('clientes'));
        }
        return redirect()->route('dashboard')->with('error', 'Você não tem permissão para cadastrar dívidas.');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'cliente_id' => ['required', 'exists:users,id'], 
            'valor' => ['required', 'numeric', 'min:1'],
            'vencimento' => ['required', 'date'],
        ]);
        Divida::create([
            'user_id' => Auth::user()->id,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
            'status' => 'pendente', 
        ]);
        return redirect()->route('dashboard')->with('success', 'Dívida cadastrada com sucesso!');
    }
    public function arquivar(Divida $divida)
    {
        $divida->status = 'arquivada';
        $divida->save();
        return redirect()->route('dashboard')->with('success', 'Dívida arquivada com sucesso!');
    }
}
