<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('order_id');
            $table->tinyInteger('property_id');
            $table->string('property_title');
            $table->string('featured_category');
            $table->string('featured_expire');
            $table->string('featured_price');
            $table->string('featured_city');
            $table->string('payment_option');
            $table->string('status');
            $table->string('payment_TID');
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
        Schema::dropIfExists('orders');
    }
}
