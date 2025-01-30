<?php

namespace App\Http\Controllers;

use App\Models\Divida;
use Illuminate\Http\Request;
use App\Models\Contrato;

class DashboardController extends Controller
{
    public function index()
    {
        // Se for admin, mostrar todas as dívidas
        if (auth()->user()->role == 'admin') {
            $dividas = Divida::all();
        } else {
            // Se for usuário comum, mostrar apenas suas dívidas
            $dividas = Divida::where('user_id', auth()->user()->id)->get();
        }

        return view('dashboard', compact('dividas'));
    }

    public function relatorio()
    {
        $dividas = Divida::where('user_id', auth()->id())->get();
        $contratos = Contrato::where('user_id', auth()->id())->get(); // Exemplo de recuperação dos contratos

        return view('relatorio', compact('dividas', 'contratos'));
    }
}
