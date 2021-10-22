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
            $table->string('business_country');
            $table->string('business_city');
            $table->string('business_region');
            $table->string('business_phone_no')->nullable();
            $table->string('business_email');
            $table->string('business_contact_no');
            $table->string('delivery_name');
            $table->longText('delivery_address_1');
            $table->longText('delivery_address_2')->nullable();
            $table->string('delivery_country');
            $table->string('delivery_city');
            $table->string('delivery_region')->nullable();
            $table->string('delivery_zone')->nullable();
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
