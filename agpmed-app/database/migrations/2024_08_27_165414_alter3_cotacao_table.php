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
        Schema::table('cotacao', function (Blueprint $table) {
            $table->date('dt_previsao_entrega')->default(null)->nullable();
            $table->float('vlr_desconto', precision:2)->nullable();
            $table->boolean('tx_dificulty')->default(0);
            $table->string('obs')->default(null)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
