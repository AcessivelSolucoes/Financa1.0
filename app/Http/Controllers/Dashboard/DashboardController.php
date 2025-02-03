<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Divida;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $dividas = Divida::all();
        } else {
            $dividas = Divida::where('user_id', Auth::user()->id)->get();
        }
        return view('dashboard', compact('dividas'));
    }
    public function relatorio()
    {
        $dividas = Divida::where('user_id', Auth::user()->id())->get();
        $contratos = Contrato::where('user_id', Auth::user()->id())->get(); 
        return view('relatorio', compact('dividas', 'contratos'));
    }
}
