@extends('admin/layouts/app')

@section('pagecss')
<!--page level css -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}" />
<link href="{{asset('assets/css/pages/tables.css')}}" rel="stylesheet" type="text/css" />
<!-- end of page level css -->
@endsection
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Inquire About Property</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                    Home
                </a>
            </li>
            <li class="active">Inquire About Property</li>
        </ol>
    </section>
    @if(Session::has('delete'))
    <div class="alert alert-danger">
        <p class="errors">{!! Session::get('delete') !!}</p>
    </div>
    @endif
    @if(Session::has('Block'))
    <div class="alert alert-danger">
        <p class="errors">{!! Session::get('Block') !!}</p>
    </div>
    @endif
    @if(Session::has('Success'))
    <div class="alert alert-success">
        <p class="errors">{!! Session::get('Success') !!}</p>
    </div>
    @endif
    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-default1 ">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        
                    </h4>
                    <hr>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                            <tr class="filters">
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Property Title</th>
                                <th>Reply</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Contact_us as $data)
                            <tr>
                                <td> {{$data->name}}</td>
                                <td> {{$data->phone}} </td>
                                <td> {{$data->email}} </td>
                                <td> {{$data->message}} </td>
                                <td> {{$data->title}} </td>
                                <td>
                                    <a href="https://accounts.google.com/"> <strong class="label label-primary"><i class="fa fa-reply">Reply</i></strong></a>
<!--                                    @if($data->status == '1')
                                    <strong class="label label-primary">Active</strong>
                                    @elseif($data->status == '2')
                                    <strong class="label label-info">Pending</strong>
                                    @elseif($data->status == '0')
                                    <strong class="label label-info">Rejected</strong>
                                    @endif
                                   -->
                                </td>
                                <td>{{$data->created_at}}</td>
                                
                                <td>
                                    
<!--                                    @if($data->status == '1')
                                    <a href="{{ url('admin/contactus_status/block').'/'.$data->id }}" > <button class="label label-info"><i class="fa fa-thumbs-down">Reject</i></button></a>
                                    @elseif($data->status == '2')
                                    <a href="{{ url('admin/contactus_status/unblock').'/'.$data->id }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Accept</i></button></a>
                                    @elseif($data->status == '0')
                                    <a href="{{ url('admin/contactus_status/unblock').'/'.$data->id }}" > <button class="label label-info"><i class="fa fa-thumbs-up">Re-Active</i></button></a>
                                    @endif-->
                                    <!--<a href="{{ URL::action('ContactuspropertyinfoController@contactus_reply', ['id' => $data]) }}" title="Reply"><button class="label label-primary"> <i class="fa fa-reply">Reply</i></button></a>-->
                                   <a href="/admin/destroy/{{ $data->cpid }}" > <button class="label label-danger"> <i class="fa fa-trash-o">Delete</i></button></a>
<!--                                    <a href="#" data-toggle="modal" data-target="#delete_confirm">
                                        <button class="label label-danger"> <i class="fa fa-trash-o">Delete</i></button>
                                    </a>-->
                                </td>
                            </tr>
                            <!-- Modal for showing delete confirmation -->
                        <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="user_delete_confirm_title">
                                            Status 
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete this Status? This operation is irreversible.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                                        <a href="/admin/destroy/{{ $data->cpid }}" type="button" class="btn btn-danger" >Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </tbody>
                    </table>

                </div>
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