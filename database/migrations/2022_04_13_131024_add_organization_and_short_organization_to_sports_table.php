<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationAndShortOrganizationToSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sports', function (Blueprint $table) {
            //
            // 'organization',
        // 'short_organization',
            $table->string('organization')->nullable()->after('sk_number');
            $table->string('short_organization')->nullable()->after('organization');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sports', function (Blueprint $table) {
            //
            $table->dropColumn('organization');
            $table->dropColumn('short_organization');
        });
    }
}
