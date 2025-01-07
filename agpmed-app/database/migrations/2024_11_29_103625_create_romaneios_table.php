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
        Schema::create('romaneios', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('transportador_id')->constrained('transportadores');
            $table->foreignId('status_id')->constrained('status')->default(null);
            $table->text('motorista')->nullable();
            $table->text('placa')->nullable();
            $table->text('tipo_ident')->nullable();
            $table->text('identificacao')->nullable();
            $table->date('datahoracoleta')->nullable();
            $table->text('assinatura')->nullable();
            $table->longText('obs')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('romaneios');
    }
};
