<?php

namespace Database\Factories;

use App\Models\Pagamento;
use App\Models\Reserva;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pagamento>
 */
class PagamentoFactory extends Factory
{

    public function definition(): array
    {
        $reserva = Reserva::find(fake()->unique()->randomElement(Reserva::pluck('id')->all()));

        $horas = (strtotime($reserva->horario_fim) - strtotime($reserva->horario_inicio)) / 3600;
        $total = $reserva->sala->preco_hora * $horas;

        foreach ($reserva->itens as $item) {
            $total += $item->produto->preco * $item->quantidade;
        }

        $forma = fake()->randomElement(['PIX', 'Cartão de crédito', 'Cartão de débito']);
        $confirmada = $reserva->status == 'Confirmada';

        return [
            'reserva_id' => $reserva->id,
            'valor_total' => $total,
            'forma_pagamento' => $forma,
            'data_confirmacao' => $confirmada ? now() : null,
            'status' => $confirmada ? 'Confirmado' : 'Pendente',
            'parcela' => $forma == 'Cartão de crédito' ? fake()->numberBetween(1, 6) : 1,
        ];
    }
}
