<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;//auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'cpf' => 'required|digits:11|unique:clientes,cpf,',
            'nomeCompleto' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
            'sexo' => 'required|in:M,F,O',
            'endereco' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'cidade' => 'required|string|max:255',
        ];
    }
}