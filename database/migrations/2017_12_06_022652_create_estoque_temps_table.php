<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('estoquesTemp', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('restrict');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users')->onDelete('restrict');

            $table->integer('operacao');
            $table->integer('qty');

            $table->string('comentarios', 255);


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
        Schema::dropIfExists('estoque_temps');
    }
}
