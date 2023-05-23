<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutputDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            
            $table->unsignedBigInteger('output_id')->nullable();
            $table->foreign('output_id')->references('id')->on('outputs');
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
        Schema::dropIfExists('output_detail');
    }
}
