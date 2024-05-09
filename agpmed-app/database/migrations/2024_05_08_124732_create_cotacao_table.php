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
        Schema::create('cotacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transportador_id')->default(null)->constrained('transportadores');
            $table->string('id_cliente');
            $table->foreignId('user_id')->default(null)->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotacao');
    }
};
