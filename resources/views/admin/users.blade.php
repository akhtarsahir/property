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
        <h1>Users </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Users</li>
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
                        Users List
                    </h4>
                </div>
                <br />
                <div class="col-md-12">
                    <a href="/admin/adduser">
                        <input type="button" class="btn btn-primary pull-right" value="Add User">
                    </a>
                </div>
                <br />
                <br />

                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                            <tr class="filters">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>
                                    User E-mail
                                </th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_data as $data)
                            <tr>
                                <td>{{$data->first_name}}</td>
                                <td>{{$data->last_name}}</td>
                                <td>{{$data->email}}</td>
                                <td>
                                <i <?php
                                if ($data->status == 1) {
                                    echo 'class="fa fa-circle green"';
                                } else {
                                    echo 'class="fa fa-circle red"';
                                }
                                ?> > </i>
                                </td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    <a href="{{ URL::action('UserController@view_user_detail', ['id' => $data]) }}">
                                        <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#delete_confirm">
                                        <i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal for showing delete confirmation -->
                            <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="user_delete_confirm_title">
                                                Delete User
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete this user? This operation is irreversible.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <!--<a href="{{ URL::action('UserController@delete_user', ['id' => $data]) }}" type="button" class="btn btn-danger">Delete</a>-->
                                            <a href="{{url('admin/mark_user/block').'/'.$data->id}}" type="button" class="btn btn-danger" >Block</a>
                                        <!--<a href="{{url('mark_user/unblock').'/'.$data->id}}" type="button" class="btn btn-danger">Approve</a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
        <!-- row--> </section>
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