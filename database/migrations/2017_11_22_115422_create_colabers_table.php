<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColabersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colabers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('cms_users')->onDelete('cascade');

            $table->string('marca')->nullable();
            $table->string('responsavel')->nullable();

            $table->string('cnpj')->nullable();
            $table->string('cpf')->nullable();


            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();

            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();

            $table->string('dadosBancarios')->nullable();     


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
        Schema::dropIfExists('colabers');
    }
}
