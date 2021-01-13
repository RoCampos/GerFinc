<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespesaCategoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesa_categoria', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('despesa_id')
                ->unsigned();

            $table->bigInteger('categoria_id')
                ->unsigned();

            $table->foreign('despesa_id')
                ->references('id')
                ->on('despesas');
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias');

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
        Schema::dropIfExists('despesa_categoria');
    }
}
