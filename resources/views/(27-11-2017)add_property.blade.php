@extends('layouts.app')
@section('pagecss')
<!--page level css -->
<link href="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css')}}"  rel="stylesheet" media="screen"/>
<link href="{{asset('assets/css/pages/editor.css')}}" rel="stylesheet" type="text/css"/>

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

<!--end of page level css-->

<script type="text/javascript">
    var datefield = document.createElement("input")
    datefield.setAttribute("type", "date_text")
    if (datefield.type != "date") { //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
        document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
    }
</script>
<script>
    if (datefield.type != "date_text") { //if browser doesn't support input type="date", initialize date picker widget:
        jQuery(function ($) { //on document.ready
            $('#ConstructionYear').datepicker({maxDate: new Date(), dateFormat: 'yy-mm-dd'});

        })
    }
</script>
@endsection
@section('content')
<style>
    .hide{ display:none;}
    .outline{
        border-color: rgba(64,79,239,0.8);
        box-shadow: 0 1px 1px rgba(0,0,0,0.03) inset, 0 0 8px rgba(123,137,239,0.6);
        outline: 0 none;
    }
    .font-color{ color:white;}
    .add-title-tab {
        background-color: #7ca1f9;
    }
    .bold-class{ font-weight: bold;}

    // multiple images
    .entry:not(:first-of-type)
    {
        margin-top: 10px;
    }

    .glyphicon
    {
        font-size: 12px;
    }

</style>

<!--start section page body-->
<section id="section-body">

    <div class="container" style="background-color: #13507f; background-image:  url('assets/images/texture.png'); ">
        <div class="membership-page-top">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="membership-page-title ">
                        <?php
                        if (!isset($_SESSION)) {
                            session_start();
                        }
                        if (isset($_SESSION['Message'])) {
                            ?>
                            <h3 class="page-title alert alert-success">{{ $_SESSION['Message'] }}</h3>

                        <?php } unset($_SESSION['Message']) ?>

                        <h1 class="page-title font-color"> Add New Property </h1>
                        <p class="page-subtitle font-color"> Please enter your property Detail Below! </p>
                    </div>
                    <ol class="pay-step-bar ">
                        <li class="pay-step-block font-color active" id="headone"><span>1. <span><b>Type & Purpose</b></span></span></li>
                        <li class="pay-step-block font-color" id="headtwo"><span>2. <span><b>Location</b></span></span></li>
                        <li class="pay-step-block font-color" id="headthree"><span>3. <span><b>Property Detail</b></span></span></li>
                        <li class="pay-step-block font-color" id="headfour"><span>4. <span><b>Features & Services</b></span></span></li>
                        <li class="pay-step-block font-color" id="headfive"><span>5. <span><b>Done</b></span></span></li>
                    </ol>
                </div>
            </div>
        </div>


        <form action="{{url('/add_property')}}" method="post" enctype="multipart/form-data"  class="form-horizontal" id="myForm" name="myForm">
            {!! csrf_field() !!}
            <div class="account-block " id="blockone" style="background: #ebe5d9 url('assets/images/texture.jpg')">
                <div class="add-title-tab ">
                    <h3>Property Purpose</h3>
                </div>
                <div class="add-tab-content" >
                    <div class="add-tab-row push-padding-bottom">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="purpose" value="sell" id="purpose">
                                        <strong class="bold-class" > For Buy / Sale </strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="purpose" value="rent" id="purpose">
                                        <strong class="bold-class" > For Rent</strong>
                                    </label>
                                </div>
                            </div>

                        </div>
                        <label class=" alert-danger hide" id="purpose_error"> Please Select One Property Purpose </label>

                    </div>
                </div>
                <div class="add-title-tab">
                    <h3>Property Type </h3>
                </div>
                <div class="add-tab-content">
                    <div class="add-tab-row push-padding-bottom">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="house" id="onlyhouse">
                                        <strong class="bold-class" > Residential / Homes </strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" value="land" id="onlyland">
                                        <strong class="bold-class" > Commercial / Land </strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="type" value="projects" id="onlyprojects">
                                        <strong class="bold-class" > Projects </strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class=" alert-danger hide" id="type_error"> Please Select One Property Type </label>

                    </div>
                </div>


                <div class="house hide" id="house">
                    <div class="add-title-tab " id="titlehouse">
                        <h3>Property Sub Category</h3>
                    </div>
                    <div class="add-tab-content " >
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row" >
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Houses / Villas" id="greenproperty">
                                            <strong class="bold-class" >Houses / Villas </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio"  name="subtype" value="Plots / Files" id="notgreenproperty" >
                                            <strong class="bold-class" > Plots / Files </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!--<div class="checkbox">-->
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Flats / Appartments" id="greenproperty">
                                            <strong class="bold-class" > Flats / Appartments </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!--                                    <div class="checkbox">-->
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Form Houses" id="greenproperty">
                                            <strong class="bold-class" > Form Houses </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!--<div class="checkbox">-->
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Upper Portion" id="greenproperty">
                                            <strong class="bold-class" > Upper Portion </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!--<div class="checkbox">-->
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Lower Protion" id="greenproperty">
                                            <strong class="bold-class" > Lower Protion</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <label class=" alert-danger hide" id="house_error"> Please Select One Property Sub Category </label>
                        </div>
                    </div>

                </div>

                <div class="commercial hide" id="commercial">
                    <div class="add-title-tab " id="titlehouse">
                        <h3>Property Sub Category</h3>
                    </div>
                    <div class="add-tab-content " >
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row" >
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Commercial Plots / Files" id="notgreenproperty">
                                            <strong class="bold-class" >Commercial Plots / Files </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Agricultural Land" id="notgreenproperty">
                                            <strong class="bold-class" >Agricultural Land</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Industrial Land" id="notgreenproperty">
                                            <strong class="bold-class" > Industrial Land </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Office" id="greenproperty" >
                                            <strong class="bold-class" >Offices </strong>
                                        </label>
                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Shops / Showrooms" id="notgreenproperty">
                                            <strong class="bold-class" >Shops / Showrooms </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Commercial Plots / Files" id="notgreenproperty">
                                            <strong class="bold-class" >Commercial Plots / Files </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Building" id="notgreenproperty">
                                            <strong class="bold-class" >Building </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Factories" id="notgreenproperty">
                                            <strong class="bold-class" >Factories </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Warehouses / Godown" id="notgreenproperty">
                                            <strong class="bold-class" >Warehouses / Godown</strong>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Guest House/Banquet Hall" id="greenproperty">
                                            <strong class="bold-class" >Guest House/Banquet Hall </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="School / College" id="greenproperty">
                                            <strong class="bold-class" >School / College</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Hotel / Resturant" id="notgreenproperty">
                                            <strong class="bold-class" >Hotel / Resturant</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <label class=" alert-danger hide" id="land_error"> Please Select One Property Sub Category </label>
                        </div>
                    </div>
                </div>

                <div class="projects hide" id="projects">
                    <div class="add-title-tab " id="titlehouse">
                        <h3 class="bold-class">Property Sub Category</h3>
                    </div>
                    <div class="add-tab-content ">
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row" >
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Residental Town / Schemes" id="notgreenproperty">
                                            <strong class="bold-class">Residental Town / Schemes </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Land Sub Divisions" id="notgreenproperty">
                                            <strong class="bold-class">Land Sub Divisions</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Commercial Plaza / Tower" id="notgreenproperty">
                                            <strong class="bold-class">Commercial Plaza / Tower</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="subtype" value="Industrial Estates /Zone" id="notgreenproperty">
                                            <strong class="bold-class" >Industrial Estates /Zone</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <label class=" alert-danger hide" id="projects_error"> Please Select One Property Sub Category </label>
                        </div>
                    </div>

                </div>
            </div>

            <!--<div class="account-block hide " id="blocktwo">-->
            <div class="account-block " id="blocktwo">

                <div class="add-title-tab">
                    <h3 class="bold-class">Select Property Location</h3>
                </div>
                <div class="add-tab-content">

                    <div class="add-tab-row push-padding-bottom">

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group ">
                                    <div class="col-sm-2">
                                        <label for="property-price-before" class="bold-class">City</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="selectpicker target" id="place-name" name="city" data-live-search="false" dat-live-search-style="begins" title="Select" required>
                                            <option id="place-name"></option>
                                            @foreach($city as $city)
                                            <option class="{{ $city->latitude }},{{ $city->longitude }}" value="{{ $city->name }}">{{ $city->name }}</option>
                                            @endforeach

                                        </select>
                                        <label class=" alert-danger hide" id="city_error"> Please Select City of Property </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="property-price" class="bold-class">Location / Address</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <div id="pac-container">
                                        <input type="text" class="form-control" id="pac-input"  name="address" value="" placeholder="Enter address" required>
                                        <label class=" alert-danger hide" id="address_error"> Please Enter Property Address </label>
                                       </div>
