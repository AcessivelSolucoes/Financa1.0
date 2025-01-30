<?php

namespace App\Http\Controllers\Contrato;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UserContractController extends Controller
{
    public function index()
    {
        // Exibe os usuários com seus respectivos status de contrato
        $users = User::where('role', '!=', 'admin')->get();
        return view('contratos.enviar', compact('users'));
    }

    public function sendContract(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Lógica de envio de contrato por e-mail (pode ser substituída pela lógica de geração e envio real)
        Mail::raw('Contrato enviado.', function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Assinatura de Contrato');
        });

        // Atualiza o status do contrato para "Pendente"
        $user->contract_status = 'pending';
        $user->save();

        return redirect()->route('contrato.index')->with('success', "Contrato enviado para {$user->name}");
    }

    public function downloadContract($id)
    {
        $user = User::findOrFail($id);

        // Verifica se o contrato existe
        if ($user->contract_file && Storage::exists($user->contract_file)) {
            return Storage::download($user->contract_file);
        }

        return redirect()->route('contrato.index')->with('error', 'Contrato não encontrado.');
    }
}
