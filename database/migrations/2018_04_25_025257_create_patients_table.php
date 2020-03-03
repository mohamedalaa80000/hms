<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniqueid');
            $table->string('patientname');
            $table->integer('marital_status');
            $table->integer('gender');
            $table->string('occupation');
            $table->string('religion');
            $table->string('address');
            $table->string('nationality');
            $table->string('phone');
            $table->integer('age');
            $table->string('bloodgroup');
            $table->longText('chiefcomplaint');
            $table->longText('relevantmedicalhistory');
            $table->string('temperature');
            $table->string('bloodpressure');
            $table->string('extraoralexamination');
            $table->string('oralhygiene');
            $table->string('occlusion');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('patients');
    }
}
