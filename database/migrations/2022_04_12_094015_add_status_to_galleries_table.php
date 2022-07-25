<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToGalleriesTable extends Migration
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
            $table->string('title')->nullable()->after('id');
            $table->string('filename')->nullable()->after('title');
            $table->string('folder')->nullable()->after('filename');
            $table->integer('status')->default(1)->after('users_id');
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
            $table->dropColumn('title');
            $table->dropColumn('filename');
            $table->dropColumn('folder');
            $table->dropColumn('status');
        });
    }
}
