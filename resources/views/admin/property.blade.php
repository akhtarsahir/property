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
$center = DB::table('offers')->where('show', 'center')->first();
$right = DB::table('offers')->where('show', 'right')->first();
$left = DB::table('offers')->where('show', 'left')->first();
?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>All Property Listing</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="livicon" data-name="home" data-size="18" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/property') }}">Property</a>
            </li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">

        <!-- row-->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert  alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <img src="<?php echo url('public/offerImages/300x200_') ?>{{$right->image}}" width="300" height="100">
                    <img src="<?php echo url('public/offerImages/300x200_') ?>{{$center->image}}" width="300" height="100">
                    <img src="<?php echo url('public/offerImages/300x200_') ?>{{$left->image}}" width="300" height="100">
                </div>
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
                <div class="col-md-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p class="errors">{!! Session::get('success') !!} <a href="{{ url('admin/view_user') }}">Visit your profile</a></p>
                    </div>
                    @endif
                    @if(Session::has('success1'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p class="errors">{!! Session::get('success1') !!}</p>
                    </div>
                    @endif
                </div>
                <div class="panel panel-success filterable" style="overflow:auto;">
                    <div class="panel-heading">
                        <a href="{{ url('/add_property') }}" style="margin-top: -8px;"class="btn btn-primary btn-md pull-right" >
                            Add Free Property
                        </a>
                        <h3 class="panel-title">
                            <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Property Data
                        </h3>

                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered" id="table2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Purpose</th>
                                    <th>Type</th>
                                    <th>City</th>
                                    <th>Expireed at</th>
                                    <!--<th>Detail</th>-->
                                    <th>status</th>
                                    <th>Feature</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    @if( Auth::user()->type == 'admin')
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($properties))
                                <?php
                                $count = 1;
                                foreach ($properties as $user) {
                                    ?>

                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><a href="/admin/property_detail/{{ $user['id'] }}" ><?php echo $user['title']; ?></a></td>
                                        <td><?php echo $user['purpose']; ?></td>
                                        <td><?php echo $user['type']; ?></td>
                                        <td><?php echo $user['city']; ?></td>
                                        <td><?php echo $user['propertexpire']; ?></td>

            <!--                                        <td>
                                                        <a href="/admin/property_detail/{{ $user['id'] }}" ><button class="label label-success"> <i class="fa fa-edit">View Deatil</i></button></a>

                                                    </td>-->

                                        <td>
                                            @if($user['status'] == '1')
                                            <strong class="label label-primary">Active free listing</strong>
                                            @elseif( $user['propertexpire'] <= date("Y-m-d"))
                                            <strong class="label label-info">Expired</strong>
                                            @elseif($user['status'] == '0')
                                            <strong class="label label-info">Pending</strong>
                                            @elseif($user['status'] == '2')
                                            <strong class="label label-info">Rejected</strong>
                                            @endif
                                        </td>

                                        <td>
                                            <!--                                            @if($user['number'] == '1')
                                                                                            <a href="/admin/unset_property/{{ $user['id'] }}" >
                                                                                                <button class="label label-info">
                                                                                                    <i class="livicon" data-c="#000" data-hc="#000" data-name="heart" data-size="15" data-loop="true" >
                                                                                                        Unset
                                                                                                    </i>
                                                                                                </button>
                                                                                            </a>
                                                                                        @else
                                                                                            <a href="/admin/set_property/{{ $user['id'] }}" >
                                                                                                <button class="label label-primary">
                                                                                                    <i class="livicon" data-name="heart" data-c="#ff0000" data-hc="#ff0000" data-size="15" data-loop="true" >Set</i>
                                                                                                </button>
                                                                                            </a>
                                                                                        @endif-->
                                            @if($user['number'] == '0')
                                            <a href="/admin/add_OrderFeature/{{ $user['id'] }}" ><button class="label label-primary"><i  class="fa fa-edit">Set your Feature</i></button></a>
                                            @else
                                            @if(!empty($user['featured_category'] == '1'))
                                            <a href="/admin/Orders_List/" ><button class="label label-success"><i >Premium Ad On Home</i></button></a>
                                            @elseif(!empty($user['featured_category'] == '2'))
                                            <a href="/admin/Orders_List/" ><button class="label label-success"><i >Feature Ad On Home</i></button></a>
                                            @elseif(!empty($user['featured_category'] == '3'))
                                            <a href="/admin/Orders_List/" ><button class="label label-success"><i >Premium Ad On Listing</i></button></a>
                                            @elseif(!empty($user['featured_category'] == '4'))
                                            <a href="/admin/Orders_List/" ><button class="label label-success"><i >Feature Ad On Listing</i></button></a>
                                            @elseif(!empty($user['featured_category'] == '5'))
                                            <a href="/admin/Orders_List/" ><button class="label label-warning"><i >Please wait For<br>Your Activation</i></button></a>
                                            @else
                                            <a href="/admin/add_OrderFeature/{{ $user['id'] }}" ><button class="label label-primary"><i  class="fa fa-edit">Set your Feature</i></button></a>
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/admin/edit_property/{{ $user['id'] }}" ><button class="label label-primary"> <i class="fa fa-edit">Edit</i></button></a>
                                        </td>
                                        <td>
                                            <a href="/admin/p_delete/{{ $user['id'] }}" ><button class="label label-danger"> <i class="fa fa-trash-o">Delete</i></button></a>
                                        </td>
                                        @if( Auth::user()->type == 'admin')
                                        <td>
                                            @if($user['propertexpire'] >= date("Y-m-d"))
                                            @if($user['status'] == '0')
                                            <a href="/admin/activate_property/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Activate</i></button></a>
                                            <a href="/admin/deactivate_property/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>

                                            @elseif($user['status'] == '1')
                                            <a href="/admin/deactivate_property/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                            @elseif($user['status'] == '2')
                                            <a href="/admin/activate_property/{{ $user['id'] }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Re-Active</i></button></a>
                                            @endif
                                            @else
                                            <a href="/admin/edit_property/{{ $user['id'] }}" ><button class="label label-primary"> <i class="fa fa-thumbs-up">Activate</i></button></a>
                                            @endif
                                        </td>
                                        @endif

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
