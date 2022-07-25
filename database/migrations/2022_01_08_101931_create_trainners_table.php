<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainners', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->default(0);
            $table->integer('sports_id')->default(0);
            $table->string('nik_trainner')->nullable();
            $table->text('file_ktp_trainner')->nullable();
            $table->string('domicile')->nullable();
            $table->string('npwp_trainner')->nullable();
            $table->text('file_npwp_trainner')->nullable();
            $table->integer('clubs_id')->default(0);
            $table->integer('nomors_id')->default(0);
            $table->integer('status_trainners_id')->default(0);
            $table->text('support_trainners_id')->nullable();
            $table->string('certificate_number_place_trainning')->nullable();
            $table->integer('trainning_places_id')->default(0);
            $table->text('file_trainning_place')->nullable();
            $table->integer('certificate_professions_id')->default(0);
            $table->string('certificate_nomor')->nullable();
            $table->text('file_certificate_profession')->nullable();
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
        Schema::dropIfExists('trainners');
    }
}
