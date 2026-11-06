<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReserva extends Model
{
    /** @use HasFactory<\Database\Factories\ItemReservaFactory> */
    use HasFactory;

    protected $fillable = [
        'reserva_id',
        'produto_id',
        'quantidade',
    ];

    protected $casts = [
        'reserva_id' => 'integer',
        'produto_id' => 'integer',
        'quantidade' => 'integer',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}
