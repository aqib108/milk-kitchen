<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrderdeliverTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_deliverds', function (Blueprint $table) {
               
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->change();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->change();
            $table->foreign('day_id')->references('id')->on('week_days')->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
