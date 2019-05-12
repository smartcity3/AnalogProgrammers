<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('bin_id')->unsigned();
            $table->foreign('bin_id')->references('id')->on('bins');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->double('temp', 15, 1);
            $table->double('hum', 15, 1);
            $table->double('volume', 15, 1);
            $table->double('battery', 15, 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
