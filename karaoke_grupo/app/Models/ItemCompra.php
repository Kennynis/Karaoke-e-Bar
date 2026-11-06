<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    /** @use HasFactory<\Database\Factories\ItemCompraFactory> */
    use HasFactory;

    protected $fillable = [
        'compra_id',
        'produto_id',
        'quantidade',
    ];

    protected $casts = [
        'compra_id' => 'integer',
        'produto_id' => 'integer',
        'quantidade' => 'integer',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
