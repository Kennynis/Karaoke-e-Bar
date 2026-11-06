<?php

namespace Database\Factories;

use App\Models\ItemReserva;
use App\Models\Produto;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ItemReserva>
 */
class ItemReservaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'reserva_id' => (Reserva::All()->random())->id,
            'produto_id' => (Produto::where('alcoolico', false)->get()->random())->id,
            'quantidade' => fake()->numberBetween(1, 5),
        ];
    }
}
