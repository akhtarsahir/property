@extends('layouts/app')


<!--page level css -->
@section('pagecss')
@endsection
<!--end of page level css-->

<?php //dd($Agent); ?>
@section('content')
<style>
/*body {
  font-family: Verdana, sans-serif;
  margin: 0;
}*/

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: absolute;
  /*z-index: 1;*/
  padding-top: 50px;
  left: 0;
  top: 0px;
  width: 100%;
  height: 100%;
  /*overflow: auto;*/
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
</style>
<!--start advanced search section-->
<!--@include('layouts.advance_search')-->
<!-- TEST SLIDER -->
<div class="detail-top detail-top-grid no-margin">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="header-detail table-list">
                    <div class="header-left">
                        <h1>
                            {{ $singleproperty->title }}

                            <span class="label-wrap hidden-sm hidden-xs">
                                        <span class="label label-primary">For  {{ $singleproperty->purpose }}</span>
                                    </span>
                        </h1>

                        <p> {{ $singleproperty->address }}
                        </p>
                    </div>
                    <div class="header-right">
                        <ul class="actions">
                            <li class="share-btn">
                                <div class="share_tooltip tooltip_left fade">
                                    <a href="/facebook/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
                                        <i class="fa fa-facebook"></i>
                                    </a>

                                    <a href="/twitter/{{ $singleproperty->id }}" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                    <a href="/pinterest/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>


                                    <a href="/gplus/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>

                                </div>

                            </li>
                        </ul>
                        <span class="item-price">
                            @if($singleproperty->purpose == 'sell' && $singleproperty->price <> '')
                            Rs {{ $singleproperty->price }}
                             <br>
                            <small style="font-size:15px;">Area:{{ $singleproperty->area }} {{ $singleproperty->area_unit }}</small>
                            @elseif( $singleproperty->price <> '')
                            Rs {{ $singleproperty->price }}/month
                            <br>
                            <small style="font-size:15px;">Area:{{ $singleproperty->area }} {{ $singleproperty->area_unit }}</small>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SLIDER -->
<!--end detail top-->

