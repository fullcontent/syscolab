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
            $table->decimal('valor', 8, 2)->nullable();



            
            $table->string('barcode')->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users');

           
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
