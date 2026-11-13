<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    /** @use HasFactory<\Database\Factories\CompraFactory> */
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'data_compra',
        'valor_total',
    ];

    protected $casts = [
        'usuario_id' => 'integer',
        'data_compra' => 'date',
        'valor_total' => 'float',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemCompra::class);
    }
}
