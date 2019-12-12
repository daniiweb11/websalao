<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBarbeariaidVales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vales', function (Blueprint $table) {
            $table->unsignedBigInteger('barbearia_id');
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
        Schema::table('vales', function (Blueprint $table) {
            //
        });
    }
}