<!--<div id="type-selector " class="pac-controls">
          <input type="radio" name="type" id="changetype-all" checked="checked">
          <label for="changetype-all">All</label>

          <input type="radio" name="type" id="changetype-establishment">
          <label for="changetype-establishment">Establishments</label>

          <input type="radio" name="type" id="changetype-address">
          <label for="changetype-address">Addresses</label>

          <input type="radio" name="type" id="changetype-geocode">
          <label for="changetype-geocode">Geocodes</label>
          
          <span>  <div id="strict-bounds-selector" class="pac-controls">
          <input type="checkbox" id="use-strict-bounds" value="">
          <label for="use-strict-bounds">Strict Bounds</label>
              </div></span>
      
</div>-->
<!--<div> <div id="strict-bounds-selector" class="pac-controls">
          <input type="checkbox" id="use-strict-bounds" value="">
          <label for="use-strict-bounds">Strict Bounds</label>
        </div></div>-->
<!--      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>-->
   <div class="pac-card" id="pac-card"> 
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>
 <!--<div id="map"></div>-->   
    </div>
   
   
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label for="property-price" class="bold-class">Longitude</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="longitude" name="longitude" value="" placeholder="Enter Longitude">
                                        <label class=" alert-danger hide" id="longitude_error"> Please Enter Property Longitude </label>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="property-price-before" class="bold-class">Latitude</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="latitude" name="latitude" value="" placeholder="Enter latitude">
                                        <label class=" alert-danger hide" id="latitude_error"> Please Enter Property Latitude </label>
                                    </div>
                                </div>
                            </div>
                         <div class="row">
                            <div class="col-sm-12">
                                                                <!--<div class="add-title-tab bold-class">Google Map</div>-->
                                <div id="map"></div>
                                <label class=" alert-danger hide" id="map_error"> Please Select Location of Property </label>
                                <button class="btn btn-primary btn-block">Place the pin using the property address above</button>
                            </div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="account-block hide" id="blockthree">-->
            <div class="account-block" id="blockthree">
                <div class="add-title-tab">
                    <h3>Property  Detail</h3>
                </div>
                <div class="add-tab-content">

                    <div class="add-tab-row push-padding-bottom">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <label for="property-title" class="bold-class">Property Title</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input class="form-control" id="property_title" name="title" value="" placeholder="Enter your property title" required>
                                        <label class=" alert-danger hide" id="title_error"> Please Enter Title of Property </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 ">
                                <div class="col-md-2">
                                    <label for="description" class="bold-class">Description</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class='box well well-sm' style="background-color: #7ca1f9; border: 1px solid #7ca1f9;">
                                            <div class='box-header'>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools"></div>
                                                <!-- /. tools --> </div>
                                            <!-- /.box-header -->
                                            <div class='box-body pad'>
                                                <textarea class="textarea editor-cls form-control" placeholder="Place some text here" value=""rows="10" id="description" name="description" required></textarea>
                                            </div>
                                        </div>
                                        <!--<textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter your property Description" required></textarea>-->
                                        <label class=" alert-danger hide" id="description_error"> Please Enter Description of Property </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" id="project_div">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-2">
                                        <label for="property-price-after hide" class="bold-class">Price: Rs.</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control outline" id="price" name="price" min="1" value="" placeholder="Enter Prices" type="number" >
                                            <label class=" alert-danger hide" id="price_error"> Please Enter Price of Property </label>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-sm-2">
                                                                            <label for="property-price-before" class="bold-class">Label</label>
                                                                        </div>-->
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <select class="selectpicker" id="Label" name="Label" data-live-search="false" data-live-search-style="begins" >
                                                <option value="Final">Final </option>
                                                <option value="PerMonth">Per Month</option>
                                                <option value="PerYear">Per Year</option>
                                                <option value="Negotiable">Negotiable</option>
                                            </select>
                                            <label class=" alert-danger hide" id="Label_error"> Please Select Anyone label </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Land Area</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control" id="area" name="area" value="" placeholder="Enter Area" type="number" min="1" >
                                            <label class=" alert-danger hide" id="area_error"> Please Enter Property Area </label>
                                        </div>
                                    </div>

                                    <!--                                    <div class="col-sm-2">
                                                                            <label for="property-price-before" class="bold-class">Unit</label>
                                                                        </div>-->
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <select  class="selectpicker" id="area_unit" name="area_unit" data-live-search="false" data-live-search-style="begins">
                                                <option value="Marla">Marla</option>
                                                <option value="Kanal">Kanal</option>
                                                <option value="acres">Acres</option>
                                                <option value="Square Yard">Square Yard</option>
                                                <option value="Square Feet">Square Feet</option>
                                            </select>
                                            <label class=" alert-danger hide" id="area_unit_error"> Please Select Anyone Area Unit </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="projects hide" id="green_property">
                            <div class="add-title-tab" >
                                <h3>More Details</h3>
                            </div>

                            <div class="add-tab-row push-padding-bottom">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <label for="property-price-after" class="bold-class">Rooms / Bed Rooms</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control outline" id="beds" type="number" min="1" name="beds" value="" placeholder="Enter Number of Beds ">
                                            <label class=" alert-danger hide" id="beds_error"> Please Enter Number of Beds </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="property-price-after" class="bold-class">Bath / Wash Rooms</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control outline" id="bathroom" type="number" min="1" name="bathroom" value="" placeholder="Enter Number of Bathroom ">
                                            <label class=" alert-danger hide" id="bathroom_error"> Please Enter Number of Bathroom </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="property-price-after" class="bold-class">Floors</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control outline" id="floor" name="floor"  type="number" min="1" value="" placeholder="Enter Number of Floor ">
                                            <label class=" alert-danger hide" id="floor_error"> Please Enter Number of Floor </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <label for="property-price-after" class="bold-class">Kitchens</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control outline" id="kitchens" name="kitchens" type="number" min="1" value="" placeholder="Enter Number of Kitchens ">
                                            <label class=" alert-danger hide" id="kitchens_error"> Please Enter Number of kitchens </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="projects hide" id="projects_size">
                            <!--<div class="projects " id="projects_size">-->
                            <div class="add-title-tab">
                                <h3>Property Option</h3>
                            </div>
                            <div class="add-tab-row push-padding-bottom">
                                <div class="col-sm-12">
                                    <label for="Title" class="col-sm-4 bold-class" >Title</label>
                                    <label for="Title" class="col-sm-2 bold-class">Property Type</label>
                                    <label for="Title" class="col-sm-2 bold-class">Price</label>
                                    <label for="Title" class="col-sm-1 bold-class">Beds</label>
                                    <label for="Title" class="col-sm-1 bold-class">Bath</label>
                                    <label for="Title" class="col-sm-2 bold-class">Property Size</label>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title0" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type0">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price0" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds0" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath0" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size0" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
