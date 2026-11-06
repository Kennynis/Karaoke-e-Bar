<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // uma playlist fica em uma reserva só, então as repetidas ficam sem playlist
        $usadas = [];

        foreach (DB::table('reservas')->whereNotNull('playlist_id')->orderBy('id')->get() as $reserva) {
            if (in_array($reserva->playlist_id, $usadas)) {
                DB::table('reservas')->where('id', $reserva->id)->update(['playlist_id' => null]);
            } else {
                $usadas[] = $reserva->playlist_id;
            }
        }

        Schema::table('reservas', function (Blueprint $table) {
            $table->unique('playlist_id');
            $table->dropColumn('playlist_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropForeign(['playlist_id']);
            $table->dropUnique(['playlist_id']);
            $table->foreign('playlist_id')->references('id')->on('playlists');
            $table->string('playlist_link',150)->nullable()->after('playlist_id');
        });
    }
};
