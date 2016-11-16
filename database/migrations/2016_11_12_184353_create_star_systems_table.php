<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStarSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('galaxy_id')->references('id')->on('galaxies')->onDelete('cascade');
            $table->string('name');
            $table->integer('type');
            $table->integer('X');
            $table->integer('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('star_systems');
    }
}
