<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingJudgeRefereeLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_judge_referee_licences', function (Blueprint $table) {
            $table->id();
            $table->string('licence_name')->nullable();
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
        Schema::dropIfExists('setting_judge_referee_licences');
    }
}