<!--start section page body-->
<section id="section-body">
    <!--start detail content-->
    <section class="section-detail-content">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="detail-bar">
                        <!-- SLIDER  -->
                        <div class="detail-media detail-top-slideshow">
                            <div class="tab-content">

                                <div id="gallery" class="tab-pane fade in active">
                                        <span class="label-wrap visible-sm visible-xs">
                                        <span class="label label-primary">For  {{ $singleproperty->purpose }}</span>
                                    </span>
                                    <div class="slideshow">
                                        <div class="slideshow-main">
                                            <div class="slide">
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image0)}}" width="810" height="430" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @if($singleproperty->image1 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image1)}}" width="810" height="430" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image2 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image2)}}" width="810" height="430" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image3 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image3)}}" width="810" height="430" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image4 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image4)}}" width="810" height="430" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="slideshow-nav-main">
                                            <div class="slideshow-nav">
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image0)}}" style="width: 116px !important; height: 80px; padding: 4px;"  alt="{{ $singleproperty->title }}">
                                                </div>
                                                @if($singleproperty->image1 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image1)}}" style="width: 116px !important; height: 80px; padding: 4px;" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image2 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image2)}}" style="width: 116px !important; height: 80px; padding: 4px;"  alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image3 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image3)}}" style="width: 116px !important; height: 80px; padding: 4px;"  alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                                @if($singleproperty->image4 != '')
                                                <div>
                                                    <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image4)}}" style="width: 116px !important; height: 80px; padding: 4px;" alt="{{ $singleproperty->title }}">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="map" class="tab-pane fade"></div>
                                <div id="street-map" class="tab-pane fade"></div>

                            </div>
                            <div class="media-tabs">
                                <ul class="media-tabs-list">
                                    <li class="popup-trigger" data-placement="bottom" data-toggle="tooltip" data-original-title="View Photos">
                                        <a href="#gallery" data-toggle="tab">
                                            <i class="fa fa-camera"></i>
                                        </a>
                                    </li>
                                    <li data-placement="bottom" data-toggle="tooltip" data-original-title="Map View">
                                        <a href="#map" data-toggle="tab">
                                            <i class="fa fa-map"></i>
                                        </a>
                                    </li>
                                    <li data-placement="bottom" data-toggle="tooltip" data-original-title="Street View">
                                        <a href="#street-map" data-toggle="tab">
                                            <i class="fa fa-street-view"></i>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="actions">
                                    <li class="share-btn">
                                        <div class="share_tooltip tooltip_left fade">
                                            <a href="/facebook/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                            <a href="/twitter/{{ $singleproperty->id }}" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                            <a href="/pinterest/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                            <a href="/gplus/{{ $singleproperty->id }}" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                        <span><i class="fa fa-share-alt"></i></span>
                                    </li>
                                    <li>
                                        <span><i class="fa fa-heart-o"></i></span>
                                    </li>
                                    <li class="lightbox-expand visible-xs compress">
                                        <span><i class="fa fa-envelope-o"></i></span>
                                    </li>
                                    <li class="lightbox-close">
                                        <span><i class="fa fa-close"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- SLIDER END  -->
                        <!--start detail content tabber-->
                        <div class="detail-content-tabber">
                            <!--start detail tabs-->
                            <ul class="detail-tabs">
                                <!--<li class="active">Contact Info</li>-->
                                <li class="active">Detail</li>
                                <li id="newmap">Map & Location</li>
                                <li>Features & Services</li>
                                <li>Maps & Payment Plans</li>
                                 @if(!empty($singleproperty->type =='projects'))
                                <li>Projects</li>
                                 @endif
                                @if(!empty($singleproperty->video_url)) <li>VIDEO</li> @endif
                            </ul><!--end detail tabs-->

                            <!--start tab-content-->
                            <div class="tab-content">
                                <div class="tab-pane fade in active">
                                    <div class="detail-list detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">{{ $singleproperty->title }}</h2>
                                            <div class="title-right">
                                                <p>{{ $singleproperty->updated_at  }}</p>
                                            </div>
                                        </div>
                                       
                                        <div class="alert alert-info">
                                          
                                            <ul class="list-two-col">
                                                <li><strong>ID:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">justdeal{{ $singleproperty->id }}</p></li>
                                               @if(!empty($singleproperty->purpose))
                                               <li><strong>Purpose:</strong> <p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->purpose }}</p></li>
                                                @endif
                                              @if(!empty($singleproperty->type))
                                              <li><strong>Type:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->type }}</p></li>
                                                @endif
                                               {{-- @if(!empty($singleproperty->subtype))--}}
                                               {{--  <li><strong>Sub Category:<p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;"></strong>{{ $singleproperty->subtype }}</p></li> --}}
                                               {{--@endif--}}
                                               @if($singleproperty->purpose == 'sell' && $singleproperty->price <> '')
                                                  <li><strong>Price:</strong>
                                                     <p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;"> Rs {{ $singleproperty->price }}</p>
                                                  </li>
                                                  @elseif( $singleproperty->price <> '')
                                                    <li><strong>Price:</strong>
                                                    <p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">    Rs {{ $singleproperty->price }}/month</p>
                                                   </li>
                                               @endif
                                               @if(empty($singleproperty->type == 'projects'))
                                                <li><strong>Size:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;"> {{ $singleproperty->area }} {{ $singleproperty->area_unit }}</p></li>
                                               @endif
                                                @if(!empty($singleproperty->height))
                                             {{--   <li><strong>Height:</strong><p style="tpadding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->height }}</p></li>--}}
                                                @endif
                                                @if(!empty($singleproperty->width))
                                              {{--  <li><strong>Width:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->width }}</p></li>--}}
                                                @endif
                                                @if(!empty($singleproperty->beds))
                                                <li><strong>Beds:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->beds }}</p></li>
                                                @endif

                                                @if(!empty($singleproperty->bathroom))
                                                <li><strong>Bathroom:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->bathroom }}</p></li>
                                                @endif

                                                @if(!empty($singleproperty->kitchens))
                                                <li><strong>Kitchens:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->kitchens }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->floor))
                                                <li><strong>Floor:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->floor }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->floor))
                                                <li><strong>Floor:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->floor }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->Label))
                                                {{--  <li><strong>Label:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->Label }}</p></li>--}}
                                                @endif
                                                @if(empty($singleproperty->type == 'projects'))
                                                @if(!empty($singleproperty->ConstructedArea))
                                                <li><strong>Constructed Area:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->ConstructedArea }}</p></li>
                                                @endif

                                                @if(!empty($singleproperty->OpenArea))
                                                <li><strong>Open Area:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->OpenArea }}</p></li>
                                                @endif
                                                @endif
                                                @if(!empty($singleproperty->ConstructionYear))
                                                <li><strong>Construction Year:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->ConstructionYear }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->OwnerShipStatus))
                                                <li><strong>OwnerShip Status:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->OwnerShipStatus }}</p></li>
                                                @endif


