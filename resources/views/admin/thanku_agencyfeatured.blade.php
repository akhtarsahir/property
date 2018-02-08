@extends('admin/layouts/app')

<!--page level css -->

@section('pagecss')

@endsection
<!--end of page level css-->

@section('content')

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Order Feature Listing</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Order Feature</a>
            </li>
        </ol>
    </section>
    <!--section ends-->

    <section class="content">

        <!-- row-->
        <div class="row">

            {{--{{ dd($UserName) }}--}}

            <div class="col-lg-12">
                <div class="jumbotron text-center">
                    
                    <h1 class="display-3">ThankYou For Your Order!</h1>
                    <p class="lead">Please deposit your due amount according the following details:</p>
                    <hr>
                    <p class="text-left">&nbsp; &nbsp; &nbsp; Order No: {{$last_order->order_no}} <br>&nbsp; &nbsp; &nbsp; Selected Category:@if($last_order->featured_category == '1' )
                                            Premium HomePage
                                            @elseif($last_order->featured_category  == '2')
                                                Feature HomePage
                                                @elseif($last_order->featured_category  == '3')
                                                    Premium ListingPage
                                                    @else Feature ListingPage
                                                    @endif
                                                <br>&nbsp; &nbsp; &nbsp; Due amount:  Rs.{{$last_order->featured_price}} </p>
                     <div class="text-left">
                         @foreach($paymentmenthod as $payment)
                          @if(!empty($payment->method_name == $last_order->payment_option))
                         <p class="lead text-left">&nbsp; &nbsp;&nbsp; &nbsp;For {{$payment->method_name }} Detail<br>{!! $payment->description_acount !!}</p>
                           @endif
                         @endforeach
                     </div>
                    <p>After completion your payment process please verify from here or Order page:<br>&nbsp; &nbsp;&nbsp; &nbsp;<a class="btn btn-primary btn-sm" href="/admin/add_agencypaymentTID/{{ $last_order->id }}" role="button">Verify Your Payment</a></p>
                </div>    
            </div>
        </div>



    </section>
    <!-- content -->
</aside>
<!-- right-side -->



@endsection

@section('pagejs')

@endsection
