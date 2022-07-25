<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_roles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->default(0);
            $table->bigInteger('parent_role')->default(0);
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
        Schema::dropIfExists('child_roles');
    }
}
