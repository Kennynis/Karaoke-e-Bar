<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            SalaSeeder::class,
            PlaylistSeeder::class,
            ProdutoSeeder::class,
            ReservaSeeder::class,
            ItemReservaSeeder::class,
            PagamentoSeeder::class,
            CompraSeeder::class,
            ItemCompraSeeder::class,
        ]);
    }
}
