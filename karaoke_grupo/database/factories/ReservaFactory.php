<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\Reserva;
use App\Models\Sala;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reserva>
 */
class ReservaFactory extends Factory
{

    public function definition(): array
    {
        $sala = Sala::All()->random();
        $inicio = fake()->numberBetween(14, 20);
        $fim = $inicio + fake()->numberBetween(1, 3);
        $status = fake()->randomElement(['Pendente', 'Confirmada', 'Cancelada']);

        return [
            'sala_id' => $sala->id,
            'usuario_id' => (Usuario::All()->random())->id,
            'playlist_id' => (Playlist::doesntHave('reserva')->get()->random())->id,
            'data_reserva' => fake()->dateTimeBetween('+1 day', '+2 months')->format('Y-m-d'),
            'horario_inicio' => sprintf('%02d:00:00', $inicio),
            'horario_fim' => sprintf('%02d:00:00', $fim),
            'menor_presente' => fake()->boolean(),
            'quantidade_pessoas' => fake()->numberBetween(1, $sala->capacidade),
            'status' => $status,
            'data_cancelamento' => $status == 'Cancelada' ? now() : null,
            'motivo_cancelamento' => $status == 'Cancelada' ? 'Imprevisto do cliente' : null,
        ];
    }
}
