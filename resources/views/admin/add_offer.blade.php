@extends('admin/layouts/app')
@section('content')
<!--page level css -->
<link href="{{asset('assets/vendors/fullcalendar/css/fullcalendar.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/pages/calendar_custom.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendors/animate/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/only_dashboard.css')}}" />
<!--end of page level css-->
<aside class="right-side">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Add Banner Offer</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Banner Offer</a>
            </li>

        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                @if(Session::has('Message'))
                <div class="alert alert-success">
                    <p class="errors">{!! Session::get('Message') !!}</p>
                </div>
                @endif
            </div></div>
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
                        <form action="{{ URL::action('OfferController@store') }}" method="post"  class="form-horizontal" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Offer Image </label>
                                <div class="col-md-8 ">
                                    <input type="file" name="image" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Link </label>
                                <div class="col-md-8 ">
                                    <input type="text" name="link" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Banner Show </label>
                                <div class="col-md-8 ">
                                    <select class="form-control" title="Select an Banner show..."  selected="Select" name="show" id="show">
                                        <option value="left">Left</option>
                                        <option value="right">Right</option>
                                        <option value="center">Center</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn-success btn">Submit</button>

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

@endsection