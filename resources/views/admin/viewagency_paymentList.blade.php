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
        <h1>Order Payment Listing</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="#">Order PaymentTID</a>
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
                                    <th>Order No</th>
                                     <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Transfer ID</th>
                                    <th>Status</th>
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
                                        <td><?php echo $user['order_no']; ?></td>
                                        <td><?php echo $user['featured_price']; ?></td> 
                                        <td>
                                            @foreach($paymentmenthod as $payment)
                                            @if(!empty($payment->method_name == $user['payment_option']))
                                            {{$payment->method_name }}<br><span style="font-size: 15px;">{!! $payment->description_acount !!}</span>
                                            @endif
                                            @endforeach
                                        </td>
                                        <td><?php echo $user['transferId']; ?></td>
                                        <td>
                                            @if($user['status'] == '1')
                                            <strong class="label label-success">Active</strong>
                                            @elseif($user['status'] == '0')
                                            <strong class="label label-warning">Pending For Verification</strong>
                                            @elseif($user['status'] == '2')
                                            <strong class="label label-danger">Rejected</strong>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/admin/agencyedit_paymentTID/{{ $user['agencypayementorder_id'] }}" ><i class="livicon" data-name="order-edit" data-size="25" data-loop="true" data-c="#428BCA" data-hc="#428BCA"  title="Order Edit" ></i></a>
                                          @if( Auth::user()->type == 'admin')
                                            <a href="/admin/agencypaymentTID_delete/{{ $user['agencypayementorder_id'] }}" ><i class="livicon" data-name="order-remove" data-size="25" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Order Remove"></i></a>
                                            
<!--                                            @if($user['status'] == '0')
                                            <a href="/admin/activate_paymentTID/{{ $user['payementorder_id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Activate</i></button></a>
                                            <a href="/admin/deactivate_paymentTID/{{ $user['payementorder_id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>

                                            @elseif($user['status'] == '1')
                                            <a href="/admin/deactivate_paymentTID/{{ $user['payementorder_id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                            @elseif($user['status'] == '2')
                                            <a href="/admin/activate_paymentTID/{{ $user['payementorder_id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Re-Active</i></button></a>
                                            @endif
                                            
                                            <a href="/admin/activate_paymentTID/{{ $user['payementorder_id'] }}" ><button class="label label-primary"> <i class="fa fa-thumbs-up">Activate</i></button></a>
                                            -->
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
<!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.tableTools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.colReorder.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.scroller.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/pages/table-advanced.js')}}"></script>
<!-- end of page level js -->
@endsection

