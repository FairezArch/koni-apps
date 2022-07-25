<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_activities', function (Blueprint $table) {
            $table->id();
            $table->string('match_name')->nullable();
            $table->integer('sports_id')->default(0);
            $table->integer('countries_id')->default(0);
            $table->integer('states_id')->default(0);
            $table->integer('cities_id')->default(0);
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Soft delete 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_activitys');
    }
}
