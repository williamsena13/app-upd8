<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $quantidadeRegistros = 10;

        for ($i = 0; $i < $quantidadeRegistros; $i++) {
            $sexo = $faker->randomElement(['M', 'F', 'O']);

            DB::table('clientes')->insert([
                'cpf' => $faker->unique()->numerify('###########'),
                'nome_completo' => $faker->name,
                'data_nascimento' => $faker->date,
                'sexo' => $sexo,
                'endereco' => $faker->address,
                'estado' => $faker->stateAbbr,
                'cidade' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}