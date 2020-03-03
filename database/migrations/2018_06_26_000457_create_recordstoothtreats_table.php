<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordstoothtreatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recordstoothtreats', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('treatid')->unsigned();
            $table->foreign('treatid')->references('id')->on('toothtreetments')->onDelete('cascade');
            $table->date('tooth_treatment_date');
            $table->string('areaortooth');
            $table->string('diagnosis');
            $table->string('treatmentplant');
            $table->string('fee');
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
        Schema::dropIfExists('recordstoothtreats');
    }
}
