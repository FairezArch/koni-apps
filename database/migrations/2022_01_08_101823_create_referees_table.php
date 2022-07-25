<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->default(0);
            $table->integer('sports_id')->default(0);
            $table->string('domicile')->nullable();
            $table->string('nik_referees')->nullable();
            $table->text('file_ktp_referee')->nullable();
            $table->string('npwp_referee')->nullable();
            $table->text('file_npwp_referee')->nullable();
            $table->integer('setting_judge_referees_id')->nullable();
            $table->integer('setting_judge_referee_licences_id')->nullable();
            $table->string('certificate_number')->nullable();
            $table->date('exp_certificate')->nullable();
            $table->text('file_certificate_referee')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Soft detele 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referees');
    }
}
