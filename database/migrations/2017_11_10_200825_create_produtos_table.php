<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            


            $table->string('nome')->nullable();
            $table->string('codigo')->nullable();
            $table->decimal('valor', 8, 2)->nullable();
            
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');


            $table->longText('descricao')->nullable();
            
            $table->integer('galeria_id')->nullable();
            $table->string('img')->nullable();
            $table->string('cor')->nullable();








            
            

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users')->onDelete('restrict');

           
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
        Schema::dropIfExists('produtos');
    }
}
