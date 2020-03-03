<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock__sells', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('productid')->unsigned();
            $table->foreign('productid')->references('id')->on('products')->onDelete('cascade');
            $table->integer('clinicid')->unsigned();
            $table->foreign('clinicid')->references('id')->on('clinics')->onDelete('cascade');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('total');
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
        Schema::dropIfExists('stock__sells');
    }
}
