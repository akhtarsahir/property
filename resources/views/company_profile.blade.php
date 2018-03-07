@extends('layouts.app')
<!--page level css -->
@section('pagecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


    .a-image {
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }


    .col-sm-2:hover .a-image {
        opacity: 0.7;
    }
    .abc .thumb-caption .cap-price, blockquote .thumb-caption .cap-price, .col-sm-2 blockquote .thumb-caption .cap-price{
        font-size: 16px;
        line-height: 16px;
        margin-top: -20px;
        margin-left: 3px;
        font-weight: 500;
        text-transform: uppercase;
        text-align: inherit;
    }
    .abc .thumb-caption .cap-price, blockquote .thumb-caption .cap-price, .col-sm-2 blockquote .thumb-caption .cap-price {
        color: #fff;
    }
</style>
<style>
    .company-detail{ height: 300px;}
</style>

@endsection
<!--end of page level css-->
@section('content')

<!--start advanced search section-->
@include('layouts.header')
<!--end advanced search section -->

<!--start banner module-->
<div class="header-media">
    <div id="banner-module" class="houzez-module banner-module">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div id="banner-slider" class="owl-carousel owl-theme banner-slider">
                        @foreach($Companyslider as $slider)
                        <div class="item" style="height:400px">
                            <div class="caption" style="width: 300px; margin-top:157px;margin-left:609px;">
                                <a href="{{$slider->image_link }}" target="_blank" class="btn btn-primary btn-detail">Details <i class="fa fa-angle-right"></i></a>
                                <div class="item-body">
                                    <div class="body-left">
                                        <div class="info-row">
                                            <h2 class="property-title"><a href="#">{!! str_limit("$slider->image_title", 35) !!}</a></h2>
                                            <h4 class="property-location"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('public/CompanySliderImage/1170x400_'.$slider->slider_image)}}" alt="Banner Image">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end banner module-->
