<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHappyNetCoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('happy_net_coin'))
        { 
        Schema::create('happy_net_coin', function (Blueprint $table) {
            $table->increments("HAPPY_NET_COIN_ID", 11);
            $table->integer('ID_USER');
            $table->String("HAPPY_NET_COIN", 300)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('happy_net_coin');
    }
}
