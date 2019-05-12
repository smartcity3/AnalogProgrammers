<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('bin1')->unsigned();
            $table->foreign('bin1')->references('id')->on('bins');

            $table->integer('bin2')->unsigned();
            $table->foreign('bin2')->references('id')->on('bins');

            $table->integer('bin3')->unsigned();
            $table->foreign('bin3')->references('id')->on('bins');

            $table->integer('bin4')->unsigned();
            $table->foreign('bin4')->references('id')->on('bins');

            $table->integer('bin5')->unsigned();
            $table->foreign('bin5')->references('id')->on('bins');

            $table->integer('bin6')->unsigned();
            $table->foreign('bin6')->references('id')->on('bins');

            $table->integer('bin7')->unsigned();
            $table->foreign('bin7')->references('id')->on('bins');

            $table->integer('bin8')->unsigned();
            $table->foreign('bin8')->references('id')->on('bins');

            $table->integer('bin9')->unsigned();
            $table->foreign('bin9')->references('id')->on('bins');

            $table->integer('bin10')->unsigned();
            $table->foreign('bin10')->references('id')->on('bins');

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
        Schema::dropIfExists('routes');
    }
}
