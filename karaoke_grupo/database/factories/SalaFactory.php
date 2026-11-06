<?php

namespace Database\Factories;

use App\Models\Sala;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sala>
 */
class SalaFactory extends Factory
{

    public function definition(): array
    {
        $limites = ['Pequena' => 5, 'Média' => 12, 'Grande' => 25];
        $precos = ['Pequena' => 80, 'Média' => 150, 'Grande' => 250];
        $tipo = fake()->randomElement(array_keys($limites));

        return [
            'tipo' => $tipo,
            'capacidade' => $limites[$tipo],
            'preco_hora' => $precos[$tipo],
            'status' => fake()->randomElement(['Disponível', 'Ocupada', 'Manutenção']),
        ];
    }
}
