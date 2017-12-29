<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatorioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatorio_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('relatorio_id')->unsigned();
            $table->foreign('relatorio_id')->references('id')->on('relatorios')->onDelete('cascade');

            $table->integer('venda_item_id')->unsigned();
            $table->foreign('venda_item_id')->references('id')->on('vendas_items')->onDelete('restrict');

            
            
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
        Schema::dropIfExists('relatorio_items');
    }
}
