<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitysubaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citysubaddress', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('city_id');
            $table->string('cityname');
            $table->string('citysubaddress');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citysubaddress');
    }
}