<!--                                                @if(!empty($singleproperty->title0))
                                                <li><strong>Title :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->title0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->property_type0))
                                                <li><strong>Property_type :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->property_type0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->price0))
                                                <li><strong>Price :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->price0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->beds0))
                                                <li><strong>Beds :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->beds0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->bath0))
                                                <li><strong>Bath :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->bath0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->property_size0))
                                                <li><strong>Property_size :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->property_size0 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->title1))
                                                <li><strong>Title 4:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->title1 }}</p></li>
                                                @endif
                                                @if(!empty($singleproperty->property_type1))
                                                <li><strong>Property_type 4 :</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;">{{ $singleproperty->property_type1 }}</p></li>
                                                @endif-->
                                                <li><strong>Expired Offer:</strong><p style="padding: 0 0 0 130px; margin-top: -29px; margin-bottom: 0px;"> {{ $singleproperty->created_at->diff(new DateTime())->format('%a Days Ago') }}</p></li>
                                            </ul>
                                           
                                        </div>
                                  <p><strong>Description:</strong> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $singleproperty->description }}</p>
                                    </div>
                                </div>

                                <div class="tab-pane fade">
                                    <div class="detail-address detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Map & Location</h2>
                                            <div class="title-right">
                                                <a href="http://maps.google.com/?q=<{{ $singleproperty->latitude }}>,<{{ $singleproperty->longitude }}>" target="_blank">Open on Google Maps <i class="fa fa-map-marker"></i></a>
                                            </div>
                                        </div>
                                        <ul class="list-three-col">
                                            <li><strong>City:</strong> {{ $singleproperty->city }}</li>
                                            <li><strong>Address:</strong>  {{ $singleproperty->address }} </li>
                                            <li><strong>Latitude:</strong>  {{ $singleproperty->latitude }} </li>
                                            <li><strong>longitude:</strong>  {{ $singleproperty->longitude }} </li>
                                        </ul>
                                    </div>
                                    <div id="pmap" style="height: 300px"></div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="detail-features detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Features</h2>
                                        </div>
                                        <ul class="list-three-col list-features">
                                            @foreach($propertyFeatures as $feature)
                                            <li><a href="#"><i class="fa fa-check"></i>{{ $feature->name  }}</a></li>
                                            @endforeach
                                        </ul>
                                        <hr>
                                        <div class="detail-title">
                                            <h2 class="title-left">Near By</h2>
                                        </div>
                                        <div class="accord-block">
                                            <div class="accord-tab">
                                                <ul class="list-three-col list-features">
                                                    @foreach($propertyServices as $service)
                                                    <li><a href="#"><i class="fa fa-check"></i>{{ $service->name  }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div>


                                            <div class="accord-content">
                                                <img src="images/floor-image.png" alt="img" width="400" height="436">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="tab-pane fade">
                                    <div class="property-plans detail-block">
                                        <div class="detail-title">Map & payment Plans</h2>
                                        </div>
                                        <div class="accord-block">
                                            <div class="accord-tab">
                                                <ul class="list-three-col list-features">
                                               @if($singleproperty->paymentPlansImage0 != '')
                                                  <li><a href="#">  <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage0)}}" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor img-rounded"width="750" height="388" alt="{{ $singleproperty->title }}"></a><a href="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage0)}}" download>Download</a></li>
                                                @endif
                                               @if($singleproperty->paymentPlansImage1 != '')
                                                  <li><a href="#">  <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage1)}}"style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor img-rounded" width="750" height="388" alt="{{ $singleproperty->title }}"></a><a href="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage1)}}" download>Download</a></li>
                                                @endif
                                               @if($singleproperty->paymentPlansImage2 != '')
                                                  <li><a href="#">  <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage2)}}"style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor img-rounded" width="750" height="388" alt="{{ $singleproperty->title }}"></a><a href="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage2)}}" download>Download</a></li>
                                                @endif
                                               @if($singleproperty->paymentPlansImage3 != '')
                                                  <li><a href="#">  <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage3)}}"style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor img-rounded" width="750" height="388" alt="{{ $singleproperty->title }}"></a><a href="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage3)}}" download>Download</a></li>
                                                @endif
                                               @if($singleproperty->paymentPlansImage4 != '')
                                                  <li><a href="#">  <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage4)}}"style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor img-rounded" width="750" height="388" alt="{{ $singleproperty->title }}"></a><a href="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage3)}}" download>Download</a></li>
                                                @endif
                                                   
                                                </ul>
                                            </div>
                                               

                                            <div class="accord-content">
                                                <img src="images/floor-image.png" alt="img" width="400" height="436">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade">
                                    <div class="property-plans detail-block">
                                        <div class="detail-title"><h2>Projects</h2>
                                        </div>
