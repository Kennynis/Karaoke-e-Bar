<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'categoria',
        'alcoolico',
        'estoque',
    ];

    protected $casts = [
        'preco' => 'float',
        'alcoolico' => 'boolean',
        'estoque' => 'integer',
    ];

    public function itemReservas()
    {
        return $this->hasMany(ItemReserva::class);
    }

    public function itemCompras()
    {
        return $this->hasMany(ItemCompra::class);
    }
}
