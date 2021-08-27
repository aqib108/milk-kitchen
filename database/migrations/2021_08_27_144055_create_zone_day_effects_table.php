<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneDayEffectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_day_effects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zone_id');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('week_days')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('day_off')->default(0);
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
        Schema::dropIfExists('zone_day_effects');
    }
}
