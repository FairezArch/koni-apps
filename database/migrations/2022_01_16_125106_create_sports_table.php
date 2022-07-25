<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->id();
            $table->string('sportbranch_name')->nullable();
            $table->string('slug')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number_sport')->nullable();
            $table->text('file_sport')->nullable();
            $table->integer('users_id')->nullable();
            $table->text('desc_sportbranch')->nullable();
            $table->string('sk_number')->nullable();
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
        Schema::dropIfExists('sports');
    }
}
