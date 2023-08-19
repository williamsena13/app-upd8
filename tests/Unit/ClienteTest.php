<?php

use Tests\TestCase;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    public function test_listagem_de_clientes()
    {
        $clientes = Cliente::factory()->count(3)->create();

        $response = $this->getJson('/api/clientes');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'cpf', 'nome_completo', 'data_nascimento', 'sexo', 'endereco', 'estado', 'cidade']
                ]
            ]);
    }

    public function test_criacao_de_cliente()
    {
        $novoCliente = Cliente::factory()->make();

        $response = $this->postJson('/api/clientes', $novoCliente->toArray());

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'cpf', 'nome_completo', 'data_nascimento', 'sexo', 'endereco', 'estado', 'cidade']]);
    }

    public function test_atualizacao_de_cliente()
    {
        $cliente = Cliente::factory()->create();

        $dadosAtualizados = [
            'nome_completo' => 'Novo Nome',
            'endereco' => 'Nova Rua, 123',
        ];

        $response = $this->putJson("/api/clientes/{$cliente->id}", $dadosAtualizados);

        $response->assertStatus(200)
            ->assertJson(['data' => $dadosAtualizados]);
    }

    public function test_remocao_de_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson("/api/clientes/{$cliente->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }

}
