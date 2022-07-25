<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomors', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_code')->nullable();
            $table->integer('sports_id')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('nomors');
    }
}
