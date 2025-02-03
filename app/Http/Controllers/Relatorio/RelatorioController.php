<?php

namespace App\Http\Controllers\Relatorio;

use App\Http\Controllers\Controller; // Importação do Controller base

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorio.index');
    }
}
