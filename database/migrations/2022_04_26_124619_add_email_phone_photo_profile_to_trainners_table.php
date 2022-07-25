<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailPhonePhotoProfileToTrainnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainners', function (Blueprint $table) {
            //
            $table->string('email')->nullable()->after('file_certificate_profession');
            $table->string('phone')->nullable()->after('email');
            $table->longText('photo_profile')->nullable()->after('phone');
            $table->integer('status')->default(1)->after('photo_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainners', function (Blueprint $table) {
            //
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('photo_profile');
            $table->dropColumn('status');
        });
    }
}
