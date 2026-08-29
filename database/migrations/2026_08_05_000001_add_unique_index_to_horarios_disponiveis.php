<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Executa a migration.
     */
    public function up(): void
    {
        Schema::table('horarios_disponiveis', function (Blueprint $table) {
            $table->unique(['barbeiro_id', 'data', 'hora'], 'horarios_disponiveis_unique');
        });
    }

    /**
     * Reverte a migration.
     */
    public function down(): void
    {
        Schema::table('horarios_disponiveis', function (Blueprint $table) {
            $table->dropUnique('horarios_disponiveis_unique');
        });
    }
};
