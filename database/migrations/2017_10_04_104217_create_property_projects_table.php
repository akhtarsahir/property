<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_projects', function (Blueprint $table) {
            $table->increments('propertyOpention_id');
            $table->integer('property_id');
            $table->string('property_type0');
            $table->string('title0');
            $table->string('price0');
            $table->string('beds0');
            $table->string('bath0');
            $table->string('property_size0');
            $table->string('property_type1');
            $table->string('title1');
            $table->string('price1');
            $table->string('beds1');
            $table->string('bath1');
            $table->string('property_size1');
            $table->string('property_type2');
            $table->string('title2');
            $table->string('price2');
            $table->string('beds2');
            $table->string('bath2');
            $table->string('property_size2');
            $table->string('property_type3');
            $table->string('title3');
            $table->string('price3');
            $table->string('beds3');
            $table->string('bath3');
            $table->string('property_size3');
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
        Schema::dropIfExists('property_projects');
    }
}
