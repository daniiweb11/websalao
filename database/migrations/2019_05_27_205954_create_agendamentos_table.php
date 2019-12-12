<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data')->nullable();
            $table->time('hora')->nullable();
            $table->string('observacao')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('barbearia_id');
            $table->foreign('barbearia_id')->references('id')->on('barbearias');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('barbeiro_id');
            $table->foreign('barbeiro_id')->references('id')->on('barbeiros');
            $table->unsignedBigInteger('corte_id');
            $table->foreign('corte_id')->references('id')->on('cortes');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
