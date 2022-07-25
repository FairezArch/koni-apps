   <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->integer('sports_id')->default(0);
            $table->string('club_name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('users_id')->default(0);
            $table->string('club_address')->nullable();
            $table->string('club_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('deed_of_company')->nullable();
            $table->text('file_deed_of_company')->nullable();
            $table->text('file_club')->nullable();
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
        Schema::dropIfExists('clubs');
    }
}
