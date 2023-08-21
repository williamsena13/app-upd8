<?php

namespace App\Models;

use DateTime;
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

    public function getCpfFormatado()
    {
        $value = $this->cpf;
        if (strlen($value) == 11) {
            return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
        } elseif (strlen($value) == 14) {
            return substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12, 2);
        }

        return $value;
    }

    public function getSexo()
    {
        $sexo = $this->attributes['sexo'];

        switch ($sexo) {
            case 'M':
                return 'Masculino';
            case 'F':
                return 'Feminino';
            case 'O':
                return 'Outros';
            default:
                return $sexo;
        }
    }

    public function dataNascimento()
    {
        $originalDate = $this->attributes['data_nascimento'];
        $formattedDate = new DateTime($originalDate);        
        $formattedDateString = $formattedDate->format('d/m/Y');

        return $formattedDateString;
    }
}