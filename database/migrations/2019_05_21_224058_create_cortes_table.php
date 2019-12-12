<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome')->nullable();
            $table->string('descricao')->nullable();
            $table->string('foto')->default('default.png');
            $table->decimal('valor', 8,2)->nullable();
            $table->integer('tempo')->nullable();
            $table->unsignedBigInteger('barbearia_id');
            $table->timestamps();
            $table->foreign('barbearia_id')->references('id')->on('barbearias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cortes');
    }
}
