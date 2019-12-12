<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('status')->default(0);
            $table->string('comprovante')->nullable();
            $table->string('valor')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('barbearia_id')->nullable();
            $table->unsignedBigInteger('plano_id')->nullable();
            $table->foreign('barbearia_id')->references('id')->on('barbearias');
            $table->foreign('plano_id')->references('id')->on('planos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
