<?php

namespace App\Http\Controllers\Divida;

use App\Http\Controllers\Controller;
use App\Models\Divida; // Modelo da dívida
use App\Models\User;
use Illuminate\Http\Request;

class DividaController extends Controller
{
    // Exibe o formulário para cadastrar a dívida
    public function create()
    {
        // erro no vs code para interpretar o ->() pode substiruir por ::
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Passa a lista de clientes (ou pode ser uma pesquisa)
            $clientes = User::where('role', 'user')->get();

            return view('divida.create', compact('clientes'));
        }

        return redirect()->route('dashboard')->with('error', 'Você não tem permissão para cadastrar dívidas.');
    }

    // Processa a criação da dívida
    public function store(Request $request)
    {
        // Valida os dados da dívida
        $request->validate([
            'cliente_id' => ['required', 'exists:users,id'], // Certifica-se de que o cliente existe
            'valor' => ['required', 'numeric', 'min:1'],
            'vencimento' => ['required', 'date'],
        ]);

        // Cria a dívida
        Divida::create([
            'user_id' => auth()->user()->id,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
            'status' => 'pendente', // Status padrão
        ]);

        return redirect()->route('dashboard')->with('success', 'Dívida cadastrada com sucesso!');
    }

    public function arquivar(Divida $divida)
    {
        // Lógica para arquivar a dívida, por exemplo, mudar o status para "arquivada"
        $divida->status = 'arquivada';
        $divida->save();

        return redirect()->route('dashboard')->with('success', 'Dívida arquivada com sucesso!');
    }
}
