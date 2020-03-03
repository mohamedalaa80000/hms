<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppropriateBoxsMedhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appropriate_boxs_medhistories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medhistid')->unsigned();
            $table->foreign('medhistid')->references('id')->on('medical_histories')->onDelete('cascade');
            $table->integer('appropriate_box_id');
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
        Schema::dropIfExists('appropriate_boxs_medhistories');
    }
}
