<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sala_id')->constrained('salas');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('playlist_id')->nullable()->constrained('playlists');
            $table->string('playlist_link',150)->nullable();
            $table->date('data_reserva');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->boolean('menor_presente')->default(false);
            $table->integer('quantidade_pessoas');
            $table->string('status',20);
            $table->dateTime('data_cancelamento')->nullable();
            $table->string('motivo_cancelamento',225)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
