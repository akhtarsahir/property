@extends('admin/layouts/app')

<!--page level css -->

@section('pagecss')

<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.colReorder.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.scroller.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link href="{{asset('assets/css/pages/tables.css')}}" rel="stylesheet" type="text/css">

@endsection
<!--end of page level css-->

@section('content')

<?php
?>
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

                @if(session('Message'))
                {{session('Message')}}
                @endif
                @if(Session::has('Message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $message }}
                </div>
                @endif

                <div class="panel panel-success filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Re-order Columns
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>OrderNo</th>
                                    <th>PropertyID</th>
                                    <th>Title</th>
                                    <th>Order Category</th>
                                    <th>Payment Option</th>
                                    <th>Price</th>
                                    <!--<th>Specific City</th>-->
                                    <th>Status</th>
                                    @if( Auth::user()->type == 'admin')
                                    <!--<th>Feature</th>-->
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($Total_orders))
                                <?php
                                $count = 1;
                                foreach ($Total_orders as $user) {
                                    ?>

                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><?php echo $user['order_id']; ?></td>
                                        <td>justdeal<?php echo $user['property_id']; ?></td>
                                        <td><a href="/admin/property_detail/{{ $user['property_id'] }}" ><?php echo $user['property_title']; ?></a></td>
                                        <td>
                                            <?php
                                            if ($user['featured_category'] == '1') {
                                                echo 'Premium HomePage';
                                            } elseif ($user['featured_category'] == '2') {
                                                echo 'Feature HomePage';
                                            } elseif ($user['featured_category'] == '3') {
                                                echo 'Premium ListingPage';
                                            } else {
                                                echo 'Feature ListingPage';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                        @foreach($paymentmenthod as $payment)
                                            @if(!empty($payment->method_name == $user['payment_option']))
                                            {{$payment->method_name }}<br><span style="font-size: 15px;">{!! $payment->description_acount !!}</span>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td><?php echo $user['featured_price']; ?></td>
                                        <!--<td><?php echo $user['featured_city']; ?></td>-->
                                        <td>
                                            @if($user['status'] == '1')
                                            <a href="#"><strong class="label label-success">Active</strong></a>
                                            @elseif( $user['featured_expire'] <= date("Y-m-d"))
                                           <a href="#"> <strong class="label label-info">Expired</strong></a>
                                            @elseif($user['status'] == '0')
                                          <a href="#">  <strong class="label label-warning">Pending</strong></a>
                                            @elseif($user['status'] == '2')
                                           <a href="#"> <strong class="label label-danger">Rejected</strong></a>
                                            @endif
                                            <br><br>
                                             @if(!empty($user['payment_TID'] == '1'))
                                            <a href="/admin/single_paymentList/{{ $user['id'] }}" target="_blank"> <strong class="label label-success">Order Completed</strong></a>
                                            @elseif(!empty($user['payment_TID'] == '2'))
                                            <a href="/admin/single_paymentList/{{ $user['id'] }}" target="_blank"> <button class="btn btn-warning btn-xs" style="padding: 4px 0px 5px 0px;"><strong>Paid successfully!<br> Please Wait for Activation</strong></button></a>
                                            @elseif(!empty($user['payment_TID'] == '0'))
                                            <a href="/admin/single_paymentList/{{ $user['id'] }}" target="_blank">  <strong class="label label-danger">Your TransferID Rejected</strong></a>
                                            @else
                                            <a href="/admin/add_paymentTID/{{ $user['id'] }}" > <button class="btn btn-primary btn-xs" style="padding: 4px 0px 5px 0px;"><strong>Send Your Transection ID <br>from here for activation</strong></button></a>
                                            
                                            @endif
                                        </td>
                                        @if( Auth::user()->type == 'admin')
<!--                                        <td>
                                            <?php
                                            $property = DB::table('orders')
                                                    ->join('property', 'orders.property_id', '=', 'property.id')
                                                    ->where('orders.id', '=', $user['id'])
                                                    ->first();
                                            ?>
                                            @if($property->number == '1')
                                            <a href="/admin/unset_property/{{ $user['property_id'] }}" >
                                                <button class="label label-info" data-toggle="tooltip" data-placement="top" title="Remove Feature Property">
                                                    <i class="livicon" data-c="#000" data-hc="#000" data-name="heart" data-size="15" data-loop="true" >
                                                    <i>
                                                        Unset
                                                    </i>
                                                </button>
                                            </a>
                                            @else
                                            <a href="/admin/set_property/{{ $user['property_id'] }}" >
                                                <button class="label label-primary"  data-toggle="tooltip" data-placement="top" title="Add Feature Property">
                                                    <i >Set</i>
                                                </button>
                                            </a>
                                            @endif
                                        </td>-->
                                        @endif
                                        <td>
                                            <a href="/admin/edit_order/{{ $user['id'] }}" ><i class="livicon" data-name="order-edit" data-size="15" data-loop="true" data-c="#428BCA" data-hc="#428BCA"  title="Order Edit"data-toggle="tooltip" data-placement="bottom" ></i></a>
                                         @if( Auth::user()->type == 'admin')
                                            <a href="/admin/order_delete/{{ $user['id'] }}" ><i class="livicon" data-name="order-remove" data-size="15" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Order Remove"data-toggle="tooltip" data-placement="bottom"></i></a>
                                         @endif
                                         
                                            @if( Auth::user()->type == 'admin')
                                            @if(empty($user['payment_TID'] == '3'))
                                            @if($user['featured_expire'] >= date("Y-m-d"))
                                            @if($user['status'] == '0')
                                            @if($user['payment_TID'] == '2')
                                            <a href="/admin/activate_order/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Activate</i></button></a>
                                            <a href="/admin/deactivate_order/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                             @endif
                                            @elseif($user['status'] == '1')
                                            <a href="/admin/deactivate_order/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                            @elseif($user['status'] == '2')
                                            <a href="/admin/activate_order/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Re-Active</i></button></a>
                                            @endif
                                            @else
                                            <a href="/admin/activate_order/{{ $user['id'] }}" ><button class="label label-primary"> <i class="fa fa-thumbs-up">Activate</i></button></a>
                                            @endif
                                            @endif

                                            @endif
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- content -->
</aside>
<!-- right-side -->



@endsection

@section('pagejs')
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.tableTools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.colReorder.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.scroller.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/table-advanced.js')}}"></script>
<!-- end of page level js -->
@endsection
