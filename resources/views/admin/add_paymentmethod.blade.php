@extends('admin/layouts/app')

@section('pagecss')
<!--page level css -->
<link href="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css')}}"  rel="stylesheet" media="screen"/>
<link href="{{asset('assets/css/pages/editor.css')}}" rel="stylesheet" type="text/css"/>
<!--end of page level css-->
@endsection

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Set Your Payment Method</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home
                </a>
            </li>
            <li class="active">Add Payment Method</li>
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
                <div class="panel-heading">Add</div>
                <div class="panel-body">
                    <form action="/admin/paymentmethodstore/" method="post" enctype="multipart/form-data" name="myform">
                        {!! csrf_field() !!}
                        <input id="id" type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Payment Method</label>
                            </div>
<!--                            <div class="col-md-3">
                                <select class="form-control" name="method_name">
                                    <option value="Bank">Bank</option>
                                    <option value="JazzCash">JazzCash</option>
                                    <option value="EasyPaisa">Easy Paisa</option>
                                </select>
                                @if($errors->first('type'))
                                <label class="error text-danger" for="method_name">*{{ $errors->first('method_name') }}</label>
                                @endif
                            </div>-->
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="" name="method_name" >
                            </div>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-3">
                                <label class="control-label">Bank Account Description</label>
                            </div>
                            <div class="col-md-9">
                                    <div class="form-group">
                                        <div class='box well well-sm' >
                                            <div class='box-header'>
                                                <!-- tools box -->
                                                <div class="pull-right box-tools"></div>
                                                <!-- /. tools --> </div>
                                            <!-- /.box-header -->
                                            <div class='box-body pad'>
                                                <textarea class="textarea editor-cls form-control" placeholder="Place some text here" value=""rows="10" id="description_acount" name="description_acount" ></textarea>
                                            </div>
                                        </div>
                                        <!--<textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter your property Description" required></textarea>-->
                                        <label class=" alert-danger hide" id="description_error"> Please Enter Description of Property </label>
                                    </div>
                                
                                <!--<textarea type="text" class="form-control" value="" name="description_acount" ></textarea>-->
                            </div>
                        </div>
                        <br><br>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-success">
                                    <i class="glyphicon glyphicon-file"></i> Save Payment Method
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </section>
</aside>


@endsection

@section('pagejs')
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{asset('assets/vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/vendors/ckeditor/adapters/jquery.js')}}" type="text/javascript" ></script>
<script  src="{{asset('assets/vendors/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript" ></script>
<script  src="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js')}}" type="text/javascript"></script>
<script  src="{{asset('assets/js/pages/editor.js')}}" type="text/javascript"></script>
<!-- end of page level js -->
@endsection

