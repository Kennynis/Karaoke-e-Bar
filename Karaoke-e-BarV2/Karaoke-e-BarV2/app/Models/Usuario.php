<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'endereco',
        'data_nascimento',
        'telefone',
        'email',
        'senha',
        'tipo',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
