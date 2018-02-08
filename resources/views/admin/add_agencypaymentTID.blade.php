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
        <h1>Add Your Transfer ID and Order No</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li class="active">Add Transfer ID</li>
        </ol>
    </section>

    <section class="content">
        <div class="col-md-12">
            @if(Session::has('Message'))
            <div class="alert alert-success">
                <p class="errors">{!! Session::get('Message') !!}</p>
            </div>
            @endif
            @if(Session::has('success12'))
            <div class="alert alert-success">
                <p class="errors">{!! Session::get('success12') !!}</p>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Transfer ID</div>
                <div class="panel-body">
                    <form action="/admin/add_agencypaymentTIDStore/" method="post" enctype="multipart/form-data" name="myform" id="form-id">
                        {!! csrf_field() !!}
                        <input id="id" type="hidden" name="id" value="{{ Auth::user()->id }}">
                        @foreach($orders as $pro)
                         <input id="agencyorder_id" type="hidden" name="agencyorder_id" value="{{$pro->id}}">
                         <input id="user_id" type="hidden" name="user_id" value="{{$pro->user_id}}">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Order No</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control" value="{{$pro->order_no}}" name="order_no" >
                            </div>
                             <div class="col-md-2">
                                <label for="featured_price">Payment Price</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" readonly value="{{$pro->featured_price}}" name="featured_price" >
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="featured_price">Transfer ID</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="" name="transferId" required>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button id="your-id" onclick="thisfunction()" name="submit" type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-file"></i>Submit 
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
<script>

    function thisfunction() {
    if (confirm("Thank you for your payment!\nPlease Wait for your verification and activation for your ad.\n you can check your payment status form click OK Button otherwise cancel")){
       document.forms['form-id'].action='/admin/agencyclickhere_store/';
       document.forms['form-id'].submit();
       return true;
        
    }
    else{
        die();
    }
    }
</script>
<!-- begining of page level js -->
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/jquery.mockjax.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/bootstrap-editable.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/user_profile.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@endsection

