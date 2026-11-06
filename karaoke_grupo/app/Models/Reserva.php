<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /** @use HasFactory<\Database\Factories\ReservaFactory> */
    use HasFactory;

    protected $fillable = [
        'sala_id',
        'usuario_id',
        'playlist_id',
        'data_reserva',
        'horario_inicio',
        'horario_fim',
        'menor_presente',
        'quantidade_pessoas',
        'status',
        'data_cancelamento',
        'motivo_cancelamento',
    ];

    protected $casts = [
        'sala_id' => 'integer',
        'usuario_id' => 'integer',
        'playlist_id' => 'integer',
        'data_reserva' => 'date',
        'menor_presente' => 'boolean',
        'quantidade_pessoas' => 'integer',
        'data_cancelamento' => 'datetime',
    ];

    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemReserva::class);
    }

    public function pagamento()
    {
        return $this->hasOne(Pagamento::class);
    }
}
