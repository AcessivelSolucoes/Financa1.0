<?php

namespace App\Http\Controllers\Relatorio;

use App\Http\Controllers\Controller; // Importação do Controller base

class RelatorioController extends Controller
{
    public function index()
    {
        // Aqui você pode passar os dados dos gráficos de ganhos e pagamentos para a view
        return view('relatorio.index');
    }
}
