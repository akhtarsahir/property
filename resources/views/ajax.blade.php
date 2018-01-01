@extends('admin/layouts/app')
@section('content')
<!--page level css -->
<?Php $edit = DB::table('citysubaddress')->first();
$data = DB::table('city')->get(); ?>
<!--end of page level css-->
<aside class="right-side">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!--section starts-->
        <h1>Edit Cities Sub Address</h1>
        <ol class="breadcrumb">
            <li>
                <a href="dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Home   <?php $rtno = 60  .str_pad( 0, 3, "0", STR_PAD_LEFT); echo $rtno; ?>
                </a>
            </li>
            <li>
                <a href="{{ url('city/create') }}">Edit Cities Sub Address</a>
            </li>

        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                            Please Fill Below Form
                        </h3>
                        <span class="pull-right">
                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                            <i class="fa fa-fw fa-times removepanel clickable"></i>
                        </span>
                    </div>
                    <div class="panel-body">

                        <form action="{{ url('admin/updatesubcity' , $edit->id) }}" method="post"  class="form-horizontal">
                            {!! csrf_field() !!}
                              <div class="col-sm-6">
                                <div class="form-group">
                                    <label > City </label>
                                    <div class="@if($errors->first('cityname')) has-error @endif">
                                        <label class="control-label" for="inputError"><?php echo $errors->first('cityname');?></label>
                                        <!--<input type="text" class="form-control"   name="citysubaddress" value="" placeholder="Enter address" required>-->
                                        <select  class="selectpicker form-control" name="city" id="city"  data-live-search="false" dat-live-search-style="begins" title="Select" required>
                                            <!--<option value="1">1</option>-->
                                            @foreach($data as $city)
                                            
                                            <option class="{{ $city->latitude }},{{ $city->longitude }}" value="{{ $city->id }}">{{ $city->name }}</option>
                                           
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label > City sub adress Name </label>
                                    <div class="@if($errors->first('cityname')) has-error @endif">
                                        <label class="control-label" for="inputError"><?php echo $errors->first('cityname');?></label>
                                       
                                            <?php $datas = DB::table('citysubaddress')->where('city_id',$edit->id)->get(); 
//                                           echo $datas;
                                           ?>
                                        <select  class="selectpicker form-control subcityaddress hide" name="subaddress" id="subaddress"  data-live-search="false" dat-live-search-style="begins" title="Select" required>
                                            @foreach($datas as $city)
                                            <option class="{{ $city->latitude }},{{ $city->longitude }}" value="{{ $city->cityname }}">{{ $city->citysubaddress }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <button class="btn-success btn">Update Address</button>
                                    <button type="reset" class="btn-info btn">Reset</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- content -->
</aside>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
  $( document ).ready(function() {
$('#city').change(function(){
//        var task_id =   $('#city :selected').text();
         var task_id = $(this).val();
         alert('city name' + task_id);        
      var data = {};
data.param1 = words[0];

$.ajax({
    data: JSON.stringify(data),
    dataType: 'application/json',
    url: url + '{{ url("/datasend/ajax")}}',
    type: 'POST',
    contentType: 'application/json; charset=utf-8',
    success: function (result) {
        alert(result);
    },
    failure: function (errMsg) {
        alert(errMsg);
    }
});
                $('.subcityaddress').removeClass("hide");
                 $("#subaddress").val();
  });
  });

  
</script>

@endsection
