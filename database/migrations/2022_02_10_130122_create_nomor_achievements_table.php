<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomorAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomor_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_code')->nullable();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('sports_id')->default(0);
            $table->integer('nomors_id')->default(0);
            $table->integer('achievement_level')->default(0);
            $table->text('file_achievement')->nullable();
            $table->integer('status_achievement')->default(0);
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
        Schema::dropIfExists('nomor_achievements');
    }
}
