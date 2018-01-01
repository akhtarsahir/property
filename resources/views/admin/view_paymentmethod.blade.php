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
               <div class="col-lg-12">
                    <a href="{{ url('admin/add_paymentMethod') }}" >
                        <button class="btn btn-primary btn-lg pull-right" >
                            Add Payment Method
                        </button>
                    </a>
                </div>
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
                                    <th>Sr#</th>
                                    <th>Payment Method</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($paymentmethod))
                                <?php
                                $count = 1;
                                foreach ($paymentmethod as $user) {
                                    ?>

                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><?php echo $user['method_name']; ?></td>
                                        <td><?php echo $user['description_acount']; ?></td>
                                        <td>
                                            <a href="/admin/edit_paymentMethod/{{ $user['id'] }}" ><i class="livicon" data-name="order-edit" data-size="25" data-loop="true" data-c="#428BCA" data-hc="#428BCA"  title="Payment Method Edit"data-toggle="tooltip" data-placement="bottom" ></i></a>  
                                            <a href="/admin/paymentMethod_delete/{{ $user['id'] }}" ><i class="livicon" data-name="order-remove" data-size="25" data-loop="true" data-c="#f56954" data-hc="#f56954" title="PaymentMethod Remove"data-toggle="tooltip" data-placement="bottom"></i></a>
                                         
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
