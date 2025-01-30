<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    // Defina os campos que podem ser preenchidos (atributos de massa)
    protected $fillable = [
        'user_id',
        'descricao',
        'inicio',
        'termino',
    ];

    // Caso precise definir a tabela caso o nome seja diferente do plural do modelo
    // protected $table = 'contratos';

    // Defina a relação com o usuário, caso o contrato pertença a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
