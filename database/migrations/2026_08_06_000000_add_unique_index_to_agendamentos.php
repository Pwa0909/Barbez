<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove any accidental duplicate agendamentos for the same horario_disponivel
        $duplicates = DB::table('agendamentos')
            ->select('horario_disponivel_id', DB::raw('count(*) as cnt'))
            ->groupBy('horario_disponivel_id')
            ->having('cnt', '>', 1)
            ->get();

        foreach ($duplicates as $dup) {
            $keep = DB::table('agendamentos')
                ->where('horario_disponivel_id', $dup->horario_disponivel_id)
                ->orderBy('id')
                ->first();

            DB::table('agendamentos')
                ->where('horario_disponivel_id', $dup->horario_disponivel_id)
                ->where('id', '!=', $keep->id)
                ->delete();
        }

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->unique('horario_disponivel_id', 'agendamentos_horario_disponivel_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->dropUnique('agendamentos_horario_disponivel_unique');
        });
    }
};
