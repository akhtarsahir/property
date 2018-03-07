@extends('layouts.app')
@section('content')

    <!--start section page body-->
  <!--   <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h2>All Agents</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
                    <div id="content-area">
                        <div class="agent-listing">

                            @foreach($Agents as $Agent)
                            <div class="profile-detail-block" style="padding: 10px !important;">
                                <div class="media">
                                    <div class="media-left">
                                        <figure style="width:185px !important;height:185px !important">
                                            <img src="{{ asset('ProfileImage/'.'239x239_'.$Agent->image )  }}" alt="{{ $Agent->first_name }} {{ $Agent->last_name }} " width="100" height="100">
                                        </figure>
                                      <a href="//{{ $Agent ->DisplayName  }}.justdeal.pk/" class="btn btn-primary btn-block hidden-xs">View My Properties</a>
                                    </div>
                                    <div class="media-body">
                                        <div class="profile-description">
                                            <h3>{{ $Agent->company_name }}</h3>
                                            <ul class="profile-contact">
                                                <li><span>OFFICE:</span> <a href="#">{{ $Agent->company_phone }}</a></li>
                                                <li><span>MOBILE:</span> <a href="#">{{ $Agent->company_mobileNo }}</a></li>
                                                <li><span>FAX:</span> <a href="#">{{$Agent->fax_phone}}</a></li>
                                                <li class="email"><span>Email:</span> <a href="mailto:{{ $Agent->email }}">{{ $Agent->email2 }}</a></li>
                                            </ul>
                                            <ul class="profile-social">
                                              <li><a href="{{ $Agent->cell_phone }}"><i class="fa fa-phone-square"></i></a></li>
                                                <li><a href="{{ $Agent->facebook }}"><i class="fa fa-facebook-square"></i></a></li>
                                                <li><a href="{{ $Agent->twitter }}"><i class="fa fa-twitter-square"></i></a></li>
                                                <li><a href="{{ $Agent->linkedin }}"><i class="fa fa-linkedin-square"></i></a></li>
                                            </ul>
                                            <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/" class="btn btn-primary btn-block visible-xs">View My Properties</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <hr>

                                {{ $Agents->render() }}

                    </div>
                </div>
            @include('layouts.leftsidebar')
            </div>
        </div>
    </section> -->
    <!--end section page body-->
    <!--start section page body-->
    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="active"> All Agencies </li>
                        </ol>
                        <div class="page-title-left">
                            <h1> All Agencies </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 list-grid-area container-contentbar">
                    <div id="content-area">
                        <div class="agency-listing">
                         @foreach($Agents as $Agent)
                            <div class="agency-block" style="padding: 10px !important;">
                                <div class="media">
                                    <div class="media-left">
                                        <figure style="width:185px !important;height:185px !important">
                                            <img src="{{ asset('public/ProfileImage/'.'239x239_'.$Agent->image )  }}" alt="{{ $Agent->first_name }} {{ $Agent->last_name }} "width="140" height="100">
                                        </figure>
                                    </div>
                                    <div class="media-body">
                                      <div class="agency-body-left">
                                            <ul class="agency-social social-top">
                                                <li><a href="{{ $Agent->cell_phone }}"><i class="fa fa-phone-square"></i></a></li>
                                                <li><a href="{{ $Agent->facebook }}"><i class="fa fa-facebook-square"></i></a></li>
                                                <li><a href="{{ $Agent->twitter }}"><i class="fa fa-twitter-square"></i></a></li>
                                                <li><a href="{{ $Agent->linkedin }}"><i class="fa fa-linkedin-square"></i></a></li>
                                            </ul>
                                            <ul class="agency-contact">
                                                <li><span>OFFICE:</span> <a href="#">{{ $Agent->company_phone }}</a></li>
                                                <li><span>MOBILE:</span> <a href="#">{{ $Agent->company_mobileNo }}</a></li>
                                                <li><span>FAX:</span> <a href="#">{{$Agent->fax_phone}}</a></li>
                                                <li class="email"><span>Email:</span> <a href="mailto:{{ $Agent->email }}">{{ $Agent->email2 }}</a></li>
                                            </ul>
                                            <ul class="agency-social  social-bottom">
                                                <li><a href="{{ $Agent->cell_phone }}"><i class="fa fa-phone-square"></i></a></li>
                                                <li><a href="{{ $Agent->facebook }}"><i class="fa fa-facebook-square"></i></a></li>
                                                <li><a href="{{ $Agent->twitter }}"><i class="fa fa-twitter-square"></i></a></li>
                                                <li><a href="{{ $Agent->linkedin }}"><i class="fa fa-linkedin-square"></i></a></li>
                                            </ul>
                                             <a href="//{{ $Agent->DisplayName  }}.justdeal.pk/" class="btn btn-primary btn-block visible-xs">View My Properties</a>
                                        </div>
                                         <div class="agency-body-right">
                                            <div class="agency-description">
                                                <h3>{{ $Agent->company_name }}</h3>
                                                <h4 class="position"> {{$Agent->address }} </h4>
                                                <!-- <p>{!! $Agent->description !!}.</p> -->
                                            </div>
                                             <a href="//{{ $Agent ->DisplayName  }}.justdeal.pk/" class="btn btn-primary btn-block hidden-xs">View My Properties</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                        </div>

                        <hr>
                        <!--start Pagination-->
                         {{ $Agents->render() }}
                        <!--start Pagination-->

                    </div>
                </div>
                <!--start left sidebar section-->
            @include('layouts.leftsidebar')
            <!--end left sidebar section-->
            </div>
        </div>
    </section>
    <!--end section page body-->
@stop