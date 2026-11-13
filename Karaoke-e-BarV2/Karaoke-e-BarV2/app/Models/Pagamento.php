<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    /** @use HasFactory<\Database\Factories\PagamentoFactory> */
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'valor_total',
        'forma_pagamento',
        'data_confirmacao',
        'status',
        'parcela',
    ];

    protected $casts = [
        'reserva_id' => 'integer',
        'valor_total' => 'float',
        'data_confirmacao' => 'datetime',
        'parcela' => 'integer',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
