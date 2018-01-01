@extends('admin/layouts/app')

@section('pagecss')
<!--page level css -->
<link href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/vendors/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/pages/user_profile.css')}}" rel="stylesheet" type="text/css"/>
<!--end of page level css-->
@endsection

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Featured Price set</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li class="active">Featured Price set</li>
        </ol>
    </section>

    <section class="content">
        <div class="col-md-12">
            @if(Session::has('Message'))
            <div class="alert alert-success">
                <p class="errors">{!! Session::get('Message') !!}</p>
            </div>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">
                <p class="errors">{!! Session::get('success') !!}</p>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Featured Price set</div>
                <div class="panel-body">
                    <form action="/admin/price_update/" method="post" enctype="multipart/form-data" name="myform">
                        {!! csrf_field() !!}
                     
                        @foreach($price_set as $pro)
                           <input id="id" type="hidden" name="id" value="{{$pro->price_id}}">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Premium HomePage</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{$pro->premium_homepageprice}}" name="premium_homepageprice" >
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Feature HomePage</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{$pro->featured_homepageprice}}" name="featured_homepageprice" >
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Premium ListingPage</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{$pro->premium_listpageprice}}" name="premium_listpageprice" >
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Feature ListingPage</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text"  class="form-control" value="{{$pro->featured_listpageprice}}" name="featured_listpageprice" >
                            </div>
                        </div>

                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-file"></i> Update Price
                                </button>
                            </div>
                        </div>
                        <br>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </section>
</aside>


@endsection

@section('pagejs')

<!-- begining of page level js -->
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/jquery.mockjax.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/bootstrap-editable.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/user_profile.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@endsection

