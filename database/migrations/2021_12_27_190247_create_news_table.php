<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_content')->nullable(); 
            $table->text('content')->nullable(); 
            $table->date('showtime_from')->nullable();
            $table->date('showtime_to')->nullable();
            $table->integer('sports_id')->default(0);
            $table->integer('position_news')->default(0);
            $table->integer('category_news_id')->default(0);
            $table->text('file_news')->nullable();
            $table->integer('status')->default(0);
            $table->integer('type_news')->default(0);
            $table->integer('users_id')->default(0);
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
        Schema::dropIfExists('news');
    }
}
