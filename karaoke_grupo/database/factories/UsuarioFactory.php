<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'endereco' => fake()->streetAddress(),
            'data_nascimento' => fake()->date('Y-m-d', '2008-01-01'),
            'telefone' => fake()->numerify('(49) 9####-####'),
            'email' => fake()->unique()->safeEmail(),
            'senha' => Hash::make('12345678'),
            'tipo' => fake()->randomElement(['Cliente', 'Funcionário']),
        ];
    }
}
