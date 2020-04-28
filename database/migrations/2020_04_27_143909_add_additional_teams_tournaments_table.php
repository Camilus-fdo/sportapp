<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalTeamsTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments_teams', function (Blueprint $table) {
            $table->string('team_name');
            $table->string('total_wins')->default(0);
            $table->string('total_point')->default(0);
            $table->string('total_bouns')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments_teams', function (Blueprint $table) {
            //
        });
    }
}
