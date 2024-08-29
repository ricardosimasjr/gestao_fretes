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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('codigopedido')->unique();
            $table->string('cpfcnpj');
            $table->string('nomecliente');
            $table->string('ufcliente');
            $table->string('vendedorpedido');
            $table->string('representantepedido')->nullable();
            $table->date('datapedido');
            $table->integer('volumes')->nullable();
            $table->float('peso', precision: 3)->nullable();
            $table->float('valor', precision: 3);
            $table->date('dt_prev_entrega')->default(null)->nullable();
            $table->boolean('bonificado')->default(0);
            $table->float('vlr_cotado', precision:2)->default(0);
            $table->string('nr_nota')->default(null)->nullable();
            $table->string('pedido_compra')->default(null)->nullable();
            $table->string('comprovantes')->default(null)->nullable();
            $table->foreignId('status_id')->constrained('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