<!--                                        <div class="accord-block">-->
                                           <div class="alert alert-info">
                                                 @if(!empty($singleproperty->type == 'projects'))
                                             <div class="table-responsive">          
                                                    <table class="table">
                                                      <thead>
                                                        <tr>
                                                          <th>Title</th>
                                                          <th>Property Type</th>
                                                          <th>Price</th>
                                                          <th>Beds</th>
                                                          <th>Bath</th>
                                                          <th>Property Size</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>{{ $singleproperty->title0 }}</td>
                                                          <td>{{ $singleproperty->property_type0 }}</td>
                                                          <td>{{ $singleproperty->price0 }}</td>
                                                          <td>{{ $singleproperty->beds0 }}</td>
                                                          <td>{{ $singleproperty->bath0 }}</td>
                                                          <td>{{ $singleproperty->property_size0 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title1 }}</td>
                                                          <td>{{ $singleproperty->property_type1 }}</td>
                                                          <td>{{ $singleproperty->price1 }}</td>
                                                          <td>{{ $singleproperty->beds1 }}</td>
                                                          <td>{{ $singleproperty->bath1 }}</td>
                                                          <td>{{ $singleproperty->property_size1 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title2 }}</td>
                                                          <td>{{ $singleproperty->property_type2 }}</td>
                                                          <td>{{ $singleproperty->price2 }}</td>
                                                          <td>{{ $singleproperty->beds2 }}</td>
                                                          <td>{{ $singleproperty->bath2 }}</td>
                                                          <td>{{ $singleproperty->property_size2 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title3 }}</td>
                                                          <td>{{ $singleproperty->property_type3 }}</td>
                                                          <td>{{ $singleproperty->price3 }}</td>
                                                          <td>{{ $singleproperty->beds3 }}</td>
                                                          <td>{{ $singleproperty->bath3 }}</td>
                                                          <td>{{ $singleproperty->property_size3 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title4 }}</td>
                                                          <td>{{ $singleproperty->property_type4 }}</td>
                                                          <td>{{ $singleproperty->price3 }}</td>
                                                          <td>{{ $singleproperty->beds4 }}</td>
                                                          <td>{{ $singleproperty->bath4 }}</td>
                                                          <td>{{ $singleproperty->property_size4 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title5 }}</td>
                                                          <td>{{ $singleproperty->property_type5 }}</td>
                                                          <td>{{ $singleproperty->price5 }}</td>
                                                          <td>{{ $singleproperty->beds5 }}</td>
                                                          <td>{{ $singleproperty->bath5 }}</td>
                                                          <td>{{ $singleproperty->property_size5 }}</td>
                                                        </tr>
                                                        <tr>
                                                          <td>{{ $singleproperty->title6 }}</td>
                                                          <td>{{ $singleproperty->property_type6 }}</td>
                                                          <td>{{ $singleproperty->price6 }}</td>
                                                          <td>{{ $singleproperty->beds6 }}</td>
                                                          <td>{{ $singleproperty->bath6 }}</td>
                                                          <td>{{ $singleproperty->property_size6 }}</td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                             </div>
<!--                                             <hr>-->
                                            @endif
                                            </div>
                                        <!--</div>-->

                                    </div>
                                </div>
                                
                               
                                <div class="tab-pane fade">
                                    <div class="property-video detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Video</h2>
                                        </div>
                                        <div class="video-block">
                                            <a href="{{ $singleproperty->video_url }}" data-fancy="property_video" title="YouTube demo">
                                                <span class="play-icon"><img src="{{ asset('assets/images/icons/video-play-icon.png')}}" alt="YouTube Property Jeastdeal.pk" width="70" height="50"></span>
                                                <img src="{{ asset('propetyImages/'.$singleproperty->id.'/750x388'.$singleproperty->image0)}}" alt="thumb" class="video-thumb">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="tab-pane fade">
                                <div class="tab-pane fade in active">
                                    <div class="property-description detail-block">
                                        <div class="detail-title">
                                            <h2 class="title-left">Description</h2>
                                            <div class="title-right">
                                                {{ $Agent->company_name }}
                                            </div>
                                        </div>
                                        <p> <b>Company Name             : {{ $Agent->company_name }} </b></p>
                                        <p> <b>Companyy Address         : {{ $Agent->address }} </b></p>
                                        <p> <b>Company Phone            : {{ $Agent->company_phone }} </b></p>
                                        <p> <b>Company Office Phone     : {{ $Agent->work_phone }} </b></p>
                                        <p> <b>Company Email            : {{ $Agent->email2 }} </b></p>
                                        <p> <b>Company Description      : {{ $Agent->description }} </b></p>
                                        <p> <b>Company CEO              :  <CEO> {{ $Agent->ceo_name }}</CEO> </b></p>
                                        <p> <b>CEO Message              : {{ $Agent->ceo_description }} </b></p>
                                        @if(!empty($Agent->DisplayName))
                                        <p> <b>Website                  :<a href="//{{ $Agent->DisplayName  }}.justdeal.pk/"> {{ $Agent->DisplayName }}.justdeal.pk/</a></b></p>
                                        @endif
                                        <p>
                                        <ul class="profile-social">
                                            <li><a class="btn-facebook" href="{{ $Agent->facebook }}" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                            <li><a class="btn-twitter" href="{{ $Agent->twitter }}" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                            <li><a class="btn-linkedin" href="{{ $Agent->linkedin }}" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                            <li><a class="btn-google-plus" href="{{ $Agent->googleplus	 }}" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                        </ul>
                                        </p>
                                    </div>
                                </div>-->
                            </div>
                            <!--end tab-content-->
                        </div>
                        <!--end detail content tabber-->

