<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('business_name');
            $table->longText('business_address_1');
            $table->longText('business_address_2')->nullable();
            $table->unsignedBigInteger('business_country_id');
            $table->unsignedBigInteger('business_city_id');
            $table->unsignedBigInteger('business_region_id');
            $table->string('business_phone_no')->nullable();
            $table->string('business_email');
            $table->string('business_contact_no');
            $table->string('delivery_name');
            $table->longText('delivery_address_1');
            $table->longText('delivery_address_2')->nullable();
            $table->unsignedBigInteger('delivery_country_id');
            $table->unsignedBigInteger('delivery_city_id');
            $table->unsignedBigInteger('delivery_region_id');
            $table->longText('delivery_notes')->nullable();
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
        Schema::dropIfExists('customer_details');
    }
}