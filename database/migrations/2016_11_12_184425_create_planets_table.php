<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('star_system_id')->unsigned();
            $table->foreign('star_system_id')->references('id')->on('star_systems')->onDelete('cascade');
            $table->timestamps();
            $table->string('name');
            $table->integer('type');
            $table->integer('distance');
            $table->float('position');
            $table->integer('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planets');
    }
}
