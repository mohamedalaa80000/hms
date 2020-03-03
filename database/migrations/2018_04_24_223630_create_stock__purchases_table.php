<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock__purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('productid')->unsigned();
            $table->foreign('productid')->references('id')->on('products')->onDelete('cascade');
            $table->integer('providerid')->unsigned();
            $table->foreign('providerid')->references('id')->on('providers')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('price');
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
        Schema::dropIfExists('stock__purchases');
    }
}
