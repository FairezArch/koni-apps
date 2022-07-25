<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnFieldToTeamSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('team_supports', function (Blueprint $table) {
            //
            $table->renameColumn('user_id', 'users_id');
            $table->renameColumn('sport_id', 'sports_id');
            $table->renameColumn('club_id', 'clubs_id');
        });

        // Schema::table('child_roles', function (Blueprint $table) {
        //     //
        //     $table->renameColumn('role_id', 'roles_id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team_supports', function (Blueprint $table) {
            //
            $table->renameColumn('users_id', 'user_id');
            $table->renameColumn('sports_id', 'sport_id');
            $table->renameColumn('clubs_id', 'club_id');
        });

        // Schema::table('child_roles', function (Blueprint $table) {
        //     //
        //     $table->renameColumn('roles_id', 'role_id');
        // });
    }
}
