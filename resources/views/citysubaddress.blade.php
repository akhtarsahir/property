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
                                    <h2 class="title-left">All Address Of {{$name}}</h2>
                                </div>
                                <ul class="list-three-col list-features">
                                    @foreach($duplicates as $duplicates)
                                <?php 
//                                $duplicates = DB::table('property')
//    ->select('address', 'city')
//    ->where('address', $duplicates->address,DB::raw('COUNT(*) as `count`'))
//    ->groupBy('address', 'city')
//    ->havingRaw('COUNT(*) > 1')
//    ->get();
//    echo $duplicates;exit();
$query = DB::table('property')->where('address',$duplicates->address )->where('city', $name)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->groupBy('address')->count();
// $id = DB::table('property')->where('city', $name)->where('address', $data->address)->groupBy('address')->count(); echo $id;?>
                                    <li><a href="/addresscityname/{{ preg_replace('/\.\s|[^a-zA-Z\.\-0-9]+/', '-', $duplicates->address)  }}"><i class="fa fa-check"></i>{!! str_limit("$duplicates->address", 25) !!}{{$duplicates->count}}</a></li>
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