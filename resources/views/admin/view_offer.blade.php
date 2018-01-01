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
        <h1>All Banner offers</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
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

        <!-- row-->
        <div class="row">

            {{--{{ dd($UserName) }}--}}

            <div class="col-lg-12">

                @if(Session::has('Message'))
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p class="errors">{!! Session::get('Message') !!}</p>
                </div>
                @endif
                @if(Session::has('delete'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p class="errors">{!! Session::get('delete') !!}</p>
                </div>
                @endif

                <div class="panel panel-success filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Re-order Columns
                        </h3>
                    </div><br>
                    <div class="col-md-12">
                        <a href="{{ url('admin/bannerOffer') }}">
                            <input type="button" class="btn btn-primary btn-lg pull-right" value="Add Offer">
                        </a>
                    </div>
                    <br><br>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Banner Show</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                <?php
                                $count = 1;
                                foreach ($data as $user) {
                                    ?>
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td> <img src="<?php echo url('public/offerImages/300x200_') ?>{{$user['image']}}" width="245" height="71"></td>
                                        <td><a href="{{ $user['link'] }}" ><?php echo $user['link']; ?></a></td>
                                        <td><?php echo $user['show']; ?></td>
                                        <td>
                                            <a href="/admin/edit_offer/{{ $user['id'] }}" ><i class="livicon" data-name="order-edit" data-size="15" data-loop="true" data-c="#428BCA" data-hc="#428BCA"  title="Order Edit"data-toggle="tooltip" data-placement="bottom" ></i></a>
                                            <a href="/admin/delete_offer/{{ $user['id'] }}" ><i class="livicon" data-name="order-remove" data-size="15" data-loop="true" data-c="#f56954" data-hc="#f56954" title="Order Remove"data-toggle="tooltip" data-placement="bottom"></i></a>
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
