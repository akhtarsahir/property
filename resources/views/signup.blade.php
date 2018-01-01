@extends('layouts.app')
@section('content')
<style>
    .hide{ display:none;}
    .outline{
        border-color: rgba(64,79,239,0.8);
        box-shadow: 0 1px 1px rgba(0,0,0,0.03) inset, 0 0 8px rgba(123,137,239,0.6);
        outline: 0 none;
    }
    .font-color{ color:white;}
    .add-title-tab {
        background-color: #7ca1f9;
    }
    .bold-class{ font-weight: bold;}

    // multiple images
    .entry:not(:first-of-type)
    {
        margin-top: 10px;
    }

    .glyphicon
    {
        font-size: 12px;
    }

</style>
<div class="row"> </div>
<div class="container">
    <div class="account-block">
        <div class="add-title-tab">
            <h3>Create Your Account</h3>
        </div>
        <form action="/SignupForm" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="add-tab-content">
                <div class="add-tab-row  push-padding-bottom">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="BusinessType" class="bold-class">Register As</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="selectpicker" id="BusinessType" name="BusinessType"  selected="{{old('BusinessType')}}">
                                    <label><input type="radio" id="BusinessType" name="BusinessType" @if(old('BusinessType') == 1) selected @endif value="1"> Individual</label>
                                    &nbsp; <label><input type="radio" id="BusinessType" name="BusinessType" @if(old('BusinessType') == 2) selected @endif value="2"> Real Estate or Business</label>
                                    @if($errors->first('BusinessType'))
                                    <label class="error text-danger" for="BusinessType">*{{ $errors->first('BusinessType') }}</label>
                                    @endif
                                </div>
                            </div>
                            <!--                                                        <div class="col-sm-4">
                                                                                        <div class="form-group">
                                                                                            <select class="selectpicker" id="BusinessType" name="BusinessType"  selected="{{old('BusinessType')}}"  data-live-search="false" data-live-search-style="begins" title="Register As">
                                                                                                <option @if(old('BusinessType') == 1) selected @endif value="1">Individual</option>
                                                                                                <option @if(old('BusinessType') == 2) selected @endif value="2">Real Estate or Business</option>
                                                                                            </select>
                                                                                            @if($errors->first('BusinessType'))
                                                                                            <label class="error text-danger" for="BusinessType">*{{ $errors->first('BusinessType') }}</label>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>-->
                        </div>
                    </div>  <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="FirstName" class="bold-class">First Name*</label>
                            </div>       
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" name="FirstName" value="{{old('FirstName')}}" id="FirstName"  placeholder="Enter your First Name">
                                    @if($errors->first('FirstName'))
                                    <label class="error text-danger" for="FirstName">*{{ $errors->first('FirstName') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="lastname" class="bold-class">Last Name *</label>
                            </div> 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control"  name="lastname" value="{{ old('lastname') }}"id="lastname"  placeholder="Enter your Last Name">
                                    @if($errors->first('lastname'))
                                    <label class="error text-danger" for="FirstName">*{{ $errors->first('lastname') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hide RealBusiness">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="company_name" class="bold-class">Name Of Business *</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" name="company_name" value="{{old('company_name')}}" id="company_name"  placeholder="Enter your Name Of Business">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="address" class="bold-class">Address/Location*</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <input class="form-control" name="address" value="{{old('address')}}" id="address"  placeholder="Enter your address">
                                    @if($errors->first('address'))
                                    <label class="error text-danger" for="address">*{{ $errors->first('address') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="CityName" class="bold-class">City Name</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="selectpicker" selected="{{old('CityName')}}" name="CityName" id="CityName"  data-live-search="false" data-live-search-style="begins" title="City Name">
                                        @foreach($cities as $city)
                                        <option @if(old('CityName') == $city->name) selected @endif value="{{ $city->name  }}">{{ $city->name  }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('CityName'))
                                    <label class="error text-danger" for="CityName">*{{ $errors->first('CityName') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row hide RealBusiness" >-->
                    <div class="row hide " style="display: none">
                        <div class="col-sm-12">
                            <div class="col-sm-2" style="width: 18.667%;">
                                <label for="domainName" class="bold-class">Domain Name Of WebSite*</label>
                            </div>
                            <div class="col-sm-4" style="margin-left: -2%;">
                                <div class="form-group">
                                    <input class="form-control" id="DomainName" name="domainName" value="{{old('domainName')}}" placeholder='Domain name like Example: "justdeal"'>
                                    @if($errors->first('DomainName'))
                                    <label class="error text-danger" for="domainName">*{{ $errors->first('domainName') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 hide " style="display: none" >
                        <div class="form-group">
                            <label for="AgencyName">Agency Name *</label>
                            <input class="form-control" id="AgencyName" name="AgencyName" value="{{old('AgencyName')}}"  placeholder="Enter yourAgency Name">
                            @if($errors->first('AgencyName'))
                            <label class="error text-danger" for="FirstName">*{{ $errors->first('AgencyName') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="emailAddress" class="bold-class">Email Address</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="emailAddress"  value="{{ old('emailAddress') }}" id="emailAddress" placeholder="Enter your Email Address">
                                </div>
                                @if($errors->first('emailAddress'))
                                <label class="error text-danger" for="FirstName">*{{ $errors->first('emailAddress') }}</label>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                <label for="CityName" class="bold-class Individual">Profile Image</label>
                                <label for="CityName" class="bold-class hide RealBusiness">Logo/Upload</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}"  placeholder="Choose Your Image">
                                    @if($errors->first('image'))
                                    <label class="error text-danger" for="image">*{{ $errors->first('image') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="ConatctNumber" class="bold-class Individual">Contact Number</label>
                                <label for="ConatctNumber" class="bold-class hide RealBusiness">Business Contact No</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" type="text" id="ConatctNumber"  name="ConatctNumber" value="{{old('ConatctNumber')}}" placeholder="Enter your LandLine Number">
                                    @if($errors->first('ConatctNumber'))
                                    <label class="error text-danger" for="FirstName">*{{ $errors->first('ConatctNumber') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="description">Short Description</label>
                                                    <textarea class="form-control"  name="description"  id="description" placeholder="Enter your Short Description" >{{old('description')}}</textarea>
                                                </div>
                                                @if($errors->first('description'))
                                                <label class="error text-danger" for="description">*{{ $errors->first('description') }}</label>
                                                @endif
                                            </div>-->
                    <div class="col-sm-6" style="display: none">
                        <div class="form-group">
                            <label for="ConatctNumber1">Cell Number 1*</label>
                            <input class="form-control" type="text"  id="ConatctNumber1" name="ConatctNumber1" value="{{old('ConatctNumber1')}}" placeholder="Enter your Cell Number 1">
                            @if($errors->first('ConatctNumber1'))
                            <label class="error text-danger" for="FirstName">*{{ $errors->first('ConatctNumber1') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6" style="display: none">
                        <div class="form-group">
                            <label for="ConatctNumber2">Cell Number 2</label>
                            <input class="form-control" type="number"  id="ConatctNumber2" name="ConatctNumber2" value="{{old('ConatctNumber2')}}" placeholder="Enter your Cell Number 2">
                            @if($errors->first('ConatctNumber2'))
                            <label class="error text-danger" for="FirstName">*{{ $errors->first('ConatctNumber2') }}</label>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-2">
                                <label for="password" class="bold-class">Password</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control" type="password"  name="password" id="password" placeholder="Enter your Password" value="">
                                    @if($errors->first('password'))
                                    <label class="error text-danger" for="FirstName">*{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="ConfrimPassword" class="bold-class">Confirm Your Password</label>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input class="form-control"  type='password'  name="ConfrimPassword" id="ConfrimPassword" placeholder="Cofirm Your Password" value="">
                                    @if($errors->first('ConfrimPassword'))
                                    <label class="error text-danger" for="FirstName">*{{ $errors->first('ConfrimPassword') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-sm-9 col-xs-9 col-sm-offset-3 hide RealBusiness" style="display: none">
                        <h2>Please select a package or start with a FREE one</h2>
                    </div>
                    <div class="col-sm-12 hide RealBusiness" style="display: none">
                        <?php $pkgNumber = 1; ?>
                        @foreach($packages->slice(0,4) as $package)
                        <div class="col-md-3 col-sm-6">
                            <div id="page-block-{{ $pkgNumber }}" class="package-block">
                                <h3 class="package-title">{{ $package->name }}</h3>
                                <ul class="package-list">
                                    <?php $count = 0; ?>
                                    @foreach($Permission as $key=>$permission)
                                    <li>
                                        <br>
                                        {{--  {{ $permission->id }}--}}
                                        @if(isset($package->permissions[$count]) AND ($package->permissions[$count]->id = $permission->id ))
                                        <i class="fa fa-check " style="color: #00AA88;"></i>
                                        @else
                                        <i class=" fa fa-close" style="color: red;"></i>
                                        @endif
                                        {{ $permission->name  }}
                                    </li>
                                    <?php $count++; ?>
                                    @endforeach
                                </ul>
                                <div class="package-link">
                                    <label class="btn btn-primary btn-lg" id="btn{{ $pkgNumber }}" >
                                        <input type="radio"  name="package" value="{{ $package->id }}" style=" visibility: hidden">
                                        <i class="fa fa-check fa-lg hide btn{{ $pkgNumber }}" ></i>Select Package
                                    </label>
                                </div>
                            </div>
                            @if($errors->first('package'))
                            <label class="error text-danger" for="package">*{{ $errors->first('package') }}</label>
                            @endif
                        </div>
                        <?php $pkgNumber++; ?>
                        @endforeach
                    </div>-->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name='iagree' id="iagree" value="1">
                                        I Agree
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <label>By clicking <b>Register</b>, you agree to the Terms and Conditions set out by this site, including our Cookie Use.</label>
                                    @if($errors->first('iagree'))
                                    <label class="error text-danger" for="iagree">*{{ $errors->first('iagree') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-lg submit">Register</button>
                    </div>
                </div>
            </div>
    </div>
</form>
</div>
</div>

@endsection

@section('pagejs')

<script>
    $(document).ready(function () {

        $("#btn1").click(function ()
        {
            $('.RealBusiness').removeClass('hide');
            $('.btn1').removeClass('hide');
            $('#page-block-1').addClass('active')
            $('.btn2').addClass('hide');
            $('.btn3').addClass('hide');
            $('.btn4').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-4').removeClass('active')
        });

        $("#btn2").click(function () {
            $('.RealBusiness').removeClass('hide');
            $('.btn2').removeClass('hide');
            $('#page-block-2').addClass('active')
            $('.btn1').addClass('hide');
            $('.btn3').addClass('hide');
            $('.btn4').addClass('hide');
            $('#page-block-1').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-4').removeClass('active')
        });
        $("#btn3").click(function () {
            $('.RealBusiness').removeClass('hide');
            $('.btn3').removeClass('hide');
            $('#page-block-3').addClass('active')
            $('.btn1').addClass('hide');
            $('.btn2').addClass('hide');
            $('.btn4').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-1').removeClass('active')
            $('#page-block-4').removeClass('active')
        });
        $("#btn4").click(function () {
            $('.RealBusiness').removeClass('hide');
            $('.btn4').removeClass('hide');
            $('#page-block-4').addClass('active')
            $('.btn1').addClass('hide');
            $('.btn2').addClass('hide');
            $('.btn3').addClass('hide');
            $('#page-block-2').removeClass('active')
            $('#page-block-3').removeClass('active')
            $('#page-block-1').removeClass('active')
        });

//BusinessType

        @if (old('BusinessType') == 2)
                $('.RealBusiness').removeClass('hide');
                @endif
                $("form input[name=BusinessType]").change(function () {
            if ($(this).val() == '2') {
                $('.RealBusiness').removeClass("hide");
                $('.Individual').addClass('hide');
            } else {
                $('.RealBusiness').addClass("hide");
                $('.Individual').removeClass('hide');
            }
        });
//                $('#BusinessType').on('change', function () {
//            if ($(this).val() == 2) {
//                $('.RealBusiness').removeClass('hide');
//                $('.Individual').addClass('hide');
//            } else {
//                $('.RealBusiness').addClass('hide');
//                $('.Individual').removeClass('hide');
//            }
//        });

    });
</script>
@endsection