<!--start section page body-->
<section id="section-body">
    <div class="container">
        <div class="row" >
            <div class="col-sm-12">
                <!-- <div class="profile-detail-block company-detail" style="-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; background-image:url('<?php echo url('public/CompanyImage') ?>/{{$Agent->background_image}}');background-repeat: no-repeat; ">
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="content-area">
                    <div class="profile-tab-area">
                        <ul class="profile-tabs">
                            <li class="active">About</li>
                            <li>Projects</li>
                            <li>For Sale</li>
                            <li>For Rent</li>
                            <li>Agents</li>
                            <li>Contact</li>
                        </ul>
                        <div class="tab-content">
                            <div class="profile-tab-pane tab-pane fade active in">
                                <div class="profile-tab-content profile-overview" style="display:inline-block; width: 100%">
                                    <div class="col-sm-12">
                                        <div class="col-sm-9">
                                            <div class="profile-description">
                                                <h3>ABOUT</h3>
                                                <h4 class="position">{{ $Agent->company_name }}</h4>
                                                <p> {!! $Agent->company_about !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            @if($Agent->ceo_name <> '0') <h1>{{ $Agent->ceo_name }}</h1> @endif
                                            <p>
                                                @if(!empty($Agent->ceo_image))
                                                <img src="<?php echo url('public/ProfileImage') ?>/{{ $Agent->ceo_image }}">
                                                @endif
                                                {{ $Agent->ceo_description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--start Premium carousel module -->
                                <div id="carousel-module-4" class="houzez-module caption-above carousel-module"style="padding-top:30px; padding-bottom: 0px;padding-left: 0px;padding-right: 0px;">
                                    <div class="container">
                                        <div class="row">
                                            <h2 style="margin-left: 16px;margin-top: -23px !important">Premium Properties</h2>
                                            <div class="col-sm-12">
                                                <div id="properties-carousel-4" class="carousel slide-animated">
                                                    @foreach($premimum as $property)

                                                    <?php $image = '355x240' . $property->image0; ?>
                                                    <div class="item">
                                                        <div class="figure-block">
                                                            <figure class="item-thumb">
                                                                <div class="label-wrap label-left">
                                                                    @if(!empty($property->featured_category== '1'))
                                                                    <span class="label label-primary">Premium Ad</span>
                                                                    @endif
                                                                    @if(!empty($property->purpose != ''))
                                                                    <span class="label-status label label-default">For {{$property->purpose}}</span>
                                                                    @endif
                                                                </div>
                                                                <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="hover-effect">
                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}"  width="291" height="217">
                                                                </a>
                                                                <ul class="actions">
                                                                    <li>
                                                                        <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="Favorite">
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
                                                                        <span title="" data-placement="bottom" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                                    </li>
                                                                </ul>
                                                                <div class="thumb-caption">
                                                                    <!--<div class="cap-price pull-left">$350,000</div>-->
                                                                    @if($property->purpose == 'sell' && $property->price <> '')
                                                                    <div class="cap-price pull-left">Rs:{{ $property->price }}</div>
                                                                    @elseif( $property->price <> '')
                                                                    <div class="cap-price pull-left">Rs:{{ $property->price }}/month</div>
                                                                    @endif    
                                                                    @if($property->type == 'projects')
                                                                    @if(!empty($property->type == 'projects'))<div class="cap-price pull-left"> {{ $property->type }} </div>@endif
                                                                    @endif
                                                                </div>
                                                                <div class="detail-above detail">
                                                                    <div class="fig-title clearfix">
                                                                        <h3 class="pull-left"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{{ $property->title }}</a></h3>
                                                                    </div>

                                                                    <ul class="list-inline">
                                                                        @if($property->purpose == 'sell' && $property->price <> '')
                                                                        <li class="cap-price">Rs:{{ $property->price }}</li>
                                                                        @elseif( $property->price <> '')
                                                                        <li class="cap-price">Rs:{{ $property->price }}/month</li>
                                                                        @endif 
                                                                        @if($property->type == 'projects')
                                                                        @if(!empty($property->type == 'projects'))<div class="cap-price pull-left"> {{ $property->type }} </div>@endif
                                                                        @endif
                                                                        <!--<li class="cap-price">$350,000</li>-->
                                                                        <li>  @if(!empty($property->beds))<i class="fa fa-bed" aria-hidden="true"></i> {{$property->beds}}@endif
                                                                            @if(!empty($property->bathroom))<i class="fa fa-bath" aria-hidden="true"></i> {{$property->bathroom}}@endif
                                                                            @if(!empty($property->area))<i class="fa fa-area-chart" aria-hidden="true"></i> {{ $property->area }} {{ $property->area_unit }}@endif</li>
                                                                    </ul>
                                                                </div>
                                                            </figure>
                                                            <div class="detail-bottom detail">
                                                                <h3><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{{ $property->title }}</a></h3>
                                                                <ul class="list-inline">
                                                                    <li>  @if(!empty($property->beds))<i class="fa fa-bed" aria-hidden="true"></i> {{$property->beds}}@endif
                                                                        @if(!empty($property->bathroom))<i class="fa fa-bath" aria-hidden="true"></i> {{$property->bathroom}}@endif
                                                                        @if(!empty($property->area))<i class="fa fa-area-chart" aria-hidden="true"></i> {{ $property->area }} {{ $property->area_unit }}@endif</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end carousel module-->
                                <div class="houzez-module-main">
                                    <div class="houzez-module carousel-module" style="padding:0px;">
                                        <div class="container">
                                            <section> 
                                                <h2>Featured Properties</h2>
                                                <div class="col-md-12 col-sm-12"style="padding:0px !important">
                                                    @foreach($Saleproperties as $property)
                                                    <?php $image = '385x258' . $property->image0; ?>

                                                    <div class="col-md-2 col-sm-2" >
                                                        <blockquote style="margin: 0px -21px 20px -14px; padding: 0px !important; border-left: 5px solid #f6f6f6" class="abc">
                                                            <div class="label-wrap label-left">
                                                                @if(!empty($property->number== '1'))
                                                                <span class="label label-success">Featured</span>
                                                                @endif
                                                                @if(!empty($property->purpose != ''))
                                                                <span class="label-status label label-default">For {{$property->purpose}}</span>
                                                                @endif
                                                            </div>
                                                            <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}"class="a-image" >
                                                                <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}" width="385" height="258" >
                                                            </a>
                                                            <div class="thumb-caption">
                                                                @if($property->purpose == 'sell' && $property->price <> '')
                                                                <div class="cap-price p">Rs {{ $property->price }}</div>
                                                                @elseif( $property->price <> '')
                                                                <div class="cap-price p">Rs {{ $property->price }}/month</div>
                                                                @endif
                                                                @if($property->type == 'projects')
                                                                @if(!empty($property->type == 'projects'))<div class="cap-price p"> {{ $property->type }} </div>@endif
                                                                @endif
                                                            </div>
                                                            <p style="line-height: 24px;margin: 0px -29px 20px -14px; padding: 0px !important;font-size: 14px;font-weight: 500 !important;">
                                                                <a style=" color: #004274 !important;"href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" title="{{$property->title}} "data-toggle="tooltip" data-placement="bottom" >{!! str_limit("$property->title", 24) !!} </a>
                                                            </p>
                                                            <p style="line-height: 24px;margin: 0px -29px 20px -14px; padding: 0px !important;font-size: 14px;font-weight: 500 !important;">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->city }}
                                                                @if(!empty($property->area))<i class="fa fa-area-chart" aria-hidden="true" style="margin-left: 10px"></i> {{ $property->area }} {{ $property->area_unit }} @endif
                                                            </p>
                                                        </blockquote> 
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </section>

                                        </div>
                                    </div>
                                </div>
                                <div class="houzez-module-main">
                                    <div class="houzez-module carousel-module" style="padding:0px;">
                                        <div class="container">
                                            <section>
                                                <!--<div class="page-header">-->
                                                <h2>Latest Properties</h2>
                                                <!--</div>--> 
                                                <div class="col-md-12 col-sm-12"style="padding:0px !important">
                                                    @foreach($leatest_Saleproperties as $property)
                                                    <?php $image = '385x258' . $property->image0; ?>

                                                    <div class="col-md-2 col-sm-2" >
                                                        <blockquote style="margin: 0px -14px 20px -21px; padding: 0px !important;border-left: 5px solid #f6f6f6">
                                                            <div class="label-wrap label-left">
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
                                                                @if(!empty($property->purpose != ''))
                                                                <span class="label-status label label-default">For {{$property->purpose}}</span>
                                                                @endif
                                                            </div>
                                                            <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}"class="a-image" >
                                                                <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}" width="385" height="258" >
                                                            </a>
                                                            <div class="thumb-caption">
                                                                @if($property->purpose == 'sell' && $property->price <> '')
                                                                <div class="cap-price p">Rs {{ $property->price }}</div>
                                                                @elseif( $property->price <> '')
                                                                <div class="cap-price p">Rs {{ $property->price }}/month</div>
                                                                @endif
                                                                @if($property->type == 'projects')
                                                                @if(!empty($property->type == 'projects'))<div class="cap-price p"> {{ $property->type }} </div>@endif
                                                                @endif
                                                            </div>
                                                            <p style="line-height: 24px;margin: 0px -29px 20px -14px; padding: 0px !important;font-size: 14px;font-weight: 500 !important;">
                                                                <a style=" color: #004274 !important;" href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" title="{{$property->title}} "data-toggle="tooltip" data-placement="bottom" >{!! str_limit("$property->title", 24) !!} </a>
                                                            </p>
                                                            <p style="line-height: 24px;margin: 0px -29px 20px -14px; padding: 0px !important;font-size: 14px;font-weight: 500 !important;">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $property->city }}
                                                                @if(!empty($property->area))<i class="fa fa-area-chart" aria-hidden="true" style="margin-left: 10px"></i> {{ $property->area }} {{ $property->area_unit }} @endif
                                                            </p>
                                                        </blockquote> 
                                                    </div>
                                                    @endforeach
                                                </div><!-- end row -->
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-tab-pane tab-pane fade">
                                <div class="profile-tab-content profile-properties">
                                    <div class="property-filter-wrap">
                                        <h4 class="filter-title"> Projects Properties </h4>

                                    </div>
                                    <!--start property items-->
                                    <div class="property-listing grid-view grid-view-3-col">
                                        <div class="row">
                                            @foreach($projects as $property)
                                            <?php $image = '385x258' . $property->image0; ?>
                                            <div class="item-wrap">
                                                <div class="property-item table-list">
                                                    <div class="table-cell">
                                                        <div class="figure-block">
                                                            <figure class="item-thumb">
                                                                <span class="label-featured label label-success">Featured</span>
                                                                <div class="label-wrap label-right hide-on-list">
                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                </div>
                                                                <div class="price hide-on-list">
                                                                    @if($property->purpose == 'sell' && $property->type != 'projects'):
                                                                    <h3>Rs {{ $property->price }}</h3>
                                                                    @elseif($property->purpose == 'sell' && $property->type != 'projects' ):
                                                                    <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                    @endif
                                                                </div>
                                                                <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                </a>
                                                                <ul class="actions">
                                                                    <li>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </li>
                                                                    <li class="share-btn">
                                                                        <div class="share_tooltip fade">
                                                                            <a href="/facebook/{{ $property->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                            <a href="/twitter/{{ $property->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                            <a href="/gplus/{{ $property->id }}"  target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                            <a href="/pinterest/{{ $property->id }}" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                                        </div>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                            <i class="fa fa-camera"></i>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="item-body table-cell">

                                                        <div class="body-left table-cell">
                                                            <div class="info-row">
                                                                <div class="label-wrap hide-on-grid">
                                                                    <div class="label-status label label-default">For {{ $property->purpose }}</div>
                                                                </div>
                                                                <h2 class="property-title"><a href="#">{{ $property->title }}</a></h2>
                                                            </div>
                                                            <div class="info-row amenities hide-on-grid">
                                                                <p>
                                                                <p>
                                                                    {{--<span>Beds: {{ $property->beds }}</span>--}}
                                                                    {{--<span>Baths: {{ $property->bathroom }}</span>--}}
                                                                    <span>{{ $property->area_unit }}: {{ $property->area }}</span>
                                                                </p>

                                                                <span>{{ $property->subtype }}</span>
                                                                </p>
                                                                <p>{{ $property->title }}</p>
                                                            </div>
                                                            <div class="info-row date hide-on-grid">
                                                                <p><i class="fa fa-user"></i> <a href="#">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="body-right table-cell hidden-gird-cell">
                                                            <div class="info-row price">
                                                                @if($property->purpose == 'sell' && $property->type != 'projects'):
                                                                <h3>Rs {{ $property->price }}</h3>
                                                                @elseif($property->purpose == 'sell' && $property->type != 'projects' ):
                                                                <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                @endif
                                                            </div>
                                                            <div class="info-row phone text-right">
                                                                <a href="#" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="table-list full-width hide-on-list">

                                                            <div class="cell">
                                                                <div class="phone">
                                                                    <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-foot date hide-on-list">

                                                    <div class="item-foot-right">
                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }}  </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @if(empty($projects))
                                            <p>We are Sorry..! No Result Found</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end property items-->
                                    <div class="container">
                                        <div class="page-title breadcrumb-top">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="page-title-center">
                                                        <div class="col-sm-6">
                                                            <h2>All Projects Property</h2>
                                                        </div></div>
                                                    <div class="page-title-right">
                                                        <div class="view hidden-xs">
                                                            <div class="table-cell">
                                                                <span class="view-btn btn-list active"><i class="fa fa-th-list"></i></span>
                                                                <span class="view-btn btn-grid"><i class="fa fa-th-large"></i></span>
                                                                <span class="view-btn btn-grid-3-col"><i class="fa fa-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <div id="content-area">
                                                    <!--start property items-->
                                                    <div class="property-listing list-view">
                                                        <div class="row">
                                                            @foreach($Allpojectsproperties as $property)
                                                            <?php $image = '385x258' . $property->image0; ?>
                                                            <div class="item-wrap">
                                                                <div class="property-item table-list">
                                                                    <div class="table-cell">
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
                                                                                <div class="label-wrap hide-on-list">
                                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                                </div>
                                                                                <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                                </a>
                                                                                <div class="thumb-caption clearfix">
                                                                                    <ul class="actions pull-right">
                                                                                        <li>
                                                                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                                                <i class="fa fa-heart"></i>
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
                                                                                        <li>
                                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                                <i class="fa fa-camera"></i> <!--<span class="count">(12)</span>-->
                                                                                            </span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-body table-cell">

                                                                        <div class="body-left table-cell">
                                                                            <div class="info-row">
                                                                                <div class="label-wrap hide-on-grid">
                                                                                </div>
                                                                                <h2 class="property-title"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{!! str_limit("$property->title", 35) !!} </a></h2>
                                                                                <h4 class="property-location" style=" color:black;"><b>{{$property->address}}</b></h4>
                                                                                <p><div class="label-status label label-default">For {{ $property->purpose }}</div></p>
                                                                            </div>
                                                                            <div class="info-row amenities hide-on-grid">
                                                                                <p>
                                                                                    @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                    @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                    @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                </p>
                                                                                <p>{{ $property->subtype }}</p>
                                                                            </div>
                                                                            <div class="info-row date hide-on-grid">  
                                                                                <p><span><i class="fa fa-user"></i>{{  $property->city  }} {{  $property->region }}</span><span><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </span>
                                                                                <div class="phone" style="left:192px;">  <a style=" color:white; " href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary" >Details <i class="fa fa-angle-right fa-right"></i></a> </div> 
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="body-right table-cell hidden-gird-cell">
                                                                            <div class="info-row price">
                                                                                @if($property->type == 'projects')
                                                                                <h3 style="text-align:center; color: red; text-transform: uppercase;"> @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                                @if($property->purpose == 'sell')
                                                                                <h3 style=" text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </h3>
                                                                                <br><br><br>
                                                                                @else
                                                                                <h3 style="text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                            </div>
                                                                            <div class="info-row phone text-right" >

                                                                                <?php
                                                                                $id = $property->created_by;
                                                                                $Agent_property = DB::table('users')->where('id', '=', $id)->get();
                                                                                ?>
                                                                                @foreach($Agent_property as $Ag) 
                                                                                @if(!empty($Ag->DisplayName))
                                                                                <br><br><br>
                                                                                <a href="//{{ $Ag->DisplayName  }}.justdeal.pk/">
                                                                                    <img src="{{ asset('public/CompanyImage/'.$Ag->company_logo )  }}" title="{{ $Ag->DisplayName  }}" class="media-object" style="display: inline-block !important; height: 74px !important; width:74px !important; left: 20px;" alt="image"  width="74" height="74" >
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px; text-align:center;"> {{ $Ag->company_name  }}</h6>
                                                                                @else
                                                                                <br><br><br>
                                                                                <a href="">
                                                                                    <img src="{{ asset('public/ProfileImage/74x74_'.$Ag->image )  }}" title="{{ $Ag->image  }}" class="media-object" style="display: inline-block !important;" alt="image" width="74" height="74">
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px;text-align:center;"> {{ $Ag->first_name.' '.$Ag->last_name }}</h6>
                                                                                @endif

                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="table-list full-width hide-on-list">
                                                                            <div class="cell">
                                                                                <div class="info-row amenities">
                                                                                    @if($property->type == 'projects')
                                                                                    <p style="color: red;font-size: 16px;text-transform: uppercase; padding-bottom: 21px">  @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </p>
                                                                                    @endif
                                                                                    @if($property->purpose == 'sell')
                                                                                    <p style="color: red;font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </p>
                                                                                    @else
                                                                                    <p class="rant" style="color: red; font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </p>
                                                                                    @endif
                                                                                    <p>
                                                                                        @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                        @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                        @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                    </p>
                                                                                    <p>{{ $property->subtype }}</p>
                                                                                </div>
                                                                                <div class="phone">
                                                                                    <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                                    {{--<p><a href="#">{{ $property->cell_phone }}</a></p>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-foot date hide-on-list">
                                                                    <div class="item-foot-left">
                                                                        <p><i class="fa fa-user"></i> <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                    </div>
                                                                    <div class="item-foot-right">
                                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @if(empty($Allpojectsproperties))
                                                            <p>We are Sorry..! No Result Found</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--end property items-->
                                                    <hr>
                                                    {{ $Allpojectsproperties->render() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-tab-pane tab-pane fade">
                                <div class="profile-tab-content profile-properties">
                                    <div class="property-filter-wrap">
                                        <h4 class="filter-title"> Sale Properties </h4>

                                    </div>
                                    <!--start property items-->
                                    <div class="property-listing grid-view grid-view-3-col">
                                        <div class="row">
                                            @foreach($SellProperty as $property)
                                            <?php $image = '385x258' . $property->image0; ?>
                                            <div class="item-wrap">
                                                <div class="property-item table-list">
                                                    <div class="table-cell">
                                                        <div class="figure-block">
                                                            <figure class="item-thumb">
                                                                <span class="label-featured label label-success">Featured</span>
                                                                <div class="label-wrap label-right hide-on-list">
                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                </div>
                                                                <div class="price hide-on-list">
                                                                    @if($property->purpose == 'sell' && $property->type != 'projects'):
                                                                    <h3>Rs {{ $property->price }}</h3>
                                                                    @elseif($property->purpose == 'sell' && $property->type != 'projects' ):
                                                                    <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                    @endif
                                                                </div>
                                                                <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                </a>
                                                                <ul class="actions">
                                                                    <li>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </li>
                                                                    <li class="share-btn">
                                                                        <div class="share_tooltip fade">
                                                                            <a href="/facebook/{{ $property->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                            <a href="/twitter/{{ $property->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                            <a href="/gplus/{{ $property->id }}"  target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                            <a href="/pinterest/{{ $property->id }}" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                                        </div>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                            <i class="fa fa-camera"></i>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="item-body table-cell">

                                                        <div class="body-left table-cell">
                                                            <div class="info-row">
                                                                <div class="label-wrap hide-on-grid">
                                                                    <div class="label-status label label-default">For {{ $property->purpose }}</div>
                                                                </div>
                                                                <h2 class="property-title"><a href="#">{{ $property->title }}</a></h2>
                                                            </div>
                                                            <div class="info-row amenities hide-on-grid">
                                                                <p>
                                                                <p>
                                                                    {{--<span>Beds: {{ $property->beds }}</span>--}}
                                                                    {{--<span>Baths: {{ $property->bathroom }}</span>--}}
                                                                    <span>{{ $property->area_unit }}: {{ $property->area }}</span>
                                                                </p>

                                                                <span>{{ $property->subtype }}</span>
                                                                </p>
                                                                <p>{{ $property->title }}</p>
                                                            </div>
                                                            <div class="info-row date hide-on-grid">
                                                                <p><i class="fa fa-user"></i> <a href="#">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="body-right table-cell hidden-gird-cell">
                                                            <div class="info-row price">
                                                                @if($property->purpose == 'sell' && $property->type != 'projects'):
                                                                <h3>Rs {{ $property->price }}</h3>
                                                                @elseif($property->purpose == 'sell' && $property->type != 'projects' ):
                                                                <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                @endif
                                                            </div>
                                                            <div class="info-row phone text-right">
                                                                <a href="#" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="table-list full-width hide-on-list">

                                                            <div class="cell">
                                                                <div class="phone">
                                                                    <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-foot date hide-on-list">

                                                    <div class="item-foot-right">
                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }}  </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end property items-->
                                    <div class="container">
                                        <div class="page-title breadcrumb-top">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="page-title-center">
                                                        <div class="col-sm-6">
                                                            <h2>All Sale Properties</h2>
                                                        </div></div>
                                                    <div class="page-title-right">
                                                        <div class="view hidden-xs">
                                                            <div class="table-cell">
                                                                <span class="view-btn btn-list active"><i class="fa fa-th-list"></i></span>
                                                                <span class="view-btn btn-grid"><i class="fa fa-th-large"></i></span>
                                                                <span class="view-btn btn-grid-3-col"><i class="fa fa-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <div id="content-area">
                                                    <!--start property items-->
                                                    <div class="property-listing list-view">
                                                        <div class="row">
                                                            @foreach($Allsaleproperties as $property)
                                                            <?php $image = '385x258' . $property->image0; ?>
                                                            <div class="item-wrap">
                                                                <div class="property-item table-list">
                                                                    <div class="table-cell">
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
                                                                                <div class="label-wrap hide-on-list">
                                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                                </div>
                                                                                <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                                </a>
                                                                                <div class="thumb-caption clearfix">
                                                                                    <ul class="actions pull-right">
                                                                                        <li>
                                                                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                                                <i class="fa fa-heart"></i>
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
                                                                                        <li>
                                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                                <i class="fa fa-camera"></i> <!--<span class="count">(12)</span>-->
                                                                                            </span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-body table-cell">

                                                                        <div class="body-left table-cell">
                                                                            <div class="info-row">
                                                                                <div class="label-wrap hide-on-grid">
                                                                                </div>
                                                                                <h2 class="property-title"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{!! str_limit("$property->title", 35) !!} </a></h2>
                                                                                <h4 class="property-location" style=" color:black;"><b>{{$property->address}}</b></h4>
                                                                                <p><div class="label-status label label-default">For {{ $property->purpose }}</div></p>
                                                                            </div>
                                                                            <div class="info-row amenities hide-on-grid">
                                                                                <p>
                                                                                    @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                    @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                    @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                </p>
                                                                                <p>{{ $property->subtype }}</p>
                                                                            </div>
                                                                            <div class="info-row date hide-on-grid">  
                                                                                <p><span><i class="fa fa-user"></i>{{  $property->city  }} {{  $property->region }}</span><span><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </span>
                                                                                <div class="phone" style="left:192px;">  <a style=" color:white; " href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary" >Details <i class="fa fa-angle-right fa-right"></i></a> </div> 
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="body-right table-cell hidden-gird-cell">
                                                                            <div class="info-row price">
                                                                                @if($property->type == 'projects')
                                                                                <h3 style="text-align:center; color: red; text-transform: uppercase;"> @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                                @if($property->purpose == 'sell')
                                                                                <h3 style=" text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </h3>
                                                                                <br><br><br>
                                                                                @else
                                                                                <h3 style="text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                            </div>
                                                                            <div class="info-row phone text-right" >

                                                                                <?php
                                                                                $id = $property->created_by;
                                                                                $Agent_property = DB::table('users')->where('id', '=', $id)->get();
                                                                                ?>
                                                                                @foreach($Agent_property as $Ag) 
                                                                                @if(!empty($Ag->DisplayName))
                                                                                <br><br><br>
                                                                                <a href="//{{ $Ag->DisplayName  }}.justdeal.pk/">
                                                                                    <img src="{{ asset('public/CompanyImage/'.$Ag->company_logo )  }}" title="{{ $Ag->DisplayName  }}" class="media-object" style="display: inline-block !important; height: 74px !important; width:74px !important; left: 20px;" alt="image"  width="74" height="74" >
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px; text-align:center;"> {{ $Ag->company_name  }}</h6>
                                                                                @else
                                                                                <br><br><br>
                                                                                <a href="">
                                                                                    <img src="{{ asset('public/ProfileImage/74x74_'.$Ag->image )  }}" title="{{ $Ag->image  }}" class="media-object" style="display: inline-block !important;" alt="image" width="74" height="74">
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px;text-align:center;"> {{ $Ag->first_name.' '.$Ag->last_name }}</h6>
                                                                                @endif

                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="table-list full-width hide-on-list">
                                                                            <div class="cell">
                                                                                <div class="info-row amenities">
                                                                                    @if($property->type == 'projects')
                                                                                    <p style="color: red;font-size: 16px;text-transform: uppercase; padding-bottom: 21px">  @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </p>
                                                                                    @endif
                                                                                    @if($property->purpose == 'sell')
                                                                                    <p style="color: red;font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </p>
                                                                                    @else
                                                                                    <p class="rant" style="color: red; font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </p>
                                                                                    @endif
                                                                                    <p>
                                                                                        @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                        @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                        @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                    </p>
                                                                                    <p>{{ $property->subtype }}</p>
                                                                                </div>
                                                                                <div class="phone">
                                                                                    <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                                    {{--<p><a href="#">{{ $property->cell_phone }}</a></p>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-foot date hide-on-list">
                                                                    <div class="item-foot-left">
                                                                        <p><i class="fa fa-user"></i> <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                    </div>
                                                                    <div class="item-foot-right">
                                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @if(empty($Allsaleproperties))
                                                            <p>We are Sorry..! No Result Found</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--end property items-->
                                                    <hr>
                                                    {{ $Allsaleproperties->render() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-tab-pane tab-pane fade">
                                <div class="profile-tab-content profile-properties">
                                    <div class="property-filter-wrap">
                                        <h4 class="filter-title"> Rent Properties </h4>

                                    </div>
                                    <!--start property items-->
                                    <div class="property-listing grid-view grid-view-3-col">
                                        <div class="row">
                                            @foreach($RentProperty as $property)
                                            <?php $image = '385x258' . $property->image0; ?>
                                            <div class="item-wrap">
                                                <div class="property-item table-list">
                                                    <div class="table-cell">
                                                        <div class="figure-block">
                                                            <figure class="item-thumb">
                                                                <span class="label-featured label label-success">Featured</span>
                                                                <div class="label-wrap label-right hide-on-list">
                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                </div>
                                                                <div class="price hide-on-list">
                                                                    @if($property->purpose == 'sell' && $property->type != 'projects')
                                                                    <h3>Rs {{ $property->price }}</h3>
                                                                    @elseif($property->purpose == 'sell' && $property->type != 'projects' )
                                                                    <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                    @endif
                                                                </div>
                                                                <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                </a>
                                                                <ul class="actions">
                                                                    <li>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                            <i class="fa fa-heart"></i>
                                                                        </span>
                                                                    </li>
                                                                    <li class="share-btn">
                                                                        <div class="share_tooltip fade">
                                                                            <a href="/facebook/{{ $property->id }}" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                            <a href="/twitter/{{ $property->id }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                            <a href="/gplus/{{ $property->id }}"  target="_blank"><i class="fa fa-google-plus"></i></a>
                                                                            <a href="/pinterest/{{ $property->id }}" target="_blank"><i class="fa fa-pinterest"></i></a>
                                                                        </div>
                                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                                    </li>
                                                                    <li>
                                                                        <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                            <i class="fa fa-camera"></i>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="item-body table-cell">

                                                        <div class="body-left table-cell">
                                                            <div class="info-row">
                                                                <div class="label-wrap hide-on-grid">
                                                                    <div class="label-status label label-default">For {{ $property->purpose }}</div>
                                                                </div>
                                                                <h2 class="property-title"><a href="#">{{ $property->title }}</a></h2>
                                                            </div>
                                                            <div class="info-row amenities hide-on-grid">
                                                                <p>
                                                                <p>
                                                                    <span>Beds: {{ $property->beds }}</span>
                                                                    <span>Baths: {{ $property->bathroom }}</span>
                                                                    <span>{{ $property->area_unit }}: {{ $property->area }}</span>
                                                                </p>

                                                                <span>{{ $property->subtype }}</span>
                                                                </p>
                                                                <p>{{ $property->title }}</p>
                                                            </div>
                                                            <div class="info-row date hide-on-grid">
                                                                <p><i class="fa fa-user"></i> <a href="#">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                            </div>
                                                        </div>
                                                        <div class="body-right table-cell hidden-gird-cell">
                                                            <div class="info-row price">
                                                                @if($property->purpose == 'sell' && $property->type != 'projects')
                                                                <h3>Rs {{ $property->price }}</h3>
                                                                @elseif($property->purpose == 'sell' && $property->type != 'projects' )
                                                                <p class="rant">Rs {{ $property->price }}/Month</p>
                                                                @endif
                                                            </div>
                                                            <div class="info-row phone text-right">
                                                                <a href="#" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="table-list full-width hide-on-list">

                                                            <div class="cell">
                                                                <div class="phone">
                                                                    <a href="http://justdeal.pk/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-foot date hide-on-list">

                                                    <div class="item-foot-right">
                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }}  </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end property items-->
                                    <div class="container">
                                        <div class="page-title breadcrumb-top">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="page-title-center">
                                                        <div class="col-sm-6">
                                                            <h2>All Rent Properties</h2>
                                                        </div></div>
                                                    <div class="page-title-right">
                                                        <div class="view hidden-xs">
                                                            <div class="table-cell">
                                                                <span class="view-btn btn-list active"><i class="fa fa-th-list"></i></span>
                                                                <span class="view-btn btn-grid"><i class="fa fa-th-large"></i></span>
                                                                <span class="view-btn btn-grid-3-col"><i class="fa fa-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <div id="content-area">
                                                    <!--start property items-->
                                                    <div class="property-listing list-view">
                                                        <div class="row">
                                                            @foreach($AllRentproperties as $property)
                                                            <?php $image = '385x258' . $property->image0; ?>
                                                            <div class="item-wrap">
                                                                <div class="property-item table-list">
                                                                    <div class="table-cell">
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
                                                                                <div class="label-wrap hide-on-list">
                                                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                                                </div>
                                                                                <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">
                                                                                    <img src="{{ asset('public/propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}">
                                                                                </a>
                                                                                <div class="thumb-caption clearfix">
                                                                                    <ul class="actions pull-right">
                                                                                        <li>
                                                                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                                                                <i class="fa fa-heart"></i>
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
                                                                                        <li>
                                                                                            <span data-toggle="tooltip" data-placement="top" title="Photos (12)">
                                                                                                <i class="fa fa-camera"></i> <!--<span class="count">(12)</span>-->
                                                                                            </span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-body table-cell">

                                                                        <div class="body-left table-cell">
                                                                            <div class="info-row">
                                                                                <div class="label-wrap hide-on-grid">
                                                                                </div>
                                                                                <h2 class="property-title"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{!! str_limit("$property->title", 35) !!} </a></h2>
                                                                                <h4 class="property-location" style=" color:black;"><b>{{$property->address}}</b></h4>
                                                                                <p><div class="label-status label label-default">For {{ $property->purpose }}</div></p>
                                                                            </div>
                                                                            <div class="info-row amenities hide-on-grid">
                                                                                <p>
                                                                                    @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                    @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                    @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                </p>
                                                                                <p>{{ $property->subtype }}</p>
                                                                            </div>
                                                                            <div class="info-row date hide-on-grid">  
                                                                                <p><span><i class="fa fa-user"></i>{{  $property->city  }} {{  $property->region }}</span><span><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </span>
                                                                                <div class="phone" style="left:192px;">  <a style=" color:white; " href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary" >Details <i class="fa fa-angle-right fa-right"></i></a> </div> 
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="body-right table-cell hidden-gird-cell">
                                                                            <div class="info-row price">
                                                                                @if($property->type == 'projects')
                                                                                <h3 style="text-align:center; color: red; text-transform: uppercase;"> @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                                @if($property->purpose == 'sell')
                                                                                <h3 style=" text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </h3>
                                                                                <br><br><br>
                                                                                @else
                                                                                <h3 style="text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </h3>
                                                                                <br><br><br>
                                                                                @endif
                                                                            </div>
                                                                            <div class="info-row phone text-right" >

                                                                                <?php
                                                                                $id = $property->created_by;
                                                                                $Agent_property = DB::table('users')->where('id', '=', $id)->get();
                                                                                ?>
                                                                                @foreach($Agent_property as $Ag) 
                                                                                @if(!empty($Ag->DisplayName))
                                                                                <br><br><br>
                                                                                <a href="//{{ $Ag->DisplayName  }}.justdeal.pk/">
                                                                                    <img src="{{ asset('public/CompanyImage/'.$Ag->company_logo )  }}" title="{{ $Ag->DisplayName  }}" class="media-object" style="display: inline-block !important; height: 74px !important; width:74px !important; left: 20px;" alt="image"  width="74" height="74" >
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px; text-align:center;"> {{ $Ag->company_name  }}</h6>
                                                                                @else
                                                                                <br><br><br>
                                                                                <a href="">
                                                                                    <img src="{{ asset('public/ProfileImage/74x74_'.$Ag->image )  }}" title="{{ $Ag->image  }}" class="media-object" style="display: inline-block !important;" alt="image" width="74" height="74">
                                                                                </a>
                                                                                <h6 style="margin: 0 0 7px !important;font-size: 14px;text-align:center;"> {{ $Ag->first_name.' '.$Ag->last_name }}</h6>
                                                                                @endif

                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="table-list full-width hide-on-list">
                                                                            <div class="cell">
                                                                                <div class="info-row amenities">
                                                                                    @if($property->type == 'projects')
                                                                                    <p style="color: red;font-size: 16px;text-transform: uppercase; padding-bottom: 21px">  @if(!empty($property->type == 'projects')) {{ $property->type }} @endif </p>
                                                                                    @endif
                                                                                    @if($property->purpose == 'sell')
                                                                                    <p style="color: red;font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }} @endif </p>
                                                                                    @else
                                                                                    <p class="rant" style="color: red; font-size: 16px;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </p>
                                                                                    @endif
                                                                                    <p>
                                                                                        @if(!empty($property->beds))<span><i class="fa fa-bed" aria-hidden="true">: {{ $property->beds }}</i></span>@endif
                                                                                        @if(!empty($property->bathroom))<span><i class="fa fa-bath" aria-hidden="true">: {{ $property->bathroom }}</i></span>@endif
                                                                                        @if(!empty($property->area))<span><i class="fa fa-area-chart" aria-hidden="true">: {{ $property->area }}{{ $property->area_unit }}</i></span>@endif
                                                                                    </p>
                                                                                    <p>{{ $property->subtype }}</p>
                                                                                </div>
                                                                                <div class="phone">
                                                                                    <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a>
                                                                                    {{--<p><a href="#">{{ $property->cell_phone }}</a></p>--}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="item-foot date hide-on-list">
                                                                    <div class="item-foot-left">
                                                                        <p><i class="fa fa-user"></i> <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{{  $property->city  }} {{  $property->region }}</a></p>
                                                                    </div>
                                                                    <div class="item-foot-right">
                                                                        <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @if(empty($AllRentproperties))
                                                            <p>We are Sorry..! No Result Found</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!--end property items-->
                                                    <hr>
                                                    {{ $AllRentproperties->render() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-tab-pane tab-pane fade">
                                <div class="profile-tab-content profile-agents">
                                    <div class="row row-fluid">
                                        @foreach($agents as $Agent)
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="team-block">
                                                <img src="{{ asset('public/AgentImage/330x330_'.$Agent->logo )  }}" alt="{{ $Agent->name }}" width="800" height="1188" align="team">
                                                <div class="team-caption team-caption-before">
                                                    <div class="team-caption-inner">
                                                        <h4 class="team-name"><a href="#">{{ $Agent->name }}</a></h4>
                                                        <p class="team-designation"><a href="#">{{ $Agent->city }}</a></p>
                                                        <p class="team-designation"><a href="#">{{ $Agent->number }}</a></p>
                                                    </div>
                                                </div>
                                                <div class="team-caption team-caption-after">
                                                    <div class="team-caption-inner">
                                                        <h4 class="team-name"><a href="#">{{ $Agent->name }}</a></h4>
                                                        <p class="team-designation"><a href="#">{{ $Agent->city }}</a></p>
                                                        <p class="team-designation"><a href="#">{{ $Agent->number }}</a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="profile-tab-pane tab-pane fade">
                                <div class="profile-tab-content profile-review">
                                    <h3 class="title">Contact Us</h3>
                                    <div class="add-review-block">
                                        <div class="col-sm-8">
                                            <div class="profile-description">
                                                <ul class="profile-contact">
                                                    <li><span>City:</span> {{ $Agent->city }}</li>
                                                    <li><span>Address:</span> {{ $Agent->address }}</li>
                                                    <li><span>OFFICE:</span> <a href="tel:{{ $Agent->company_phone }}">{{ $Agent->company_phone }}</a></li>
                                                    <li><span>MOBILE:</span> <a href="tel:{{ $Agent->cell_phone }}">{{ $Agent->cell_phone }}</a></li>
                                                    <li><span>FAX:</span> <a>{{ $Agent->first_name }}</a></li>
                                                    <li class="email"><span>Email:</span> <a href="mailto:{{ $Agent->email2 }}">{{ $Agent->email2 }}</a></li>
                                                </ul>
                                                <ul class="profile-social">
                                                    <li><a href="#"><i class="fa fa-phone-square"></i></a></li>
                                                    <li><a class="btn-facebook" href="{{ $Agent->facebook }}" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                                                    <li><a class="btn-twitter" href="{{ $Agent->twitter }}" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                                    <li><a class="btn-linkedin" href="{{ $Agent->linkedin }}" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>
                                                    <li><a class="btn-google-plus" href="{{ $Agent->googleplus }}" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Your Name" name="name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Phone" name="phone" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <textarea placeholder="Your Detail" rows="5" name="message" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <button class="btn btn-secondary">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--start carousel module add-->
<!--   <div id="carousel-module-6" class=" caption-bottom carousel-module">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="module-title-nav clearfix" style="margin-bottom: 25px;">
                      <div>
                          <h2>Advertisement</h2>
                      </div>
                      <div class="module-nav">
                          <button class="btn btn-sm btn-crl-6-prev-add">Prev</button>
                          <button class="btn btn-sm btn-crl-6-next-add">Next</button>
                          <a href="#" class="btn btn-carousel btn-sm">All</a>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12">
                  <div id="properties-carouseladd-6" class="carousel slide-animated">
                      @foreach($Adds as $add)
<?php $image = '385x258_' . $add->image; ?>
                          <div class="item">
                              <div class="figure-block">
                                  <figure class="item-thumb">
                                      <a href="{{ $add->webSite_url }}" class="hover-effect" target="_blank">
                                          <img src="{{ asset('public/AddsImages/'.$image)  }}" alt="{{ $property->title }}" width="194" height="143" >
                                      </a>
                                  </figure>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div> -->
<!--end carousel module add-->

@endsection
@section('pagejs')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection