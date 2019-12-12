<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarbeariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barbearias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ativacao')->default(0);
            $table->string('nome', 200)->nullable();
            $table->string('razao', 200)->nullable();
            $table->string('cnpj', 20)->nullable();
            $table->string('ie', 20)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cep', 20)->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('endereco', 20)->nullable();
            $table->string('descricao', 1000)->nullable();
            $table->string('foto', 200)->default('sem-foto.jpg');
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
        Schema::dropIfExists('barbearias');
    }
}
