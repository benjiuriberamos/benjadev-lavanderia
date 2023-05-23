<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            
            $table->unsignedBigInteger('input_id')->nullable();
            $table->foreign('input_id')->references('id')->on('inputs');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('input_detail');
    }
}
