<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingJudgeRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_judge_referees', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_name')->nullable();
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
        Schema::dropIfExists('setting_judge_referees');
    }
}
