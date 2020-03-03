<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinicid')->unsigned();
            $table->foreign('clinicid')->references('id')->on('clinics');
            $table->integer('doctorid')->unsigned();
            $table->foreign('doctorid')->references('id')->on('clinic__workers')->onDelete('cascade');
            $table->integer('patientid')->unsigned();
            $table->foreign('patientid')->references('id')->on('patients')->onDelete('cascade');
            $table->dateTime('appointmentdateandtime');
            $table->integer('status');
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
        Schema::dropIfExists('appointments');
    }
}
