<?php

namespace App\Http\Controllers\Contrato;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserContractController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('contratos.enviar', compact('users'));
    }

    public function sendContract(Request $request, $id)
    {
        $user = User::findOrFail($id);
        Mail::raw('Contrato enviado.', function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Assinatura de Contrato');
        });
        $user->contract_status = 'pending';
        $user->save();

        return redirect()->route('contrato.index')->with('success', "Contrato enviado para {$user->name}");
    }

    public function downloadContract($id)
    {
        $user = User::findOrFail($id);
        if ($user->contract_file && Storage::exists($user->contract_file)) {
            return Storage::download($user->contract_file);
        }
        return redirect()->route('contrato.index')->with('error', 'Contrato não encontrado.');
    }
}
