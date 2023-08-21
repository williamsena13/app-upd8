<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use PDF;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $nrPaginate = $request->paginate ?? 10;
        $query = Cliente::query();

        if ($request->has('cpf')) {
            $query->where('cpf', 'LIKE', '%' . $request->cpf. '%');
        }
        if ($request->has('nome_completo')) {
            $query->where('nome_completo', 'LIKE', '%' . $request->nome_completo . '%');
        }
        if ($request->has('data_nascimento')) {
            $query->where('data_nascimento', $request->data_nascimento);
        }
        if ($request->has('sexo')) {
            $query->where('sexo', $request->sexo);
        }
        if ($request->has('cidade')) {
            $query->where('cidade', 'LIKE', '%' . $request->cidade . '%');
        }
        if ($request->has('estado')) {
            $query->where('estado', $request->estado);
        }
        

        $clientes = $query->paginate($nrPaginate);

        return ApiResponse::success($clientes);
    }


    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->validated());
        return ApiResponse::success($cliente, 'Cliente cadastrado com sucesso.');
    }

    public function show(Cliente $cliente)
    {
        return ApiResponse::success($cliente);
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        return ApiResponse::success($cliente, 'Cliente atualizado com sucesso.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return ApiResponse::success(null, 'Cliente removido com sucesso.');
    }

    public function countCustomers()
    {
        return ApiResponse::success(Cliente::count(), 'Nº de Clientes encontrado com sucesso.');
    }

    public function exportToPdf(Request $request)
    {
        $clientes = Cliente::all();
        try {
            $pdf = PDF::loadView('customers.pdf', compact('clientes'));
            $formattedDate = date('YmdHis');    
            return $pdf->download("{$formattedDate}_clientes.pdf");
            
        } catch (\Exception $e) {
            return ApiResponse::error( "Erro ao imprimir PDF", 500 );
        }
    }
}