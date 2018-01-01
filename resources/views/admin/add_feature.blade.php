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
        <h1>Set Your Featured</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li class="active">Add Property Featured</li>
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
                <div class="panel-heading">Featured Adds</div>
                <div class="panel-body">
                    <form action="/admin/OrderStore/" method="post" enctype="multipart/form-data" name="myform">
                        {!! csrf_field() !!}
                        <input id="id" type="hidden" name="id" value="{{ Auth::user()->id }}">
                        @foreach($property as $pro)
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Order No</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control" value="{{$order}}" name="order_id" >
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Adds Id</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control" value="{{$pro->id}}" name="property_id" >
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Title</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" readonly class="form-control" value="{{$pro->title}}" name="property_title" >
                            </div>
                        </div>
                        
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Feature Category</label>
                            </div>
                            <div class="col-md-3">
                                <label for="featured_category">
                                    <input type="radio" id="featured_category" name="featured_category" value="1" onblur = "Multiple(this)" >Premium HomePage</label>
                                <label for="example-radio2">
                                    <input type="radio" id="featured_category" name="featured_category" value="2" onblur = "Multiple(this)" >Feature HomePage</label>
                               </div>
                            <div class="col-md-3">
                                <label for="featured_category">
                                    <input type="radio" id="featured_category" name="featured_category" value="3" onblur = "Multiple(this)" >Premium ListingPage</label>
                               <label for="example-radio2">
                                    <input type="radio" id="featured_category" name="featured_category" value="4" onblur = "Multiple(this)" >Feature ListingPage</label>

                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="featured_expire">Expiry Date</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="featured_expire" onblur = "Multiple(this)">
                                    <option value="1">One Month</option>
                                    <option value="2">Two  Month</option>
                                </select>
                                @if($errors->first('type'))
                                <label class="error text-danger" for="featured_expire">*{{ $errors->first('featured_expire') }}</label>
                                @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="featured_price">Price</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" readonly class="form-control" value="" name="featured_price" >
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label for="featured_city">Specific City</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" title="Select an Agent City..."  selected="{{$pro->city}}" name="featured_city" id="featured_city">
                                    <option value="All Pakistan">All Pakistan</option>
                                    @foreach($cities as $city)
                                    <option @if($pro->city == $city->name) selected @endif value="{{ $city->name  }}">{{ $city->name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Payment Option</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" title="Select an payment_option..."  selected="slect" name="payment_option" id="payment_option">
                                    <option value="">Select</option>
                                    @foreach($PaymentMethod as $Payment)
                                    <option  value="{{ $Payment->method_name  }}">{{ $Payment->method_name }}</option>
                                    @endforeach
                                </select>
<!--                                <div class="radio mar-left5">
                                    <label for="payment_option">
                                        <input type="radio" id="example-radio1" name="payment_option" value="banktransection">Bank Transection</label>
                                    <br> <label for="example-radio2">
                                        <input type="radio" id="example-radio2" name="payment_option" value="jazzcash">jazz cash</label>
                                </div>-->
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-file"></i> Save Featured
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
<script type="text/javascript">
    function Multiple(which) {

        var x = parseFloat(which.value);
        if (isNaN(x)) {
            alert("Remember - only integer or decimal numbers are allowed!");
            which.value = "";
            return false;
        }
        if (x < 1) {
            alert("Please Enter a Valid Amount");
            which.value = "";
            return false;
        }
        var a = document.myform.featured_category.value;
//         alert("Feature category: " + a)
       <?php foreach($pricefeatured as $price){?>
        if (a == 1) {
            
            a = <?php echo $price['premium_homepageprice']; ?>
        }
        else if (a == 2) {
            a = <?php echo $price['featured_homepageprice']; ?> 
        }
        else if (a == 3) {
            a = <?php echo $price['premium_listpageprice']; ?>
        }
        else if (a == 4) {
            a = <?php echo $price['featured_listpageprice']; ?>
       }
       <?php } ?>
//         alert("Feature category: " + a)
        var b = document.myform.featured_expire.value;
//         alert("feature date : " + b)
        document.myform.featured_price.value = (a * b).toFixed(2);
//        var date_array =  document.myform.featured_price.value = (a * b).toFixed(2);
//            alert("Sale amount: " + date_array)

    }</script>
<!-- begining of page level js -->
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{asset('vendors/jasny-bootstrap/js/jasny-bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/jquery.mockjax.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/x-editable/bootstrap-editable.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pages/user_profile.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@endsection

