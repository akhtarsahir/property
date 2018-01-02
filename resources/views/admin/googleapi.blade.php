@extends('admin/layouts/app')
@section('content')
    <!--page level css -->
	<?Php $edit = DB::table('citysubaddress')->first();
	$data = DB::table('city')->get(); ?>
    <!--end of page level css-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <aside class="right-side">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>Edit Cities Sub Address</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="dashboard">
                        <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                        Home   <?php $rtno = 60  .str_pad( 0, 3, "0", STR_PAD_LEFT); echo $rtno; ?>
                    </a>
                </li>
                <li>
                    <a href="{{ url('city/create') }}">Edit Cities Sub Address</a>
                </li>

            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                                Please Fill Below Form
                            </h3>
                            <span class="pull-right">
                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                            <i class="fa fa-fw fa-times removepanel clickable"></i>
                        </span>
                        </div>
                        <div class="panel-body">

                            <form action="{{ url('admin/updatesubcity' , $edit->id) }}" method="post"  class="form-horizontal">
                                {!! csrf_field() !!}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label > City </label>
                                        <div class="@if($errors->first('cityname')) has-error @endif">
                                            <label class="control-label" for="inputError"><?php echo $errors->first('cityname');?></label>
                                            <!--<input type="text" class="form-control"   name="citysubaddress" value="" placeholder="Enter address" required>-->
                                            <select  class="selectpicker form-control" name="city" id="city"  data-live-search="false" dat-live-search-style="begins" title="Select" required>
                                                <!--<option value="1">1</option>-->
                                                @foreach($data as $city)

                                                    <option class="{{ $city->latitude }},{{ $city->longitude }}" value="{{ $city->id }}">{{ $city->name }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label > Address Name  </label>
                                        <div class="@if($errors->first('citysubaddress')) has-error @endif">
                                            <label class="control-label" for="inputError"><?php echo $errors->first('citysubaddress'); ?></label>
                                            <div id="pac-container">
                                                <input type="text" class="form-control" id="pac-input"  name="citysubaddress" value="" placeholder="Enter address" required>
                                                <label class=" alert-danger hide" id="address_error"> Please Enter Property Address </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label > City sub adress Name </label>
                                        <div class="@if($errors->first('cityname')) has-error @endif">
                                            <label class="control-label" for="inputError"><?php echo $errors->first('cityname');?></label>
                                            <div class="show-first-time">
												<?php $datas = DB::table('citysubaddress')->where('city_id',$edit->id)->get();?>
                                                <select onchange="javascript:myFunction(this.value);" class="selectpicker form-control subcityaddress" name="subaddress" id="subaddress"  data-live-search="false" dat-live-search-style="begins" title="Select" required>
                                                    @foreach($datas as $city)
                                                        <option class="{{ $city->latitude }},{{ $city->longitude }}" value="{{ $city->latitude }},{{ $city->longitude }}">{{ $city->citysubaddress }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label > Add Latitude </label>
                                        <div class="@if($errors->first('latitude')) has-error @endif">
                                            <label class="control-label" for="inputError"><?php echo $errors->first('latitude'); ?></label>
                                            <input type="text" id="latitude" name="latitude" value="{{ $edit->latitude }}" placeholder="Enter Latitude" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label > Add longitude  </label>
                                        <div class="@if($errors->first('longitude')) has-error @endif">
                                            <label class="control-label" for="inputError"><?php echo $errors->first('longitude'); ?></label>
                                            <input type="text" id="longitude" name="longitude" value="{{ $edit->longitude }}" placeholder="Enter Longitude" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="" for="example-select">Location on Map</label>
                                        <div id="map" style="height: 300px;"></div>
                                    </div>
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
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <button class="btn-success btn">Update Address</button>
                                        <button type="reset" class="btn-info btn">Reset</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- content -->
    </aside>
    <!-- right-side -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKvuyrvPumFAi_BQR8ygi206QFZmoCkuk&libraries=places&callback=initMap"
            async defer></script>
    <script>
        function myFunction(value) {
            initMap2(value);
//            var subAddress = value.split(",");
//            alert( subAddress[0] );
//            alert( subAddress[1] );
//            new google.maps.Map(document.getElementById('map'), {
//                center: { lat:subAddress[0], lng:subAddress[1] },
//                zoom: 13
//            });
        }
        $(document).ready(function ()
        {
            $('#city').change(function () {
                var city_id = $(this).val();
                $.ajax({
                    url: '{{ route("get-city-address") }}',
                    type: "get",
                    data: {id:city_id},
                    success: function(response){ // What to do if we succeed
                        alert('done'+response);
                        $(".show-first-time").html(response);
                        
                    },
                    error: function(response){
                        alert('Error'+response);
                    }
                });

//                $('.subcityaddress').removeClass("hide");
                $("#subaddress").val();
            });


        });
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
            var myLatLng = {
                lat: {{ $edit -> latitude }},
                lng: {{ $edit -> longitude }}
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: {{ $edit -> latitude }}, lng:{{ $edit -> longitude }} },
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
                anchorPoint: new google.maps.Point(0, - 29)
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '{{ 'Multan'  }} !'
            });
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('place-name').value = place.name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
//            alert("This function is working!");
//            alert(place.name);
                document.getElementById('cityname').value = place.address_components[2].long_name;
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
                    map.setZoom(17); // Why 17? Because it looks good.
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
                radioButton.addEventListener('click', function () {
                    autocomplete.setTypes(types);
                });
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
            document.getElementById('use-strict-bounds')
                .addEventListener('click', function () {
                    console.log('Checkbox clicked! New state=' + this.checked);
                    autocomplete.setOptions({strictBounds: this.checked});
                });
        }


        function initMap2(value) {
            var subAddress = value.split(",");
            var latitude  = parseFloat(subAddress[0]);
            var longitude = parseFloat(subAddress[1]);
            alert( latitude );
            alert( longitude );
            var myLatLng = {
                lat: latitude,
                lng: longitude
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: latitude, lng:longitude },
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
                anchorPoint: new google.maps.Point(0, - 29)
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: '{{ 'Multan'  }} !'
            });
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('place-name').value = place.name;
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
//            alert("This function is working!");
//            alert(place.name);
                document.getElementById('cityname').value = place.address_components[2].long_name;
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
                    map.setZoom(17); // Why 17? Because it looks good.
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
                radioButton.addEventListener('click', function () {
                    autocomplete.setTypes(types);
                });
            }

            setupClickListener('changetype-all', []);
            setupClickListener('changetype-address', ['address']);
            setupClickListener('changetype-establishment', ['establishment']);
            setupClickListener('changetype-geocode', ['geocode']);
            document.getElementById('use-strict-bounds')
                .addEventListener('click', function () {
                    console.log('Checkbox clicked! New state=' + this.checked);
                    autocomplete.setOptions({strictBounds: this.checked});
                });
        }
    </script>

@endsection
