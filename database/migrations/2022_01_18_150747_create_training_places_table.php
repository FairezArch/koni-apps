<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_places', function (Blueprint $table) {
            $table->id();
            $table->string('place_name')->nullable();
            $table->text('file_training')->nullable();
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
        Schema::dropIfExists('training_places');
    }
}
