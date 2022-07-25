<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoUploadIdsToGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->string('info_upload')->nullable()->after('thumb_image');
            $table->bigInteger('sport_id')->default(0)->after('info_upload');
            $table->bigInteger('club_id')->default(0)->after('sport_id');
            $table->bigInteger('judge_id')->default(0)->after('club_id');
            $table->bigInteger('trainner_id')->default(0)->after('judge_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            //
            $table->dropColumn('sport_id');
            $table->dropColumn('club_id');
            $table->dropColumn('judge_id');
            $table->dropColumn('trainner_id');
        });
    }
}
