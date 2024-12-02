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
            $table->foreignId('nota_id')->constrained('notas');
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
