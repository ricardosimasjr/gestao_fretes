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
            $table->foreignId('idTransportadora')->constrained('transportadores');
            $table->date('dataCotacao');
            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->float('valor', precision:2);
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
