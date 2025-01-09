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
        Schema::create('nota_romaneios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('romaneio_id')->constrained('romaneios');
            $table->text('nfe');
            $table->date('emissao');
            $table->text('razaosocial');
            $table->text('cnpj');
            $table->text('cidade');
            $table->text('uf');
            $table->integer('volumes');
            $table->float('peso', precision: 3)->nullable();
            $table->float('valor', precision: 3);
            $table->boolean('bonificacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_romaneios');
    }
};
