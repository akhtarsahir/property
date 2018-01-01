<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentorders', function (Blueprint $table) {
            $table->increments('payementorder_id');
            $table->tinyInteger('order_id');
            $table->tinyInteger('property_id');
            $table->tinyInteger('order_no');
            $table->string('transferId');
            $table->string('status');
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
        Schema::dropIfExists('paymentorders');
    }
}