<!--                                                    <span class="input-group-btn">
                                                        
                                                        <button class="btn btn-success btn-option" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </span>-->
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title1" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type1">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price1" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds1" name="beds1" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath1" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size1" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title2" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type2">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price2" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds2" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath2" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size2" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title3" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type3">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price3" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds3" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath3" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size3" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title4" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type4">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price4" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds4" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath4" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size4" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title5" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type5">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price5" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds5" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath5" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size5" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="control-group" id="fie">
                                        <label class="control-label hide" for="field1">
                                            <label class=" alert-danger " id="title_error"> Please enter data </label>
                                        </label>
                                        <div class="controled">
                                            <div class="entry input-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-4">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="title" name="title6" value="" placeholder="Enter Property title">
                                                                <label class=" alert-danger hide" id="title_error"> Please Enter title </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <select class="form-control"  data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" id="property_type" name="property_type6">
                                                                    <option class="bs-title-option" value="">Select</option>
                                                                    <option value="Residential">Residential</option>
                                                                    <option value="Commercial">Commercial</option>
                                                                </select>
                                                                <label class=" alert-danger hide" id="property_type_error"> Please Enter property_type </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="price" name="price6" value="" placeholder="Enter price">
                                                                <label class=" alert-danger hide" id="price_error"> Please Enter price </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style="padding: 2px;">
                                                                <input type="text" class="form-control" id="beds" name="beds6" value="" placeholder="Enter beds">
                                                                <label class=" alert-danger hide" id="beds_error"> Please Enter beds </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="bath" name="bath6" value="" placeholder="Enter Property bath">
                                                                <label class=" alert-danger hide" id="bath_error"> Please Enter bath </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group" style=" padding: 2px;">
                                                                <input type="text" class="form-control" id="property_size" name="property_size6" value="" placeholder="Enter property_size">
                                                                <label class=" alert-danger hide" id="property_size_error"> Please Enter property_size </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="homeandcommercial hide" id="homeandcommercial">
                        <div class="add-title-tab">
                            <h3>Measurement of Land</h3>
                            <!--<div class="add-expand"></div>-->
                        </div>
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class" >Road Of Front</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" id="height" name="height" value="" placeholder="Enter height ft" type="number">
                                            <label class=" alert-danger hide" id="height_error"> Please Enter Property Height </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Depth</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" id="width" name="width" value="" placeholder="Enter width ft" type="number">
                                            <label class=" alert-danger hide" id="width_error"> Please Enter Property Width </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Constructed Area</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input  class="form-control" id="ConstructedArea" name="ConstructedArea" value="" placeholder="Enter Constructed Area">
                                            <label class=" alert-danger hide" id="ConstructedArea_error"> Please Enter Property Constructed Area </label>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-sm-2">
                                                                            <label for="property-price-before" class="bold-class">Constructed Area Unit</label>
                                                                        </div>-->
                                    <div class="form-group"> 
                                        <div class="col-sm-2">
                                            <select  class="selectpicker" id="CAarea_unit" name="CAarea_unit" data-live-search="false" data-live-search-style="begins" >
                                                <option value="Marla">Marla</option>
                                                <option value="Kanal">Kanal</option>
                                                <option value="acres">Acres</option>
                                                <option value="Square Yard">Square Yard</option>
                                                <option value="Square Feet">Square Feet</option>
                                            </select>
                                            <label class=" alert-danger hide" id="CAarea_unit_error"> Please Select Anyone Area Unit </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">       
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Open Area</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input class="form-control" id="OpenArea" name="OpenArea" value="" placeholder="Enter Open Area">
                                            <label class=" alert-danger hide" id="OpenArea_error"> Please Enter Property Open Area </label>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-sm-2">
                                                                            <label for="property-price-before" class="bold-class">Open Area Unit</label>
                                                                        </div>-->
                                    <div class="form-group"> 
                                        <div class="col-sm-2">
                                            <select  class="selectpicker" id="OAarea_unit" name="OAarea_unit" data-live-search="false" data-live-search-style="begins">
                                                <option value="Marla">Marla</option>
                                                <option value="Kanal">Kanal</option>
                                                <option value="acres">Acres</option>
                                                <option value="Square Yard">Square Yard</option>
                                                <option value="Square Feet">Square Feet</option>
                                            </select>
                                            <label class=" alert-danger hide" id="OAarea_unit_error"> Please Select Anyone Area Unit </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Construction Year</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="date_text" class="form-control" id="ConstructionYear" name="ConstructionYear" value="" placeholder="Enter Construction Year" >
                                            <label class=" alert-danger hide" id="ConstructionYear_error"> Please Enter Property Construction Year </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="property-price-after" class="bold-class">Owner Ship Status</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select class="selectpicker" id="OwnerShipStatus" name="OwnerShipStatus" data-live-search="false" data-live-search-style="begins" title="Select" >
                                                <option value="Allotment">Allotment </option>
                                                <option value="Registered">Registered </option>
                                                <option value="Leased">Leased  </option>
                                            </select>
                                            <label class=" alert-danger hide" id="OwnerShipStatus_error"> Please Select Anyone Owner Ship Status </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-block" id="blockfive">

                        <div class="add-title-tab">
                            <h3>Property media</h3>
                        </div>
                        <div class="add-tab-content">
                            <div class="add-tab-row">
                                <div class="property-media "  id="fileupload33">
                                    <div class="media-gallery" >
                                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="control-group" id="fields">
                                                    <label class="control-label" for="field1">
                                                        if Upload More than One images Click <span class="glyphicon glyphicon-plus"></span> Button <br>
                                                        <label class=" alert-danger hide" id="image_error"> Please upload image </label>
                                                    </label>
                                                    <div class="controls">
                                                        <div class="entry input-group col-xs-12">
                                                            <input class="btn btn-primary form-control" name="image[]"  accept="image/*" type="file" required id="image">     
                                                            <span class="input-group-btn" style="left:5px;padding-bottom: 2px;">
                                                                <button class="btn btn-success btn-add" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </span>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="col-sm-12">
                                                    <label for="property-price-before" class="bold-class">Please Enter Property Video Url</label>
                                                    <input type="text" class="form-control" id="video_url" name="video_url" value="" placeholder="Enter Property Video Url Link">
                                                </div>
                                            </div>
                                            @if( Auth::user()->BusinessType == '2')
                                            <div class="col-sm-4">
                                                <div class="col-sm-12">
                                                    <label for="property-price-before" class="bold-class">Select Agent </label>
                                                    <select class="selectpicker" id="agent_id" name="agent_id" data-live-search="false" dat-live-search-style="begins" title="Select">
                                                        @foreach($agent as $agentdata)
                                                        <option value="{{$agentdata->id}}">{{$agentdata->name}}</option>
                                                        @endforeach
                                                    </select> 
                                                    <label class=" alert-danger hide" id="agent_id_error"> Please Select Agent of Property </label> </div>
                                            </div>
                                            @endif
                                        </div>
                                        <!--                                <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <div class="btn btn-info">
                                                                                    <input type="file" name="image[]" required accept="image/*" multiple>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                        
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <div class="btn btn-danger">
                                                                                    <input type="file" name="image[]"  accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <div class="btn btn-primary">
                                                                                    <input type="file" name="image[]"   accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                        
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <div class="btn btn-success">
                                                                                    <input type="file" name="image[]"  accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <div class="btn btn-warning">
                                                                                    <input type="file" name="image[]"  accept="image/*">
                                                                                </div>
                                                                            </div>
                                                                        </div>-->
                                    </div>
                                </div>


                                {{--<div class="add-title-tab">--}}
                                {{--<h3>Property Expire</h3>--}}
                                {{--</div>--}}
                                {{--<div class="add-tab-content">--}}
                                {{--<div class="add-tab-row">--}}
                                {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<select class="selectpicker" id="propertexpire" name="propertexpire" data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98">--}}
                                {{--<option class="bs-title-option" value="">Select</option>--}}
                                {{--<option value="1"> One Months</option>--}}
                                {{--<option value="2"> Two Months</option>--}}
                                {{--<option value="3"> Three Months</option>--}}
                                {{--<option value="4"> Four Months</option>--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="add-tab-content">--}}
                                {{--<div class="add-tab-row">--}}
                                {{--<div class="col-sm-6">--}}
                                {{--<div class="form-group">--}}
                                {{--<label for="property-price-before" class="bold-class">Please Enter Property Video Url</label>--}}
                                {{--<input type="text" class="form-control" id="video_url" name="video_url" value="" placeholder="Enter Property Video Url Link">--}}
                                {{--<label class="alert-info"> Optional (Enter If you have your property Video on youtube) </label>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                            </div>
                        </div>
                    </div>
                    <div class="add-tab-content">
                        <div class="add-title-tab">
                            <h3>Maps & Payment Plans</h3>
                        </div>
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="control-group" id="fie">
                                            <label class="control-label" for="field1">
                                                if Upload More than One images Click <span class="glyphicon glyphicon-plus"></span> Button <br>
                                                <!--<label class=" alert-danger hide" id="image_error"> Please upload image </label>-->
                                            </label>
                                            <div class="cont">
                                                <div class="entry input-group col-xs-12">
                                                    <input class="btn btn-primary form-control" name="paymentPlansImage[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" id="paymentPlansImage">     
                                                    <span class="input-group-btn" style="left:5px;padding-bottom: 2px;">
                                                        <button class="btn btn-success btn-added" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button><
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="account-block hide" id="blockfour">-->
                <div class="account-block" id="blockfour">
                    <div class="add-title-tab">
                        <h3>Property Features</h3>
                    </div>
                    <div class="add-tab-content">
                        <div class="add-tab-row push-padding-bottom">

                            <div class="row" id="housefeature">
                                @foreach($housefeature as $feature)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="feature[]" value="{{ $feature->id }}">
                                            {{ $feature->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>


                            <div class="row" id="landfeature">
                                @foreach($landfeature as $feature)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="feature[]" value="{{ $feature->id }}">
                                            {{ $feature->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row" id="projectsfeature">
                                @foreach($projectsfeature as $feature)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="feature[]" value="{{ $feature->id }}">
                                            {{ $feature->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="add-title-tab">
                        <h3>Extra Features</h3>
                    </div>
                    <div class="add-tab-content">
                        <div class="add-tab-row push-padding-bottom">
                            <div class="row" id="houseservices">
                                @foreach($houseservices as $services)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="services[]" value="{{ $services->id }}">
                                            {{ $services->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row" id="landservices">
                                @foreach($landservices as $services)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="services[]" value="{{ $services->id }}">
                                            {{ $services->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="row" id="projectsservices">
                                @foreach($projectsservices as $services)
                                <div class="col-sm-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="services[]" value="{{ $services->id }}">
                                            {{ $services->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="add-tab-row push-padding-bottom">
                            <div class="col-sm-2 col-sm-offset-5">
                                <label for="property-price-before" class="bold-class">Expiry Date</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="selectpicker" id="propertexpire" name="propertexpire" data-live-search="false" data-live-search-style="begins" title="Select" tabindex="-98" required>
                                        <option class="bs-title-option" value="">Select</option>
                                        <option value="1"> One Months</option>
                                        <option value="2"> Two Months</option>
                                        <option value="3"> Three Months</option>
                                        <option value="4"> Four Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="account-block text-right">
                                <!--<button type="button" id="buttonbackfive" class="btn btn-info">Back</button>-->
                                <button type="Submit" class="btn btn-primary" id="submit">Save Property</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

<!--end section page body-->
@endsection

@section('pagejs')
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKvuyrvPumFAi_BQR8ygi206QFZmoCkuk&libraries=places&callback=initMap"
        async defer></script>
<script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
// $('.target').change(function () {
//        //alert($('select[name="city"]').find(':selected').attr('class').split(','));
//
//        var coordinate = $('select[name="city"]').find(':selected').attr('class').split(',');//$('select option:selected').val().split(',');
//        map.setCenter(new google.maps.LatLng(coordinate[0], coordinate[1]));
//    });

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 33.7294, lng: 73.0931},
          zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        
        var marker = new google.maps.Marker({
         
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });
          
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            document.getElementById('place-name').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
//            alert("This function is working!");
//            alert(place.name);
//            alert(place.address_components[0].long_name);
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
 
          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
        var addListener = infowindow.open(map, marker);
      
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
              
            });

        map.addListener('click', function (e) {
            // if the previousMarker exists, remove it
            if (marker)
                marker.setMap(null);

            latLng = e.latLng;

            var latitude = e.latLng.lat();
            var longitude = e.latLng.lng();

            $('#latitude').val(latitude);
            $('#longitude').val(longitude);

            //image = clientURL + "/common/images/markers/red.png";

            marker = new google.maps.Marker({
                position: latLng,
                map: map
            });
        }

        );
       
      }
    </script>

<script>

//    $('.target').change(function () {
//        //alert($('select[name="city"]').find(':selected').attr('class').split(','));
//
//        var coordinate = $('select[name="city"]').find(':selected').attr('class').split(',');//$('select option:selected').val().split(',');
//        map.setCenter(new google.maps.LatLng(coordinate[0], coordinate[1]));
//    });




//    var map;
//    var previousMarker; // global variable to store previous marker
//    function initMap() {
//        map = new google.maps.Map(document.getElementById('map'), {
//            center: {
//                lat: 33.7294,
//                lng: 73.0931
//            },
//            zoom: 10
//        });
//        map.addListener('click', function (e) {
//            // if the previousMarker exists, remove it
//            if (previousMarker)
//                previousMarker.setMap(null);
//
//            latLng = e.latLng;
//
//            var latitude = e.latLng.lat();
//            var longitude = e.latLng.lng();
//
//            $('#latitude').val(latitude);
//            $('#longitude').val(longitude);
//
//            //image = clientURL + "/common/images/markers/red.png";
//
//            previousMarker = new google.maps.Marker({
//                position: latLng,
//                map: map
//            });
//        }
//
//        );
//    }
</script>
  
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0C1Dmi-PE4nrIHJ3sxb2NqBdS6pj2n1o&callback=initMap" async defer></script>-->

<script>
    $(document).ready(function ()
    {
        var subtype = '';

        $("#onlyhouse").click(function () {
            $("#house").removeClass("hide");
            $("#commercial").addClass("hide");
            $("#projects").addClass("hide");

            $("#housefeature").removeClass("hide");
            $("#houseservices").removeClass("hide");

            $("#landfeature").addClass("hide");
            $("#projectsfeature").addClass("hide");
            $("#landservices").addClass("hide");
            $("#projectsservices").addClass("hide");
        });
        $("#onlyland").click(function () {
            $("#house").addClass("hide");
            $("#commercial").removeClass("hide");
            $("#projects").addClass("hide");

            $("#landfeature").removeClass("hide");
            $("#landservices").removeClass("hide");

            $("#projectsfeature").addClass("hide");
            $("#projectsservices").addClass("hide");
            $("#housefeature").addClass("hide");
            $("#houseservices").addClass("hide");

        });
        $("#onlyprojects").click(function () {
            $("#house").addClass("hide");
            $("#commercial").addClass("hide");
            $("#projects").removeClass("hide");


            $("#projectsfeature").removeClass("hide");
            $("#projectsservices").removeClass("hide");

            $("#landfeature").addClass("hide");
            $("#landservices").addClass("hide");
            $("#housefeature").addClass("hide");
            $("#houseservices").addClass("hide");

        });



        $("form input:radio").change(function () {
            subtype = $(this).val();

            if (subtype == 'School / College' ||
                    subtype == 'Guest House/Banquet Hall' ||
                    subtype == 'Office' ||
                    subtype == 'Lower Protion' ||
                    subtype == 'Upper Portion' ||
                    subtype == 'Form Houses' ||
                    subtype == 'Flats / Appartments' ||
                    subtype == 'Houses / Villas'
                    ) {
                $('#green_property').removeClass("hide");
            } else {
                $('#green_property').addClass("hide");
            }
            if (
                    subtype == 'Residental Town / Schemes' ||
                    subtype == 'Land Sub Divisions' ||
                    subtype == 'Commercial Plaza / Tower' ||
                    subtype == 'Industrial Estates /Zone'
                    ) {
                $('#projects_size').removeClass("hide");
                $('#homeandcommercial').addClass("hide");
                $('#project_div').addClass("hide");
            } else {
                $('#project_div').removeClass("hide");
                $('#homeandcommercial').removeClass("hide");
                $('#projects_size').addClass("hide");
            }
        });

        $("#submit").click(function () {



            if (!($('input[name=purpose]:checked').length > 0)) {
                $('#purpose_error').removeClass("hide");
            }
            if (!($('input[name=type]:checked').length > 0)) {
                $('#type_error').removeClass("hide");
            }
            if (!($('input[name=subtype]:checked').length > 0) && $('input[name=type]:checked').val() == 'house') {
                $('#house_error').removeClass("hide");
            }
            if (!($('input[name=subtype]:checked').length > 0) && $('input[name=type]:checked').val() == 'land') {
                $('#land_error').removeClass("hide");
            }
            if (!($('input[name=subtype]:checked').length > 0) && $('input[name=type]:checked').val() == 'projects') {
                $('#projects_error').removeClass("hide");
            }



            if (($('input[name=purpose]:checked').length > 0) && ($('input[name=type]:checked').length > 0) && ($('input[name=subtype]:checked').length > 0))
            {
                $("#headone").removeClass("active");
                $("#headtwo").addClass("active");
//                $("#blockone").addClass("hide");
                $("#blockone").addClass("active");
//                $("#blocktwo").removeClass("hide");
                $("#blocktwo").removeClass("active");
                initMap();

            }
//button 2
            var agent_id = $("#agent_id").val();
            if (agent_id == '') {
                $("#agent_id").focus();
                $('#agent_id_error').removeClass("hide");
            }
            var city = $("#city").val();
            if (city == '') {
                $("#city").focus();
                $('#city_error').removeClass("hide");
            }
            var address = $("#address").val();
            if (address == '') {
                $("#address").focus();
                $('#address_error').removeClass("hide");
            }
            // var latitude = $("#latitude").val();
            // var longitude = $("#longitude").val();
            // if (latitude == '' || longitude == '') {
            //     $('#map_error').removeClass("hide");
            // }

            if (latitude != '' && longitude != '' && address != '' && address != '') {

                $("#headtwo").removeClass("active");
                $("#headthree").addClass("active");
//                $("#blockthree").removeClass("hide");
                $("#blockthree").removeClass("active");
//                $("#blocktwo").addClass("hide");
                $("#blocktwo").addClass("active");
                if ($('input[name=type]:checked').val() == 'projects') {
                    $('#projects_size').removeClass("hide");
                    $('#homeandcommercial').addClass("hide");
                    $('#project_div').addClass("hide");
                } else {
                    $('#project_div').removeClass("hide");
                    $('#homeandcommercial').removeClass("hide");
                    $('#projects_size').addClass("hide");
                }
            }

//    button 3
//            var image = $("#image").val();
//            if (image == '') {
//                $('#image_error').removeClass("hide");
//            }
            var property_title = $("#property_title").val();
            if (property_title == '') {
                $('#title_error').removeClass("hide");
            }
            var description = $("#description").val();
            if (description == '') {
                $('#description_error').removeClass("hide");
            }
            var area = $("#area").val();
            if (area == '') {
                $('#area_error').removeClass("hide");
            }
            var area_unit = $("#area_unit").val();
            if (area_unit == '') {
                $('#area_unit_error').removeClass("hide");
            }
            var Label = $("#Label").val();
            if (Label == '') {
                $("#Label").focus();
                $('#Label_error').removeClass("hide");
            }

            var ConstructedArea = $("#ConstructedArea").val();
            if (ConstructedArea == '') {
                $("#ConstructedArea").focus();
                $('#ConstructedArea_error').removeClass("hide");
            }
            var CAarea_unit = $("#CAarea_unit").val();
            if (CAarea_unit == '') {
                $("#CAarea_unit").focus();
                $('#CAarea_unit_error').removeClass("hide");
            }
            var OwnerShipStatus = $("#OwnerShipStatus").val();
            if (OwnerShipStatus == '') {
                $("#OwnerShipStatus").focus();
                $('#OwnerShipStatus_error').removeClass("hide");
            }
            var ConstructionYear = $("#ConstructionYear").val();
            if (ConstructionYear == '') {
                $("#ConstructionYear").focus();
                $('#ConstructionYear_error').removeClass("hide");
            }
            var OpenArea = $("#OpenArea").val();
            if (OpenArea == '') {
                $("#OpenArea").focus();
                $('#OpenArea_error').removeClass("hide");
            }
            var OAarea_unit = $("#OAarea_unit").val();
            if (OAarea_unit == '') {
                $("#OAarea_unit").focus();
                $('#OAarea_unit_error').removeClass("hide");
            }

            if ($('input[name=type]:checked').val() == 'projects')
            {
//                                var title = $("#title").val();
//                                if (title == '') {
//                                    $('#title_error').removeClass("hide");
//                                }
//                                var property_type = $("#property_type").val();
//                                if (property_type == '') {
//                                    $('#property_type_error').removeClass("hide");
//                                }
//                                var price = $("#price").val();
//                                if (price == '') {
//                                    $('#price_error').removeClass("hide");
//                                }
//                                var beds = $("#beds").val();
//                                if (beds == '') {
//                                    $('#beds_error').removeClass("hide");
//                                }
//                                var bath = $("#bath").val();
//                                if (bath == '') {
//                                    $('#bath_error').removeClass("hide");
//                                }
//                                var property_size = $("#property_size").val();
//                                if (property_size == '') {
//                                    $('#property_size').removeClass("hide");
//                                }
                var area = $("#area").val();
                if (area == '') {
                    $('#area_error').addClass("hide");
                }
                var area_unit = $("#area_unit").val();
                if (area_unit == '') {
                    $('#area_unit_error').addClass("hide");
                }
                var Label = $("#Label").val();
                if (Label == '') {
                    $("#Label").focus();
                    $('#Label_error').addClass("hide");
                }

                var ConstructedArea = $("#ConstructedArea").val();
                if (ConstructedArea == '') {
                    $("#ConstructedArea").focus();
                    $('#ConstructedArea_error').addClass("hide");
                }
                var CAarea_unit = $("#CAarea_unit").val();
                if (CAarea_unit == '') {
                    $("#CAarea_unit").focus();
                    $('#CAarea_unit_error').addClass("hide");
                }
                var OwnerShipStatus = $("#OwnerShipStatus").val();
                if (OwnerShipStatus == '') {
                    $("#OwnerShipStatus").focus();
                    $('#OwnerShipStatus_error').addClass("hide");
                }
                var ConstructionYear = $("#ConstructionYear").val();
                if (ConstructionYear == '') {
                    $("#ConstructionYear").focus();
                    $('#ConstructionYear_error').addClass("hide");
                }
                var OpenArea = $("#OpenArea").val();
                if (OpenArea == '') {
                    $("#OpenArea").focus();
                    $('#OpenArea_error').addClass("hide");
                }
                var OAarea_unit = $("#OAarea_unit").val();
                if (OAarea_unit == '') {
                    $("#OAarea_unit").focus();
                    $('#OAarea_unit_error').addClass("hide");
                }
                if (area != '' && area_unit != '' && property_title != '' && description != '' && size1 != '' && rate1 != '' && size2 != '' && rate2 != '' && ConstructedArea != '' && OwnerShipStatus != '' && ConstructionYear != '' && OpenArea != '')
                {
                    $("#headthree").removeClass("active");
                    $("#headfour").addClass("active");
//                    $("#blockthree").addClass("hide");
                    $("#blockthree").addClass("active");
//                    $("#blockfour").removeClass("hide");
                    $("#blockfour").removeClass("active");
                    $("#headfive").addClass("active");
                    $("#blockfive").removeClass("active");
                }

            } else {

                var price = $("#price").val();
                if (price == '') {
                    $('#price_error').removeClass("hide");
                }
                var height = $("#height").val();
                if (height == '') {
                    $('#height_error').removeClass("hide");
                }
                var width = $("#width").val();
                if (width == '') {
                    $('#width_error').removeClass("hide");
                }



                if (subtype == 'School / College' ||
                        subtype == 'Guest House/Banquet Hall' ||
                        subtype == 'Office' ||
                        subtype == 'Lower Protion' ||
                        subtype == 'Upper Portion' ||
                        subtype == 'Form Houses' ||
                        subtype == 'Flats / Appartments' ||
                        subtype == 'Houses / Villas'
                        ) {
                    var beds = $("#beds").val();
                    if (beds == '') {
                        $("#beds").focus();
                        $('#beds_error').removeClass("hide");
                    }
                    var bathroom = $("#bathroom").val();
                    if (bathroom == '') {
                        $("#bathroom").focus();
                        $('#bathroom_error').removeClass("hide");
                    }
                    var floor = $("#floor").val();
                    if (floor == '') {
                        $("#floor").focus();
                        $('#floor_error').removeClass("hide");
                    }
                    var kitchens = $("#kitchens").val();
                    if (kitchens == '') {
                        $("#kitchens").focus();
                        $('#kitchens_error').removeClass("hide");
                    }


                    if (beds != '' && bathroom != '' && floor != '' && floor != '' && kitchens != '' && area != '' && area_unit != '' && property_title != '' && description != '' && height != '' && width != '' && ConstructedArea != '' && OwnerShipStatus != '' && ConstructionYear != '' && OpenArea != '')
                    {
                        $("#headthree").removeClass("active");
                        $("#headfour").addClass("active");
//                        $("#blockthree").addClass("hide");
                        $("#blockthree").addClass("active");
//                        $("#blockfour").removeClass("hide");
                        $("#blockfour").removeClass("active");
                        $("#headfive").addClass("active");
                        $("#blockfive").removeClass("active");
                    }


                } else {

                    if (area != '' && area_unit != '' && property_title != '' && description != '' && height != '' && width != '' && ConstructedArea != '' && OwnerShipStatus != '' && ConstructionYear != '' && OpenArea != '')
                    {
                        $("#headthree").removeClass("active");
                        $("#headfour").addClass("active");
//                        $("#blockthree").addClass("hide");
                        $("#blockthree").addClass("active");
//                        $("#blockfour").removeClass("hide");
                        $("#blockfour").removeClass("active");
                        $("#headfive").addClass("active");
                        $("#blockfive").removeClass("active");
                    }

                }


            }

        });

        $("#submit").click(function ()
        {

            $("#headfour").removeClass("active");
            $("#headfive").addClass("active");
//            $("#blockfour").addClass("hide");
            $("#blockfour").addClass("active");
//            $("#blockfive").removeClass("hide");
            $("#blockfive").removeClass("active");
            initMap();

        });
//
//
//
//        $(function () {
//            $("input#files[type='file']").change(function () {
//                var $fileUpload = $("input#files[type='file']");
//                if (parseInt($fileUpload.get(0).files.length) > 5) {
//                    alert("You can only upload a maximum of 5 files");
//                    return false;
//                }
//            });
//        });



        $("#one").click(function () {

            $('.one').removeClass('hide');
            $('#page-block-1').addClass('active')
            $('.two').addClass('hide');
            $('.three').addClass('hide');
            $('.four').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-4').removeClass('active')


        });
        $("#two").click(function () {
            $('.two').removeClass('hide');
            $('#page-block-2').addClass('active')
            $('.one').addClass('hide');
            $('.three').addClass('hide');
            $('.four').addClass('hide');
            $('#page-block-1').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-4').removeClass('active')
        });
        $("#three").click(function () {
            $('.three').removeClass('hide');
            $('#page-block-3').addClass('active')
            $('.one').addClass('hide');
            $('.two').addClass('hide');
            $('.four').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-1').removeClass('active')
            $('#page-block-4').removeClass('active')
        });
        $("#four").click(function () {
            $('.four').removeClass('hide');
            $('#page-block-4').addClass('active')
            $('.one').addClass('hide');
            $('.two').addClass('hide');
            $('.three').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-1').removeClass('active')
        });
    });
    //multiple images add property media
    $(function ()
    {
        $(document).on('click', '.btn-add', function (e)
        {
            e.preventDefault();
            var inputCount = $('.controls').find('input').length;
            if (inputCount <= 4) {
                var controlForm = $('.controls:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(controlForm);
            }

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function (e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
//end multiple images
//    //multiple Field property option button
    $(function ()
    {
        $(document).on('click', '.btn-option', function (e)
        {
            e.preventDefault();
//            var inputCount = $('.controled').find('input').length;
            var button = $('.controled').find('button').length;
            if (button <= 3) {
//            if (inputCount <= 20) {
                var controlForm = $('.controled:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(controlForm);
//            }
            }
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-option')
                    .removeClass('btn-option').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function (e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
////end multiple images
//multiple images add maps and payments plan 
    $(function ()
    {
        $(document).on('click', '.btn-added', function (e)
        {
            e.preventDefault();
            var inputCount = $('.cont').find('input').length;
            if (inputCount <= 4) {
                var controlForm = $('.cont:first'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).appendTo(controlForm);
            }

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-added')
                    .removeClass('btn-added').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function (e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });
</script>


<!-- The template to display files available for upload -->
{{--<script id="template-upload" type="text/x-tmpl">--}}
{{--{% for (var i=0, file; file=o.files[i]; i++) { %}--}}
{{--<tr class="template-upload fade">--}}
{{--<td>--}}
{{--<span class="preview"></span>--}}
{{--</td>--}}

{{--<td>--}}

{{--{% if (!i) { %}--}}
{{--<button class="btn btn-warning cancel">--}}
{{--<i class="glyphicon glyphicon-ban-circle"></i>--}}
{{--<span>Cancel</span>--}}
{{--</button>--}}
{{--{% } %}--}}
{{--</td>--}}
{{--</tr>--}}
{{--{% } %}--}}
{{--</script>--}}
<!-- The template to display files available for download -->
{{--<script id="template-download" type="text/x-tmpl">--}}
{{--{% for (var i=0, file; file=o.files[i]; i++) { %}--}}
{{--<tr class="template-download fade">--}}
{{--<td>--}}
{{--<span class="preview">--}}
{{--{% if (file.thumbnailUrl) { %}--}}
{{--<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>--}}
{{--{% } %}--}}
{{--</span>--}}
{{--</td>--}}
{{--<td>--}}
{{--<p class="name">--}}
{{--{% if (file.url) { %}--}}
{{--<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>--}}
{{--{% } else { %}--}}
{{--<span>{%=file.name%}</span>--}}
{{--{% } %}--}}
{{--</p>--}}
{{--{% if (file.error) { %}--}}
{{--<div><span class="label label-danger">Error</span> {%=file.error%}</div>--}}
{{--{% } %}--}}
{{--</td>--}}
{{--<td>--}}
{{--<span class="size">{%=o.formatFileSize(file.size)%}</span>--}}
{{--</td>--}}
{{--<td>--}}
{{--{% if (file.deleteUrl) { %}--}}
{{--<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>--}}
{{--<i class="glyphicon glyphicon-trash"></i>--}}
{{--<span>Delete</span>--}}
{{--</button>--}}
{{--<input type="checkbox" name="delete" value="1" class="toggle">--}}
{{--{% } else { %}--}}
{{--<button class="btn btn-warning cancel">--}}
{{--<i class="glyphicon glyphicon-ban-circle"></i>--}}
{{--<span>Cancel</span>--}}
{{--</button>--}}
{{--{% } %}--}}
{{--</td>--}}
{{--</tr>--}}
{{--{% } %}--}}
{{--</script>--}}




{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
{{--<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->--}}
{{--<script src="{{asset('assets/js/vendor/jquery.ui.widget.js')}}"></script>--}}
{{--<!-- The Templates plugin is included to render the upload/download listings -->--}}
{{--<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>--}}
{{--<!-- The Load Image plugin is included for the preview images and image resizing functionality -->--}}
{{--<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>--}}

{{--<!-- The basic File Upload plugin -->--}}
{{--<script src="{{asset('assets/js/jquery.fileupload.js')}}"></script>--}}
{{--<!-- The File Upload processing plugin -->--}}
{{--<script src="{{asset('assets/js/jquery.fileupload-process.js')}}"></script>--}}
{{--<!-- The File Upload image preview & resize plugin -->--}}
{{--<script src="{{asset('assets/js/jquery.fileupload-image.js')}}"></script>--}}



{{--<!-- The File Upload user interface plugin -->--}}
{{--<script src="{{asset('assets/js/jquery.fileupload-ui.js')}}"></script>--}}
{{--<!-- The main application script -->--}}
{{--<script src="{{asset('assets/js/main.js')}}"></script>--}}
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{asset('assets/vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/vendors/ckeditor/adapters/jquery.js')}}" type="text/javascript" ></script>
<script  src="{{asset('assets/vendors/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript" ></script>
<script  src="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/js/pages/editor.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@endsection