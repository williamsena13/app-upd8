<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cpf' => $this->cpf,
            'nome_completo' => $this->nome_completo,
            'data_nascimento' => $this->data_nascimento,
            'sexo' => $this->sexo,
            'endereco' => $this->endereco,
            'estado' => $this->estado,
            'cidade' => $this->cidade,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
