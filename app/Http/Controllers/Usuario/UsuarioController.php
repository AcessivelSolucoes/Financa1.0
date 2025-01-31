<?php

namespace App\Http\Controllers;

class UsuarioController extends Controller
{
    public function create()
    {
        return view('usuario.create'); // Ou o nome da view que você deseja mostrar
    }
}
