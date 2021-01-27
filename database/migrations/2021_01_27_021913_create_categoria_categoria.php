<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_categoria', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('grupo')
                ->unsigned();
            $table->bigInteger('subgrupo')
                ->unsigned();

            $table->foreign('grupo')->references('id')->on('categorias');
            $table->foreign('subgrupo')->references('id')->on('categorias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_categoria');
    }
}
