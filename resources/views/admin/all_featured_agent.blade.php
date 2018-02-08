@extends('admin/layouts/app')

@section('pagecss')
<!--page level css -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link href="{{asset('assets/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />
<!-- end of page level css -->
<a href="users.blade.php"></a>
@endsection

<style type="text/css">
    .red{
        color: red;
    }
    .green{
        color: green;
    }
</style>
@section('content')

<?php
//dd($data)
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Featured Agents </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Agents</li>
        </ol>
    </section>
    @if(Session::has('delete'))
    <div class="alert alert-danger">
        <p class="errors">{!! Session::get('delete') !!}</p>
    </div>
    @endif
    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Agents List
                    </h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                            <tr class="filters">
                                <th>Agency Name</th>
                                <th>Agency Number</th>
                                <th>OrderNo</th>
                                <th>Price</th>
                                <th>City</th>
                                <th>Featured Agent</th>
                                <th>Logo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $data)
                            <tr>
                                <td>{{$data->DisplayName}}</td>
                                <td>@if(!empty($data->company_phone))1: {{$data->company_phone}}@endif<br>@if(!empty($data->company_phone))2: {{$data->company_mobileNo}}@endif</td>
                                <td>{{$data->order_no}}</td>
                                <td>{{$data->featured_price}}</td>
                                <td>{{$data->city}}</td>
                                <td>        @if($data->feature_status == '1')
                                    <a href="#"><strong class="label label-success">Active</strong></a>
                                    @elseif($data->feature_status == '2')
                                    <a href="#"> <strong class="label label-danger">Rejected</strong></a>
                                    @endif
                                    <br><br>
                                    @if(!empty($data->payment_TID == '1'))
                                    <a href="/admin/agencysingle_paymentList/{{ $data->id }}" target="_blank"> <strong class="label label-success">Order Completed</strong></a>
                                    @elseif(!empty($data->payment_TID == '2'))
                                    <a href="/admin/agencysingle_paymentList/{{ $data->id }}" target="_blank"> <button class="btn btn-warning btn-xs" style="padding: 4px 0px 5px 0px;"><strong>Paid successfully!<br> Please Wait for Activation</strong></button></a>
                                    @elseif(!empty($data->payment_TID == '0'))
                                    <a href="/admin/agencysingle_paymentList/{{  $data->id }}" target="_blank">  <strong class="label label-danger">Your TransferID Rejected</strong></a>
                                    @else
                                    <a href="/admin/add_agencypaymentTID/{{  $data->id }}" > <button class="btn btn-primary btn-xs" style="padding: 4px 0px 5px 0px;"><strong>Send Your Transection ID <br>from here for activation</strong></button></a>
                                    @endif
                                </td>
                                <td><img src="<?php echo url('ProfileImage') ?>/239x239_{{$data->image}}" width="50" height="50"></td>
                                <td>
                                    <a href="/admin/agencyedit_order/{{ $data->id }}" ><i class="livicon" data-name="order-edit" data-size="20" data-loop="true" data-c="#428BCA" data-hc="#428BCA"  title="Order Edit"data-toggle="tooltip" data-placement="bottom" ></i></a>
                                    @if( Auth::user()->type == 'admin')
                                    <a href="/admin/agencyorder_delete/{{ $data->id }}" ><i class="livicon" data-name="order-remove" data-size="20" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Order Remove"data-toggle="tooltip" data-placement="bottom"></i></a>
                                    @endif
                                    <br>
                                    @if( Auth::user()->type == 'admin')
                                    @if($data->feature_status == '1')
                                    <a href="{{ route('rejectfeature_agent', ['id' => $data->user_id ]) }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                    @elseif($data->feature_status == '2')
                                    <a href="{{ route('addfeature_agent', ['id' => $data->user_id ]) }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Re-Active</i></button></a>
                                    @else
                                    <a href="{{ route('addfeature_agent', ['id' => $data->user_id ]) }}" ><button class="label label-primary"> <i class="fa fa-thumbs-up">Activate</i></button></a>
                                    @endif
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- row--> 
        </div>
    </section>
</aside>
@endsection

@section('pagejs')
<!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/dataTables.bootstrap.js')}}"></script>
<script>
$(document).ready(function () {
    $('#table').dataTable();
});
</script>
<!-- end of page level js -->
@endsection