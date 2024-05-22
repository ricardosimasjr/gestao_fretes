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
            $table->string('representantepedido')
            ->nullable()
            ->default(null);
            $table->date('datapedido');


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
