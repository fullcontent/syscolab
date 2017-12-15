<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
           $table->increments('id');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users')->onDelete('restrict');
            $table->string('tipoPagamento')->nullable();

            $table->decimal('valorVenda',9, 2)->nullable();
            $table->decimal('valorRecebidoDinheiro',9, 2)->nullable();
            $table->decimal('valorRecebidoDebito',9, 2)->nullable();
            $table->decimal('valorRecebidoCredito',9, 2)->nullable();
            $table->integer('parcelasCredito')->nullable();


            $table->decimal('desconto',9,2)->nullable();

            


            $table->integer('localVenda')->default(1);


            $table->string('comentarios', 255)->nullable();
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
        Schema::dropIfExists('vendas');
    }
}
