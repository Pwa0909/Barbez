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
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->cascadeOnDelete();

            $table->foreignId('barbeiro_id')
                ->constrained('barbeiros')
                ->cascadeOnDelete();

            $table->foreignId('servico_id')
                ->constrained('servicos')
                ->cascadeOnDelete();

            $table->foreignId('horario_disponivel_id')
                ->constrained('horarios_disponiveis')
                ->cascadeOnDelete();

            $table->date('data');
            $table->time('hora');

            $table->string('status', 50)->default('Agendado');

            $table->text('observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverte a migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};