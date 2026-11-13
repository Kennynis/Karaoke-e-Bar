<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    /** @use HasFactory<\Database\Factories\SalaFactory> */
    use HasFactory;

    protected $fillable = [
        'tipo',
        'capacidade',
        'preco_hora',
        'status',
    ];

    protected $casts = [
        'capacidade' => 'integer',
        'preco_hora' => 'float',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
