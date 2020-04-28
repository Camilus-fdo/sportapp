<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('tournmnt_id');
            $table->string('game_id');
            $table->string('team_name');
            $table->string('tries')->default(0);
            $table->string('conversions')->default(0);
            $table->string('bonus_point')->default(0);
            $table->string('total_point')->default(0);
            $table->string('wins')->default(0);
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
        Schema::dropIfExists('scores');
    }
}
