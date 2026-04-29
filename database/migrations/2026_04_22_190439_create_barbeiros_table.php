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
    Schema::create('barbeiros', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('especialidade')->nullable();
        $table->string('telefone')->nullable();
        $table->boolean('ativo')->default(true);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barbeiros');
    }
};

