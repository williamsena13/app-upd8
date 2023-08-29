<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {



        return [
            'cpf' => fake()->unique()->numerify('###########'),
            'nome_completo' => fake()->name,
            'data_nascimento' => fake()->date,
            'sexo' => fake()->randomElement(['M', 'F', 'O']),
            'endereco' => fake()->address,
            'estado' => fake()->stateAbbr,
            'cidade' => fake()->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}