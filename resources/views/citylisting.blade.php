@extends('layouts.app')
@section('pagecss')
@endsection
@section('content')
    <!--start section page body-->
    <section id="section-body">

        <!--start detail content-->
        <section class="section-detail-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="detail-bar">
                            <div class="detail-features detail-block">
                                <div class="detail-title">
                                    <h2 class="title-left">All City</h2>
                                </div>
                                <ul class="list-three-col list-features">
                                    @foreach($data as $data)
                                    <?php
                                    $query = DB::table('property')->where('city',$data->name )->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->count();
                                   ?>
                                    <li><a href="citysubaddress/{{$data->name}}"><i class="fa fa-check"></i>{{$data->name}}({{$query}})</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </section>
        <!--end detail content-->

    </section>
    <!--end section page body-->
    @endsection

@section('pagejs')
  @endsection