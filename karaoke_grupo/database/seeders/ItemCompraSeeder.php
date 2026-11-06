<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compra;
use App\Models\ItemCompra;
use App\Models\Produto;

class ItemCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Compra::All() as $compra) {
            $total = 0;

            foreach (Produto::All()->random(2) as $produto) {
                $item = ItemCompra::factory()->create([
                    'compra_id' => $compra->id,
                    'produto_id' => $produto->id,
                ]);
                $produto->decrement('estoque', $item->quantidade);
                $total += $produto->preco * $item->quantidade;
            }

            $compra->update(['valor_total' => $total]);
        }
    }
}
