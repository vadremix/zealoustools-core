<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coin_data_codes', function (Blueprint $table) {
            $table->foreign('coin_data_name_id')
                ->references('id')
                ->on('coin_data_names')
                ->onDelete('cascade');

            $table->foreign('coin_data_provider_id')
                ->references('id')
                ->on('coin_data_providers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coin_data_codes', function (Blueprint $table) {
            $table->dropForeign('coin_data_codes_coin_data_name_id_foreign');
            $table->dropForeign('coin_data_codes_coin_data_provider_id_foreign');
        });
    }
}
