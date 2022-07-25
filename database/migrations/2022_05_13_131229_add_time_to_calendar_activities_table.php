<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeToCalendarActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendar_activities', function (Blueprint $table) {
            //
            $table->string('datetime_from')->nullable()->after('date_from');
            $table->string('datetime_to')->nullable()->after('date_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_activities', function (Blueprint $table) {
            //
            $table->dropColumn('date_time_from');
            $table->dropColumn('date_time_to');
        });
    }
}
