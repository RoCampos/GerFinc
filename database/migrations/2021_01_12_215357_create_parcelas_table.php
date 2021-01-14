<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('despesa_id')
                ->unsigned(); //conta vinculada a esta parcela
            $table->bigInteger('valor'); //valor da parcela, individual
            $table->boolean('pago')
                ->default(0);
            $table->date('data_pagamento')
                ->nullable();
            $table->timestamps();

            $table->foreign('despesa_id')
                ->references('id')
                ->on('despesas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcelas');
    }
}
