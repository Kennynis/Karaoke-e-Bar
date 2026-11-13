<?php

namespace Database\Factories;

use App\Models\Playlist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Playlist>
 */
class PlaylistFactory extends Factory
{

    public function definition(): array
    {
        $genero = fake()->unique()->randomElement(['Sertanejo', 'Rock', 'Pop', 'MPB', 'Pagode', 'Metal']);

        return [
            'nome' => "Clássicos do $genero",
            'genero' => $genero,
            'link' => fake()->url(),
        ];
    }
}
