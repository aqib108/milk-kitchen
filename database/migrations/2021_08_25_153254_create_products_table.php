<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->integer('price');
            $table->longText('description');
            $table->integer('sku');
            $table->boolean('new');
            $table->integer('pack_size');
            $table->boolean('active');
            $table->integer('f_ctn_price')->nullable();
            $table->integer('f_bottle_price')->nullable();
            $table->boolean('f_saleable')->nullable();
            $table->integer('r_ctn_price')->nullable();
            $table->integer('r_bottle_price')->nullable();
            $table->boolean('r_saleable')->nullable();
            $table->integer('c_ctn_price')->nullable();
            $table->integer('c_bottle_price')->nullable();
            $table->boolean('c_saleable')->nullable();
            $table->boolean('status')->default(TRUE);
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
        Schema::dropIfExists('products');
    }
}
