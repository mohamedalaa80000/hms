<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic__workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employeeid')->unsigned();
            $table->foreign('employeeid')->references('id')->on('employees')->onDelete('cascade');
            $table->integer('clinicid')->unsigned();
            $table->foreign('clinicid')->references('id')->on('clinics')->onDelete('cascade');
            $table->integer('workstart')->default(404);
            $table->integer('workend')->default(404);
            $table->integer('onlyday')->default(404);
            $table->integer('singleormulti')->default(404);
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
        Schema::dropIfExists('clinic__workers');
    }
}
