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
    Schema::create('horarios_disponiveis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('barbeiro_id')->constrained('barbeiros')->cascadeOnDelete();
        $table->date('data');
        $table->time('hora');
        $table->boolean('disponivel')->default(true);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_disponiveis');
    }
};


