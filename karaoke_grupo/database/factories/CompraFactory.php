<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Compra>
 */
class CompraFactory extends Factory
{

    public function definition(): array
    {
        return [
            'usuario_id' => (Usuario::All()->random())->id,
            'data_compra' => fake()->date(),
            'valor_total' => 0,
        ];
    }
}
