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
            $table->foreignId('transportador_id')->constrained('transportadores');
            $table->date('dataCotacao');
            $table->foreignId('pedido_id')->constrained('pedidos');
            $table->float('valor', precision:2);
            $table->timestamps();
            $table->string('codcotacao')->nullable();
            $table->boolean('winner')->default(0);
            $table->date('dt_previsao_entrega')->default(null)->nullable();
            $table->float('vlr_desconto', precision:2)->nullable()->default(0);
            $table->boolean('tx_dificulty')->default(0);
            $table->string('obs')->default(null)->nullable();
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
