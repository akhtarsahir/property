<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencypaymentordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencypaymentorders', function (Blueprint $table) {
            $table->increments('agencypayementorder_id');
            $table->tinyInteger('agencyorder_id');
            $table->tinyInteger('user_id');
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
        Schema::dropIfExists('agencypaymentorders');
    }
}
