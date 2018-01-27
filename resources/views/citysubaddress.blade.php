@extends('layouts.app')
@section('pagecss')
<style>
      #scroll {
   height: 300px;
   overflow-y: scroll;
 }
</style>
@endsection
@section('content')
<!--start section page body-->
<section id="section-body">

    <!--start detail content-->
    <section class="section-detail-content">
        <div class="container">
             <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-center">
                            <div class="col-sm-6 col-sm-offset-4">

                            </div></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="detail-bar">
                        <div class="detail-features detail-block" id="scroll">
                            <div class="detail-title">
                                <h2 class="title-left">All Address Of {{$name}}</h2>
                            </div>
                            <ul class="list-four-col list-features">
                                @foreach($duplicates as $duplicates)
                                <?php
//                                $duplicates = DB::table('property')
//    ->select('address', 'city')
//    ->where('address', $duplicates->address,DB::raw('COUNT(*) as `count`'))
//    ->groupBy('address', 'city')
//    ->havingRaw('COUNT(*) > 1')
//    ->get();
//    echo $duplicates;exit();
                                $query = DB::table('property')->where('address', $duplicates->address)->where('city', $duplicates->city)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->count();
// $id = DB::table('property')->where('city', $name)->where('address', $data->address)->groupBy('address')->count(); echo $id;
                                ?>
                                <li><a href="http://justdeal.pk/addresscityname/{{$duplicates->address }}"><i class="fa fa-check"></i>{!! str_limit("$duplicates->address", 22) !!}({{$query}})</a></li>
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
<script>
    $(function() {
  var wtf    = $('#scroll');
  var height = wtf[0].scrollHeight;
  wtf.scrollTop(height);
});
</script>
@endsection