<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'nome_completo',
        'data_nascimento',
        'sexo',
        'endereco',
        'estado',
        'cidade',
    ];
}
