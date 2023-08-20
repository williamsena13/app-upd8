<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Http\Resources\ClienteResource;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $nrPaginate = $request->paginate ?? 10;
        $clientes = Cliente::paginate($nrPaginate);
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

}