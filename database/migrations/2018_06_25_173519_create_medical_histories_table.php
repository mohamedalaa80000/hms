<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patientid')->unsigned();
            $table->foreign('patientid')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('field1');
            $table->integer('field2');
            $table->integer('field3');
            $table->integer('field4');
            $table->integer('field5');
            $table->integer('field6');
            $table->integer('field7');
            $table->integer('field8');
            $table->integer('field9');
            $table->integer('field10');
            $table->integer('field11');
            $table->integer('field12');
            $table->integer('field13');
            $table->integer('field14');
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
        Schema::dropIfExists('medical_histories');
    }
}
