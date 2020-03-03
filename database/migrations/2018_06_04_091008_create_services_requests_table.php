<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('clinicid')->unsigned();
            $table->foreign('clinicid')->references('id')->on('clinics')->onDelete('cascade');
            $table->integer('employeeid')->unsigned();
            $table->foreign('employeeid')->references('id')->on('employees')->onDelete('cascade');
            $table->integer('patientid')->unsigned();
            $table->foreign('patientid')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('services_requests');
    }
}
