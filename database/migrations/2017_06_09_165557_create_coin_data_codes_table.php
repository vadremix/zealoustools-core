<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinDataCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_data_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid', 6)->unique();
            $table->string('code', 20);
            $table->integer('coin_data_id')->unsigned();
            $table->integer('coin_data_provider')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_data_codes');
    }
}
