<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bins', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->double('temp', 15, 1);
            $table->double('hum', 15, 1);
            $table->double('volume', 15, 1);
            $table->double('battery', 15, 1);
            $table->date('lastclean');
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
        Schema::dropIfExists('bins');
    }
}
