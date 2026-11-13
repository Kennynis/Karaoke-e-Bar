<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\ItemCompra;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ItemCompra>
 */
class ItemCompraFactory extends Factory
{

    public function definition(): array
    {
        return [
            'compra_id' => (Compra::All()->random())->id,
            'produto_id' => (Produto::All()->random())->id,
            'quantidade' => fake()->numberBetween(1, 5),
        ];
    }
}
