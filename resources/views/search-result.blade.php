@extends('layouts.app')
<!--page level css -->
@section('pagecss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
<!--end of page level css-->
@section('content')

<!--start advanced search section-->
<!--@include('layouts.advance_search')-->
<!--end advanced search section -->
<!--start advanced search section-->
    @include('layouts.header')
    <!--end advanced search section -->
<!--start section page body-->
<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-center">
                        <div class="col-sm-6 col-sm-offset-4">
                        @if(!empty($keyword ))
                        <h2>{{ $keyword }} @if(!empty($total_property)){{$total_property}} Results Found @endif </h2>
                        @elseif(empty($keyword ))
                         <h2>Search Results @if(!empty($total_property)){{$total_property}} Results Found @elseif(empty($total_property)) 0 Results Found @endif </h2>
                        <!--<h5>{{ $keyword }}</h5>-->
                        @endif
                        </div>
                    </div>
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
            <div class="col-lg-8 col-md-8 col-sm-8 list-grid-area">
                <div id="content-area">


                    <!--start property items-->
                    <div class="property-listing list-view">
                        <div class="row">
                            @foreach($SearchProperty as $property)
                            
                            <?php $image = '385x258' . $property->image0; ?>
                           <div class="item-wrap">
                                <div class="property-item table-list">
                                    <div class="table-cell">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success">Featured</span>
                                                <div class="label-wrap hide-on-list">
                                                    <span class="label label-default">For {{ $property->purpose }}</span>
                                                </div>
<!--                                                <div class="price hide-on-list">
                                                    @if($property->purpose == 'sell')
                                                    <h3 style="color: red;">Rs:{{ $property->price }}</h3>
                                                    @else
                                                    <p class="rant" style="color: red;">Rs:{{ $property->price }}/mo</p>
                                                    @endif
                                                </div>-->
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
                                                    <!--??-->
                                                </div>
                                                <h2 class="property-title"><a href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}">{!! str_limit("$property->title", 40) !!}</a></h2>
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
                                                <div >
<!--                                                  <p>
                                                       <span><a  href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary">Details <i class="fa fa-angle-right fa-right"></i></a></span>
                                                       <span><i class="fa fa-user"></i>{{  $property->city  }} {{  $property->region }}</span><span><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </span>
                                                     </p>-->
                                                    {{-- <p><a href="#">{{ $property->cell_phone }}</a></p> --}}
                                                </div>
                                            </div>
                                            <div class="info-row date hide-on-grid">  
                                                <p>
                                                     <span><i class="fa fa-user"></i>{{  $property->city  }} {{  $property->region }}</span><span><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </span>
                                                <div class="phone" style="left:192px;">  <a style=" color:white; " href="/property-detail/{{ $property->id  }}/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $property->title)  }}" class="btn btn-primary" >Details <i class="fa fa-angle-right fa-right"></i></a> </div> 
                                                </p>
<!--                                                <p><i class="fa fa-user"></i> <a href="#">{{  $property->city  }} {{  $property->region }}</a></p>
                                                    <p><i class="fa fa-calendar"></i> {{ $property->created_at->diff(new DateTime())->format('%a Days Ago') }} </p>-->
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
                                                <!--<p class="rant"><h3 style="text-align:center; color: red;">Rs:{{ $property->price }}/mo</h3></p>-->
                                                <h3 style="text-align:center; color: red;"> @if(!empty($property->price)) Rs:{{ $property->price }}/mo @endif </h3>
                                                <br><br><br>
                                                @endif
                                            </div>
                                            
                                            <div class="info-row phone text-right">
                                               <?php
                                                $id = $property->created_by;
                                                $Agent = DB::table('users')->where('id', '=', $id)->get();
                                                ?>
                                                 @foreach($Agent as $Ag) 
                                                @if(!empty($Ag->DisplayName))
                                                <br><br><br>
                                                <a href="//{{ $Ag->DisplayName  }}.justdeal.pk/">
                                                    <img src="{{ asset('public/CompanyImage/'.$Ag->company_logo )  }}" title="{{ $Ag->DisplayName  }}" class="media-object" style="display: inline-block !important; height: 74px !important; width:74px !important; left: 20px;" alt="image"  width="74" height="74" >
                                                </a>
                                                <h6 style="margin: 0 0 7px !important;font-size: 14px; text-align:center;"> {{ $Ag->company_name  }}</h6>
                                                @else
                                                <br><br><br>
                                                <a href="">
                                                    <img src="{{ asset('public/ProfileImage/74x74_'.$Ag->image )  }}" title="{{ $Ag->image  }}" class="media-object" style="display: inline-block !important; height: 74px !important; width:74px !important; left: 20px;" alt="image" width="74" height="74">
                                                </a>
                                                <h6 style="margin: 0 0 7px !important;font-size: 14px; text-align:center;"> {{ $Ag->first_name.' '.$Ag->last_name }}</h6>
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
<!--                                            <div class="cell">
                                                <div class="info-row phone text-right" style="display:inline !important;">
                                                    <?php
//                                                    $id = $property->created_by;
//                                                    $Agent = DB::table('users')->where('id', '=', $id)->get();
                                                    ?>
                                                    <div class="media-left">
                                                    @foreach($Agent as $Ag)
                                                    <p><h6 style="display:inline !important;">{{ $Ag->DisplayName  }}</h6></p>
                                                    @if(!empty($Ag->DisplayName))
                                                    <a href="//{{ $Ag->DisplayName  }}.justdeal.pk/">
                                                        <img src="{{ asset('ProfileImage/74x74_'.$Ag->image)  }}" class="media-object" style="display:inline !important;" alt="image" width="74" height="74">
                                                    </a>
                                                    @else
                                                    <a href="">
                                                        <img src="{{ asset('ProfileImage/74x74_'.$Ag->image)  }}" class="media-object" style="display:inline !important;" alt="image" width="74" height="74">
                                                    </a>
                                                    @endif
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>-->
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
                           
                            <!--<p>We are Sorry..! No Result Found</p>-->
                           @endforeach
                           @if(empty($total_property))
                             <p>We are Sorry..! No Result Found</p>
                             @endif
                        </div>
                    </div>
                    <!--end property items-->

                    <hr>

                    <!--start Pagination-->
<!--                    <div class="pagination-main">
                    <ul class="pagination">-->
                    {{ $SearchProperty->render() }}
<!--                    </ul>
                    </div>-->
                    <!--start Pagination-->

                </div>
            </div>
            <!--start advanced search section-->
            @include('layouts.leftsidebar')
            <!--end advanced search section-->
        </div>
    </div>
</section>
<!--end section page body-->



@Stop