<!--                        <div class="detail-contact detail-block">
                            <div class="detail-title">
                                <h2 class="title-left">Contact info</h2>
                                @if(!empty($Agent->DisplayName))
                                <div class="title-right"><strong><a href="//{{ $Agent->DisplayName  }}.justdeal.pk/">View my listing</a></strong></div>
                                @endif
                            </div>
                            <div class="media agent-media">
                                <div class="media-left">
                                    @if(!empty($Agent->DisplayName))
                                    <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/">
                                        <img src="{{ asset('ProfileImage/74x74_'.$Agent->image)  }}" class="media-object" alt="image" width="74" height="74">
                                    </a>
                                    @else
                                    <a href="">
                                        <img src="{{ asset('ProfileImage/74x74_'.$Agent->image)  }}" class="media-object" alt="image" width="74" height="74">
                                    </a>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">CONTACT AGENT</h4>
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{ $Agent->first_name.' '.$Agent->last_name }}</li>
                                        <li>
                                            <span><i class="fa fa-phone"></i> {{ $Agent->cell_phone }}</span>
                                            <span><a href="#"><i class="fa fa-skype"></i>  kenneth.phllips</a></span>
                                        </li>
                                        <li>
                                            <span><a href="#"><i class="fa fa-facebook-square"></i> Facebook</a></span>
                                            <span><a href="#"><i class="fa fa-twitter-square"></i>  Twitter</a></span>
                                            <span><a href="#"><i class="fa fa-linkedin-square"></i>  Linkedin</a></span>
                                            <span><a href="#"><i class="fa fa-instagram"></i>  Linkedin</a></span>
                                            <span><a href="#"><i class="fa fa-pinterest-square"></i>  Linkedin</a></span>
                                            <span><a href="#"><i class="fa fa-globe"></i>  Linkedin</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="detail-title-inner">
                                <h4 class="title-inner">Inquire about this propertys</h4>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Your Name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Phone" type="text">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Email" type="email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" placeholder="Location"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary">Request info</button>
                            </form>
                        </div>-->

                    </div>
                </div>
                
                <!--start sidebar section-->
                <!--@include('layouts.leftsidebar')-->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
    <aside id="sidebar" class="sidebar-white">
         <div class="widget widget-range">
            <div class="widget-body">
         <div class="agent-area">
                    <div class="form-small">
                        <div class="agent-media-head">
                             @if(!empty($Agent->company_name))
                             <h4 class="head-left" style="font-size:20px;">{{$Agent->company_name}}</h4>
                            @else
                              <h4 class="head-left"style="font-size:20px;">Agent</h4>
                              @endif
<!--                            @if(!empty($Agent->DisplayName))
                            <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/" class="head-right">View my listing</a>
                            @endif-->
                        </div>
                        <div class="media agent-media">
                            <div class="media-left">
                                @if(!empty($Agent->DisplayName))
                                <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/">
                                    <img width="100" height="100" alt="image" class="media-object" src="{{ asset('public/ProfileImage/90x90_'.$Agent->company_logo)  }}">
                                </a>
                                @else
                                <a href="">
                                <img width="100" height="100" alt="image" class="media-object" src="{{ asset('public/ProfileImage/90x90_'.$Agent->image)  }}">
                                </a>
                                @endif
                            </div>
                            <div class="media-body">
                                <dl>
                                    <!--<dt style="font-size: 13px;">{{$Agent->company_name}}</dt>-->
                                    @if( $Agent->BusinessType == '1') 
                                    <dd style="font-size: 15px;"><i class="fa fa-user"></i><b> {{ $Agent->first_name.' '.$Agent->last_name }}</b></dd>
                                    <dd style="font-size: 15px;"><i class="fa fa-phone"></i><b> {{ $Agent->cell_phone }}</b></dd>
                                   @endif
                                    @foreach($Agentdata as $Agentda)
                                    <dd style="font-size: 15px;"><i class="fa fa-user"></i><b> {{ $Agentda->name }}</b></dd>
                                    <dd style="font-size: 15px;"><i class="fa fa-phone"></i><b> {{ $Agentda->number }}</b></dd>
                                    @endforeach
                                     @if( $Agent->BusinessType == '2') 
                                     @if(!empty($Agent->company_phone))
                                     <dd style="font-size: 15px;"><i class="fa fa-fax"></i><b> {{ $Agent->company_phone }}</b></dd>
                                    @endif
                                     @if(!empty($Agent->company_mobileNo))
                                    <dd style="font-size: 15px;"><i class="fa fa-phone"></i><b> {{ $Agent->company_mobileNo }}</b></dd>
                                    @endif
                                    @if(!empty($Agent->fax_phone))
                                    <dd style="font-size: 15px;"><i class="fa fa-fax"></i><b> {{ $Agent->fax_phone }}</b></dd>
                                    @endif
                                    @endif
                                </dl>

                                <ul class="profile-social">
                                    <li><a class="btn-facebook" href="{{ $Agent->facebook }}" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                    <li><a class="btn-twitter" href="{{ $Agent->twitter }}" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a class="btn-linkedin" href="{{ $Agent->linkedin }}" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                    <li><a class="btn-google-plus" href="{{ $Agent->googleplus }}" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <h4 class="form-small-title"> @if(!empty($Agent->DisplayName))
                                <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/" title="Veiw Listing"class="head-right" style="font-size: 13px;">{{$Agent->DisplayName}}.justdeal.pk</a>
                                @endif
                        </h4>
                        <h4 style="font-size: 15px;"><b> Inquire about this property</b></h4>
                        <br>
                        <form method="POST" action="{{URL::action('ContactuspropertyinfoController@store', [ 'title'=>$singleproperty ,'id' => $singleproperty ])}}">
                            {{ csrf_field() }}
                            <div class="row">
                            <div class=" form-group">
                                <input type="text" placeholder="Your Name" name="name" class="form-control" required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group">
                                <input type="text" placeholder="Phone" name="phone" class="form-control" required>
                            </div>
                                </div>
                            <div class="row">
                            <div class="form-group">
                                <input type="email" placeholder="Email" name="email" class="form-control" required>
                            </div>
                                </div>
                            <div class="row">
                            <div class="form-group">
                                <textarea placeholder="Location" rows="2" name="message" class="form-control" required></textarea>
                            </div>
                            </div>
                            <button class="btn btn-secondary btn-block">Request info</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        {{--<div class="widget widget-range">--}}
            {{--<div class="widget-body">--}}
                {{--<form action="{{ url('Search-Result') }}" method="post">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="range-block rang-form-block">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input type="text" class="form-control" name="keyword" id="keywordsidebar" placeholder="Search" >--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<select name="city" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Property City">--}}
                                        {{--<option selected value="All">All Cities</option>--}}
                                        {{--@foreach($cities as $city)--}}
                                            {{--<option value="{{ $city->name }}">{{ $city->name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<select name="type" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Property Type">--}}
                                        {{--<option selected value="All">All Type</option>--}}
                                        {{--<option value="projects"> Projects</option>--}}
                                        {{--<option value="house"> Residential / Homes</option>--}}
                                        {{--<option value="land"> Commercial / Land</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-12 col-xs-12">--}}
                                {{--<div class="form-group">--}}
                                    {{--<select name="agency" class="selectpicker" data-live-search="false" data-live-search-style="begins" title="Agency">--}}
                                        {{--<option selected value="All">All Agency</option>--}}
                                        {{--@foreach($Agents as $agent)--}}
                                            {{--<option value="{{ $agent->id }}"> {{ $agent->first_name.' '.$agent->last_name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-12 col-xs-12">--}}
                                {{--<button type="submit" class="btn btn-secondary btn-block"> Search</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="widget widget-rated">
            <div class="widget-body">
                @foreach($Adds as $add)
                    <?php $image = '370x202_'.$add->image; ?>
                    <div class="item">
                        <div class="figure-block">
                            <figure class="item-thumb">
                                <a href="{{ $add->webSite_url }}" class="hover-effect" target="_blank">
                                    <img src="{{ asset('public/AddsImages/'.$image)  }}" alt="{{ $add->webSite_url }}">
                                </a>
                            </figure>
                            <br>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="widget widget-slider">
            <div class="widget-top">
                <h3 class="widget-title">Featured Properties Slider</h3>
            </div>
            <div class="widget-body">
                <div class="property-widget-slider">

                    @foreach($AllProperty->slice(0, 5) as $property)
                        <?php $image = $property->id.'/370x202'.$property->image0; ?>

                        <div class="item">
                            <div class="figure-block">
                                <figure class="item-thumb"> 
                                    @if(!empty($property->featured_category== '1'))
                                    <span class="label-featured label label-primary" style="background-color: #005fcc;">Premium Ad</span>
                                    @elseif(!empty($property->featured_category== '2'))
                                    <span class="label-featured label label-success">Featured</span>
                                    @elseif(!empty($property->featured_category== '3'))
                                    <span class="label-featured label label-success">Featured</span>
                                    @elseif(!empty($property->featured_category== '4'))
                                    <span class="label-featured label label-success">Featured</span>
                                    @else
                                    @endif
                                    <div class="label-wrap label-right">
                                        <span class="label-status label label-default">For {{ $property->purpose }}</span>
                                    @if(!empty($property->featured_category== '1'))
                                        <span class="label label-danger">Hot Offer</span>
                                     @endif
                                    </div>
                                    <a href="#" class="hover-effect">
                                        <img src="{{ asset('public/propetyImages/'.$image)  }}" alt="{{ $property->title }}">
                                    </a>
                                    <div class="price">
                                        <span class="item-price">Rs {{ $property->price }}</span>
                                    </div>
                                    <ul class="actions">
                                        <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart-o"></i>
                                                    </span>
                                        </li>
                                        <li class="share-btn">
                                            <div class="share_tooltip fade">
                                                <a href="/facebook/{{ $property->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                                <a href="/twitter/{{ $property->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                                <a href="/gplus/{{ $property->id }}"  target="_blank"><i class="fa fa-google-plus"></i></a>
                                                <a href="/pinterest/{{ $property->id }}" target="_blank"><i class="fa fa-pinterest"></i></a>
                                            </div>
                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share">
                                                            <i class="fa fa-share-alt"></i>
                                                        </span>
                                        </li>
                                    </ul>
                                </figure>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="widget widget-recommend">
            <div class="widget-top">
                <h3 class="widget-title">We recommend</h3>
            </div>
            <div class="widget-body">
                @foreach($AllProperty->slice(0,3) as $property)
                    <div class="media">
                        <div class="media-left">
                            <figure class="item-thumb">
                                <a class="hover-effect" href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\s+/', '-', $property->title)  }}">
                                    <img  alt="{{ $property->title }}" src="{{ asset('public/propetyImages/'.$property->id.'/100x75'.$property->image0)}}" width="100" height="75">
                                </a>
                            </figure>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\s+/', '-', $property->title)  }}">{{ $property->title }}</a></h3>
                            <div class="rating">
                                <span class="star-text-left">Rs {{ $property->price }}</span>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
        <div class="widget widget-rated">
            <div class="widget-top">
                <h3 class="widget-title">Most Rated Properties</h3>
            </div>
            <div class="widget-body">
                @foreach($AllProperty->slice(0,3) as $property)
                    <div class="media">
                        <div class="media-left">
                            <figure class="item-thumb">
                                <a class="hover-effect" href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\s+/', '-', $property->title)  }}">
                                    <img  alt="{{ $property->title }}" src="{{ asset('public/propetyImages/'.$property->id.'/100x75'.$property->image0)}}" width="100" height="75">
                                </a>
                            </figure>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\s+/', '-', $property->title)  }}">{{ $property->title }}</a></h3>
                            <div class="rating">
                                <span class="star-text-left">Rs {{ $property->price }}</span>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </aside>
</div>

                <!--end sidebar section-->
            </div>
        </div>
    </section>
    <!--end detail content-->

</section>
<!--end section page body-->

<div id="lightbox-popup-main" class="fade">
    <div class="lightbox-popup">
        <div class="popup-inner">
            <div class="lightbox-left">
                <div class="lightbox-header">
                    <div class="header-title">
                        <p>
                                <span>
                                    <img src="{{ asset('ProfileImage/74x74_'.$Agent->image)  }}" width="86" height="13" alt="logo">
                                </span>
                            <span class="hidden-xs">
                                    {{ $singleproperty->title }}
                                </span>
                        </p>
                    </div>
                    <div class="header-actions">
                        <ul class="actions">
                            <li class="share-btn">
                                <div class="share_tooltip tooltip_left fade">
                                    <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-facebook"></i></a>
                                    <a href="#" onclick="if(!document.getElementById('td_social_networks_buttons')){window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;}"><i class="fa fa-twitter"></i></a>

                                    <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-pinterest"></i></a>

                                    <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-linkedin"></i></a>

                                    <a href="#" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                                <span><i class="fa fa-share-alt"></i></span>
                            </li>
                            <li>
                                <span><i class="fa fa-heart-o"></i></span>
                            </li>
                            <li class="lightbox-expand visible-xs compress">
                                <span><i class="fa fa-envelope-o"></i></span>
                            </li>
                            <li class="lightbox-close">
                                <span><i class="fa fa-close"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="gallery-area">
                    <div class="slider-placeholder">
                        <div class="loader-inner">
                            <span class="fa fa-spin fa-spinner"></span> Loading Slider...
                        </div>
                    </div>
                    <div class="expand-icon lightbox-expand hidden-xs"></div>
                    <div class="gallery-inner">
                        <div class="lightbox-slide slide-animated">
                            <div>
                                <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/1170x600'.$singleproperty->image0)}}" alt="Lightbox Slider" width="1044" height="525">
                            </div>
                            @if($singleproperty->image1 != '')
                            <div>
                                <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/1170x600'.$singleproperty->image1)}}" alt="Lightbox Slider" width="1044" height="525">
                            </div>
                            @endif
                            @if($singleproperty->image2 != '')
                            <div>
                                <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/1170x600'.$singleproperty->image2)}}" alt="Lightbox Slider" width="1044" height="525">
                            </div>
                            @endif
                            @if($singleproperty->image3 != '')
                            <div>
                                <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/1170x600'.$singleproperty->image3)}}" alt="Lightbox Slider" width="1044" height="525">
                            </div>
                            @endif
                            @if($singleproperty->image4 != '')
                            <div>
                                <img src="{{ asset('public/propetyImages/'.$singleproperty->id.'/1170x600'.$singleproperty->image4)}}" alt="Lightbox Slider" width="1044" height="525">
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="lightbox-slide-nav visible-xs">
                        <button class="lightbox-arrow-left lightbox-arrow"><i class="fa fa-angle-left"></i></button>
                        <p class="lightbox-nav-title">Luxury apartment bay view</p>
                        <button class="lightbox-arrow-right lightbox-arrow"><i class="fa fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="lightbox-right fade in">
                <div class="lightbox-header hidden-xs">
                    <div class="header-title">
                        <p>@if($singleproperty->purpose == 'sell'):
                            Rs: {{ $singleproperty->price }}
                            @else
                            Rs: {{ $singleproperty->price }}/mo
                            @endif</p>
                    </div>
                    <div class="header-actions">
                        <ul class="actions">
                            <li class="lightbox-close">
                                <span><i class="fa fa-close"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="agent-area">
                    <div class="form-small">
                        <div class="agent-media-head">
                            <h4 class="head-left">Contact info</h4>
                            @if(!empty($Agent->DisplayName))
                            <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/" class="head-right">View my listing</a>
                            @endif
                        </div>
                        <div class="media agent-media">
                            <div class="media-left">
                                @if(!empty($Agent->DisplayName))
                                <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/">
                                    <img width="100" height="100" alt="image" class="media-object" src="{{ asset('ProfileImage/90x90_'.$Agent->image)  }}">
                                </a>
                                @else
                                <a href="">
                                <img width="100" height="100" alt="image" class="media-object" src="{{ asset('ProfileImage/90x90_'.$Agent->image)  }}">
                                </a>
                                @endif
                            </div>
                            <div class="media-body">
                                <dl>
                                    <dt>CONTACT AGENT</dt>
                                    <dd><i class="fa fa-user"></i> {{ $Agent->first_name.' '.$Agent->last_name }}</dd>
                                    <dd><i class="fa fa-phone"></i> {{ $Agent->cell_phone }}</dd>
                                </dl>

                                <ul class="profile-social">
                                    <li><a class="btn-facebook" href="#" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                    <li><a class="btn-twitter" href="#" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a class="btn-linkedin" href="#" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                    <li><a class="btn-google-plus" href="#" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <h4 class="form-small-title"> Inquire about this property </h4>
                        <form>
                            <div class="form-group">
                                <input type="text" placeholder="Your Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Location" rows="2" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-secondary btn-block">Request info</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 5</div>
      <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage0)}}" style="width:1200px; height: 400px">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 5</div>
      <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage1)}}" style="width:1200px; height: 400px">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 5</div>
      <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage2)}}" style="width:1200px; height: 400px">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 5</div>
      <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage3)}}" style="width:1200px; height: 400px">
    </div>
    <div class="mySlides">
      <div class="numbertext">5 / 5</div>
      <img src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/750x388'.$singleproperty->paymentPlansImage4)}}" style="width:1200px; height: 400px">
    </div>
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


    <div class="column">
      <img class="demo cursor" src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/194x143'.$singleproperty->paymentPlansImage0)}}"  onclick="currentSlide(1)">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/194x143'.$singleproperty->paymentPlansImage1)}}" onclick="currentSlide(2)">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/194x143'.$singleproperty->paymentPlansImage2)}}" onclick="currentSlide(3)">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/194x143'.$singleproperty->paymentPlansImage3)}}"  onclick="currentSlide(4)">
    </div>
    <div class="column">
      <img class="demo cursor" src="{{ asset('public/propertypaymentPlansImage/'.$singleproperty->id.'/194x143'.$singleproperty->paymentPlansImage4)}}"  onclick="currentSlide(4)">
    </div>
  </div>
</div>
@endsection
@section('pagejs')


<script type="text/javascript">
    var map = null;
    var panorama = null;
    var fenway = new google.maps.LatLng( {{ $singleproperty->latitude }} ,{{ $singleproperty->longitude }}  );
    var mapOptions = {
        center: {lat: {{ $singleproperty->latitude }}, lng: {{ $singleproperty->longitude }}},
    zoom: 12
    };
    var panoramaOptions = {
        position: {lat: {{ $singleproperty->latitude }}, lng: {{ $singleproperty->longitude }}},
    pov: {
        heading: 34,
            pitch: 10
    }
    };
    var tabsHeight = function() {
        //jQuery(".detail-media .tab-content").css('min-height',jQuery("#gallery").innerHeight());
        jQuery("#map,#street-map").css('min-height',jQuery(".detail-media #gallery").innerHeight());
    };
    jQuery(window).on('load',function(){
        tabsHeight();
        initialize();
    });
    jQuery(window).on('resize',function(){
        tabsHeight();
        initialize();
    });
    pmap = new google.maps.Map(document.getElementById('pmap'), mapOptions);
    function initialize() {

        newmap = new google.maps.Map(document.getElementById('pmap'), mapOptions);
        var marker = new google.maps.Marker({
                position: fenway,
                map: newmap,
                title: '{{ $singleproperty->title }}'
            });
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var marker = new google.maps.Marker({
                position: fenway,
                map: map,
                title: '{{ $singleproperty->title }}'
            });
        panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
        map.setStreetView(panorama);
        var marker = new google.maps.Marker({
                position: fenway,
                map: panorama,
                title: '{{ $singleproperty->title }}'
            });
    }
    $('#newmap').click(function(e) {
        initialize();
        resetMap(pmap);
    });

    $('a[href="#map"]').on('shown.bs.tab', function (e) {
        var center = panorama.getPosition();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
    });
    $('a[href="#street-map"]').on('shown.bs.tab', function (e) {
        fenway = panorama.getPosition();
        panoramaOptions.position = fenway;
        panorama = new google.maps.StreetViewPanorama(document.getElementById('street-map'), panoramaOptions);
        map.setStreetView(panorama);
    });
    google.maps.event.addDomListener(window, 'load', initialize);


</script>
<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
@endsection