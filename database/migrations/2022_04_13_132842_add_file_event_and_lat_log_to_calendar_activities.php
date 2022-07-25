<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileEventAndLatLogToCalendarActivities extends Migration
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
            $table->longText('file_event')->nullable()->after('date_to');
            $table->decimal('lat', 10, 8)->default(0)->after('file_event');
            $table->decimal('long', 11, 8)->default(0)->after('lat');
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
            $table->dropColumn('file_event');
            $table->dropColumn('lat');
            $table->dropColumn('long');
        });
    }
}
