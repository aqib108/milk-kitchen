<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeliverdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_deliverds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('week_days')->onDelete('cascade');
            $table->integer('product_order_id')->unsigned();
            $table->foreign('product_order_id')->references('id')->on('product_orders')->onDelete('cascade');
            $table->integer('quantity');
            $table->softDeletes();
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
        Schema::dropIfExists('order_deliverds');
    }
}
