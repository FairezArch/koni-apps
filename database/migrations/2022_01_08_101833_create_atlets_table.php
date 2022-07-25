<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atlets', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id')->default(0);
            $table->string('nik')->nullable();
            $table->text('ktp_address')->nullable();
            $table->text('domicile_address')->nullable();
            $table->integer('sports_id')->default(0);
            $table->integer('clubs_id')->default(0);
            $table->integer('nomors_id')->default(0);
            $table->text('training_place')->nullable();
            $table->integer('status_atlet')->default(1);
            $table->text('file_ktp_atlet')->nullable();
            $table->text('file_sk_training')->nullable();
            $table->text('file_npwp')->nullable();
            $table->text('file_atlet_status')->nullable();
            $table->string('nomor_nik_tkp')->nullable();
            $table->string('nomor_sk_training')->nullable();
            $table->string('nomor_npwp')->nullable();
            $table->string('nomor_status_atlet')->nullable();
            $table->integer('verify_atlet')->default(0);
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
        Schema::dropIfExists('atlets');
    }
}
