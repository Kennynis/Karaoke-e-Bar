<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemReserva;
use App\Models\Produto;
use App\Models\Reserva;

class ItemReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Reserva::All() as $reserva) {
            $produtos = $reserva->menor_presente ? Produto::where('alcoolico', false)->get() : Produto::All();

            foreach ($produtos->random(2) as $produto) {
                ItemReserva::factory()->create([
                    'reserva_id' => $reserva->id,
                    'produto_id' => $produto->id,
                ]);
            }
        }
    }
}
