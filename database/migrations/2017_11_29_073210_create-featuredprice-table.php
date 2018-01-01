<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturedpriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featuredprice', function (Blueprint $table) {
            $table->increments('price_id');
            $table->string('premium_homepageprice');
            $table->string('featured_homepageprice');
            $table->string('premium_listpageprice');
            $table->string('featured_listpageprice');
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
        Schema::dropIfExists('featuredprice');
    }
}
