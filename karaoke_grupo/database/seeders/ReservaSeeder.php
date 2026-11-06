<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playlist;
use App\Models\Reserva;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Playlist::All() as $playlist) {
            Reserva::factory()->create([
                'playlist_id' => $playlist->id,
            ]);
        }
    }
}
