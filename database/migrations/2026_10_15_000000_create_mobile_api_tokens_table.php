<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobile_api_tokens', function (Blueprint $table): void {
            $table->id();
            $table->string('tipo', 20);
            $table->unsignedBigInteger('usuario_id');
            $table->char('token_hash', 64)->unique();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
            $table->index(['tipo', 'usuario_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobile_api_tokens');
    }
};