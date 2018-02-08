@extends('layouts/app')


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
@endsection
<!--end of page level css-->


@section('content')
<!--start section page body-->
<section id="section-body-inner">
    <!--start Premium carousel module -->
    <div id="carousel-module-4" class="houzez-module caption-above carousel-module"style="padding:0px;">
        <div class="container">
            <div class="row">
                <h2 style="margin-left: 16px;margin-top: -23px !important">Premium Properties</h2>
                <!--                <div class="col-sm-12">
                                    <div class="module-title-nav clearfix">
                                        <div>-->

                <!--</div>-->
                <!--                        <div class="module-nav">
                                            <button class="btn btn-sm btn-crl-4-prev">Prev</button>
                                            <button class="btn btn-sm btn-crl-4-next">Next</button>
                                            <a href="#" class="btn btn-carousel btn-sm">All</a>
                                        </div>-->
                <!--                    </div>
                                </div>-->
                <div class="col-sm-12">
                    <div id="properties-carousel-4" class="carousel slide-animated">
                        @foreach($Projects as $property)

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
                                    <!--                                    <a href="#" class="hover-effect">
                                                                            <img src="http://placehold.it/291x217" width="291" height="217" alt="Image">
                                                                        </a>-->
                                    <a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="hover-effect">
                                        <img src="{{ asset('propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}"  width="291" height="217">
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
                                    <img src="{{ asset('propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}" width="385" height="258" >
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
        <!--    <div class="houzez-module module-title text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <h2>Feature On Home</h2>
                            <h3 class="sub-heading">Book space in amazing locations across the world</h3>
                        </div>
                    </div>
                </div>
            </div>-->
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
                                    <img src="{{ asset('propetyImages/'.$property->id.'/'.$image)  }}" alt="{{ $property->title }}" width="385" height="258" >
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

        <!--start agents module-->
        <div class=" module-title text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <h2>Agency</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="agents-module" class="houzez-module agents-module">
            <div class="container">
                <div class="agents-blocks-main">
                    <div class="row no-margin">

                        @foreach($Agents as $agent)
                            <div class="col-md-1">
                                {{--<div class="agents-block">--}}
                                <a href="//{{ $agent->DisplayName  }}.justdeal.pk/" class="view">
                                    <div data-container="body"  tabindex="0" data-toggle="popover" data-placement="top" data-content="<h2> {{ $agent->first_name.' '.$agent->last_name }}</h2><img src='{{ asset('ProfileImage/'.'200x150_'.$agent->image )  }}'></div>">
                                        <img src="{{ asset('ProfileImage/'.'71x71_'.$agent->image )  }}" alt="{{ $agent->first_name.' '.$agent->last_name }}" width="71" height="71" class="img-circle3">

                                    </div>
                                </a>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>

                </section>

            </div>
        </div>
    </div>
    
@endsection
<!-- begining of page level js -->
@section('pagejs')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection