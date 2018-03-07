@extends('layouts.app')
@section('content')
@include('layouts.advance_search')
 <div class="header-media">
        <div class="banner-parallax" style="height: 400px;">
            <div class="banner-bg-wrap">
                <div class="banner-inner" style="background-image: url('assets/images/about_us.jpg');"></div>
            </div>
        </div>
        <div class="banner-caption">
            <h1>About Us</h1>
            <h2>A Real Estate  You Can Trust</h2>
        </div>
    </div>
<!--start section page body-->
    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="{{url('index')}}"><i class="fa fa-home"></i></a></li>
                            <li class="active">About Us</li>
                        </ol>
                        <div class="page-title-left">
                            <h2>About us</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="page-main">
                        <div class="article-detail">
                            <div class='box-body pad'>
                            @foreach($data as $policy)
                            
                           {!! $policy->description !!}

                            @endforeach
                            </div>
                           

                           

                        </div>
                    </div>
                </div>
                <!--start advanced search section-->
            @include('layouts.advance_search')
            
            </div>
        </div>
    </section>
    <!--end section page body-->
    @stop