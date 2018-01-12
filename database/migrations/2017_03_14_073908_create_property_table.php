<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unsigned()->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('purpose');
            $table->string('type');
            $table->string('subtype');
            $table->string('city');
            $table->string('subaddress');
            $table->string('citysubaddress');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('beds')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('kitchens')->nullable();
            $table->string('floor')->nullable();
            $table->string('area');
            $table->string('area_unit');
            $table->string('Label');
            $table->string('ConstructedArea');
            $table->string('OpenArea');
            $table->string('ConstructionYear');
            $table->string('OwnerShipStatus');
            $table->string('size1')->nullable();
            $table->string('size2')->nullable();
            $table->string('size3')->nullable();
            $table->string('size4')->nullable();
            $table->string('rate1')->nullable();
            $table->string('rate2')->nullable();
            $table->string('rate3')->nullable();
            $table->string('rate4')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('price')->nullable();
            $table->string('image0')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('paymentPlansImage0')->nullable();
            $table->string('paymentPlansImage1')->nullable();
            $table->string('paymentPlansImage2')->nullable();
            $table->string('paymentPlansImage3')->nullable();
            $table->string('paymentPlansImage4')->nullable();
//            $table->string('pdf')->nullable();
            $table->string('property_type0')->nullable();
            $table->string('title0')->nullable();
            $table->string('price0')->nullable();
            $table->string('beds0')->nullable();
            $table->string('bath0')->nullable();
            $table->string('property_size0')->nullable();
            $table->string('property_type1')->nullable();
            $table->string('title1')->nullable();
            $table->string('price1')->nullable();
            $table->string('beds1')->nullable();
            $table->string('bath1')->nullable();
            $table->string('property_size1')->nullable();
            $table->string('property_type2')->nullable();
            $table->string('title2')->nullable();
            $table->string('price2')->nullable();
            $table->string('beds2')->nullable();
            $table->string('bath2')->nullable();
            $table->string('property_size2')->nullable();
            $table->string('property_type3')->nullable();
            $table->string('title3')->nullable();
            $table->string('price3')->nullable();
            $table->string('beds3')->nullable();
            $table->string('bath3')->nullable();
            $table->string('property_size3')->nullable();
            $table->string('property_type4')->nullable();
            $table->string('title4')->nullable();
            $table->string('price4')->nullable();
            $table->string('beds4')->nullable();
            $table->string('bath4')->nullable();
            $table->string('property_size4')->nullable();
            $table->string('property_type5')->nullable();
            $table->string('title5')->nullable();
            $table->string('price5')->nullable();
            $table->string('beds5')->nullable();
            $table->string('bath5')->nullable();
            $table->string('property_size5')->nullable();
            $table->string('property_type6')->nullable();
            $table->string('title6')->nullable();
            $table->string('price6')->nullable();
            $table->string('beds6')->nullable();
            $table->string('bath6')->nullable();
            $table->string('property_size6')->nullable();
            $table->string('video_url')->nullable();
            $table->tinyInteger('agent_id')->nullable();
            $table->date('propertexpire')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('featured_category');
            $table->string('featured_expire');
            $table->string('featured_city');
            $table->timestamps();
            $table->softDeletes();

           // $table->string('propety_number')->nullable();
           // $table->string('street')->nullable();
           // $table->string('sector')->nullable();
          //  $table->string('image')->nullable();
           // $table->string('video_url')->nullable();



        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
