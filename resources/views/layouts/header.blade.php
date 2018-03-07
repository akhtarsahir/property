<button class="btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>
<div class="modal fade" id="pop-login" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Login</li>
                    <a href="{{url("Signup")}}"><li>Register</li></a>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>

            </div>
            <div class="modal-body login-block">
                <div class="tab-content">
                    <div class="tab-pane fade in active">
                        @if(Session::has('failure'))
                            <div class="message">
                                <p class="error text-danger"><i class="fa fa-close"></i>
                                {{Session::get('failure')}}
                                </p>
                            </div>
                        @endif
                        <form action="/admin/login" autocomplete="on" method="post" >
                            <div class="form-group field-group">
                                <div class="input-user input-icon">
                                    <input type="email" name="email" placeholder="Email" value="">
                                </div>
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                <div class="input-pass input-icon">
                                    <input type="password" name="password" placeholder="Password" value="" >
                                </div>
                            </div>
                            <div class="forget-block clearfix">
                                <div class="form-group pull-left">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" value="remember" >
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group pull-right">
                                    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#pop-reset-pass">I forgot username and password</a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pop-reset-pass" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Reset Password</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
                <form>
                    <div class="form-group">
                        <div class="input-user input-icon">
                            <input placeholder="Enter your username or email" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Get new password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pop-rating-message" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="login-tabs">
                    <li class="active">Rating Property</li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <p class="error text-danger"><i class="fa fa-close"></i> You are not Logedin</p>


                <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#pop-login" >
                    <button class="btn btn-primary btn-block">Login</button>
                </a>
                <br>
                <a href="{{url("Signup")}}"><button class="btn btn-info btn-block">Register Yourself</button></a>

            </div>
        </div>
    </div>
</div>
<!--start top bar-->
<div class="top-bar" style="background-color: #004274;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="top-bar-left">
                        <ul class="top-drop-downs">
                            <!-- <li class="btn-price-lang btn-price">
                               <a href="{{ url('contact_us')}}" style="color: white"><button class="btn" type="button" >Contact Us</button></a>
                            </li>
                            <li class="btn-price-lang btn-area">
                               <a href="{{ url('about_us')}}" style="color: white"><button class="btn" type="button"  >About Us</button></a>
                            </li> -->
                            <?php $lahore = DB::table('users')->where('DisplayName', '=', 'lahore')->first();
                                  $multan = DB::table('users')->where('DisplayName', '=', 'multan')->first();
                                  $islamabad = DB::table('users')->where('DisplayName', '=', 'islamabad')->first();
                                  $karachi = DB::table('users')->where('DisplayName', '=', 'karachi')->first();
                            ?>
                          <li class="btn-price-lang btn-lang">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="lang-dropdown" style="font-size: 16px;">City HomePage<i class="fa fa-sort-down"></i></button>
                                <ul class="dropdown-menu" aria-labelledby="lang-dropdown" style="background-color:#fff">
                                    <li>@if(!empty($lahore->DisplayName)) <a href="//{!! $lahore->DisplayName !!}.justdeal.pk" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333; font-size: 15px;">Lahore</a> @else <a href="#" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333; font-size: 15px;">Lahore</a>  @endif </li>
                                    <li>@if(!empty($multan->DisplayName))<a href="//{!! $multan->DisplayName !!}.justdeal.pk" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333;font-size: 15px;">Multan</a> @else <a href="#" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333; font-size: 15px;">Multan</a> @endif </li>
                                    <li>@if(!empty($islamabad->DisplayName))<a href="//{!! $islamabad->DisplayName !!}.justdeal.pk" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333;font-size: 15px;">Islamabad</a> @else <a href="#" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333; font-size: 15px;">Islamabad</a> @endif </li>
                                    <li>@if(!empty($karachi->DisplayName))<a href="//{!! $karachi->DisplayName !!}.justdeal.pk" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333;font-size: 15px;">Karachi</a> @else <a href="#" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #333; font-size: 15px;">Karachi</a> @endif </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="top-bar-right">
                        <div class="top-contact">
                        @foreach($Social_account as $data)
                            <ul>
                                <li class="top-bar-phone">
                                    <a href="tel:{{$data->contact_no}}"><i class="fa fa-phone"></i> <span>{{$data->contact_no}}</span></a>
                                </li>
                                <li class="top-bar-contact">
                                    <a href="mailto:{{$data->email}}"><i class="fa fa-envelope-o"></i><span>{{$data->email}}</span></a>
                                </li>
                                <li class="top-bar-social">
                                    <a target="_blank" class="btn-facebook" href="{{$data->facebook}}"><i class="fa fa-facebook-square"></i></a>

                                    <a target="_blank" class="btn-twitter" href="{{$data->twitter}}"><i class="fa fa-twitter-square"></i></a>

                                    <a target="_blank" class="btn-linkedin" href="{{$data->linked_In}}"><i class="fa fa-linkedin-square"></i></a>

                                    <a target="_blank" class="btn-google-plus" href="{{$data->google_pluse}}"><i class="fa fa-google-plus-square"></i></a>

                                    <!--<a target="_blank" class="btn-instagram" href="{{$data->email}}"><i class="fa fa-instagram"></i></a>-->
                                </li>
                            </ul>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end top bar-->
<!--start header section header v1-->
<header id="header-section" class="header-section-4 header-main  nav-left hidden-sm hidden-xs" data-sticky="1">
    <div class="container">
        <div class="header-left">
            

                <div class="logo">
                    <?php  $server = explode('.', Request::server('HTTP_HOST'));   $Agent = DB::table('users')->where('DisplayName', '=', $server[0])->first(); ?>
                @if($server[0] != 'justdeal')
                        <a href="{{ Config::get('app.url') }}">
                            @if(empty($Agent->company_logo))
                                <img src="{{ asset('public/ProfileImage/90x90_'.$Agent->image )  }}" alt="{{ $Agent->first_name.' '.$Agent->last_name }}" style="width: 245px; height: 71px;" >
                            @else
                                <img src="{{ asset('public/CompanyImage/245x71_'.$Agent->company_logo )  }}" alt="{{ $Agent->first_name.' '.$Agent->last_name }}"  style="width: 245px; height: 71px;">
                            @endif
                        </a>
                    @else
                        <a href="{{ Config::get('app.url') }}">
                          <!--   <img src="{{asset('assets/images/houzez-logo-color.png')}}" alt="logo"> -->
                            <?php $logo = DB::table('logosite')->first();?>
                          <img src="{{ asset('public/LogoImages/245x71_'.$logo->image)  }}" alt="logo">
                        </a>
                        @endif

                </div>

                @if($server[0] == 'justdeal')
            <!-- <nav class="navi main-nav" style="float: right !important; margin-right: -4% !important; margin-top: -86px"> -->
            <nav class="navi main-nav">
                <ul>
                <!--  <li>
                     <a href="#">City HomePage</a>
                     <ul class="sub-menu">
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Lahore</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Multan</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Islamabad</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Karachi</a></li>
                     </ul>
                    </li> -->
                    <li><a href="{{ Config::get('app.url') }}">Home</a></li>
                    <li class="has-child">
                        <a href="/sale-properties">Sale</a>
                        <ul class="sub-menu">
                            <li><a href="/sale-properties/Houses-Villas">Houses / Villas</a></li>
                            <li><a href="/sale-properties/Plots-Files">Res. Plots /Files</a></li>
                            <li><a href="/sale-properties/Flats-Apartments">Flats / Apartments</a></li>
                            <li><a href="/sale-properties/Form-Houses">Form Houses</a></li>
                            <li><a href="/sale-properties/Upper-Portion">Upper Portion</a></li>
                            <li><a href="/sale-properties/Lower-Portion">Lower Portion</a></li>
                            <li><a href="/sale-properties/Commercial-Plots-files">Commercial Plots /files</a></li>
                            <li><a href="/sale-properties/Agricultural-Land">Agricultural Land</a></li>
                            <li><a href="/sale-properties/Industrial-Land">Industrial Land</a></li>
                            <li><a href="/sale-properties/Offices">Offices</a></li>
                            <li><a href="/sale-properties/Shops-Showrooms">Shops / Showrooms</a></li>
                            <li><a href="/sale-properties/Warehouses-Godown">Warehouses / Godown</a></li>
                            <li><a href="/sale-properties/Buildings-Plaza">Buildings / Plaza</a></li>
                            <li><a href="/sale-properties/Factories-Workshops">Factories/Workshops</a></li>
                            <li><a href="/sale-properties/Guest-House-Hostels">Guest House / Hostels</a></li>
                            <li><a href="/sale-properties/Schools-Colleges">Schools / Colleges</a></li>
                            <li><a href="/sale-properties/Hotel-Restaurant">Hotel / Restaurant</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/rent-properties">Rent</a>
                        <ul class="sub-menu">
                            <li><a href="/rent-properties/Houses-Villas">Houses / Villas</a></li>
                            <li><a href="/rent-properties/Plots-Files">Res. Plots /Files</a></li>
                            <li><a href="/rent-properties/Flats-Apartments">Flats / Apartments</a></li>
                            <li><a href="/rent-properties/Form-Houses">Form Houses</a></li>
                            <li><a href="/rent-properties/Upper-Portion">Upper Portion</a></li>
                            <li><a href="/rent-properties/Lower-Portion">Lower Portion</a></li>
                            <li><a href="/rent-properties/Commercial-Plots-files">Commercial Plots /files</a></li>
                            <li><a href="/rent-properties/Agricultural-Land">Agricultural Land</a></li>
                            <li><a href="/rent-properties/Industrial-Land">Industrial Land</a></li>
                            <li><a href="/rent-properties/Offices">Offices</a></li>
                            <li><a href="/rent-properties/Shops-Showrooms">Shops / Showrooms</a></li>
                            <li><a href="/rent-properties/Warehouses-Godown">Warehouses / Godown</a></li>
                            <li><a href="/rent-properties/Buildings-Plaza">Buildings / Plaza</a></li>
                            <li><a href="/rent-properties/Factories-Workshops">Factories/Workshops</a></li>
                            <li><a href="/rent-properties/Guest-House-Hostels">Guest House / Hostels</a></li>
                            <li><a href="/rent-properties/Schools-Colleges">Schools / Colleges</a></li>
                            <li><a href="/rent-properties/Hotel-Restaurant">Hotel / Restaurant</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/projects-properties">projects</a>
                        <ul class="sub-menu">
                            <li><a href="/projects-properties/Residental-Towns-Scheeme">Residental Towns / Scheeme</a></li>
                            <li><a href="/projects-properties/Land-Sub-Divisions">Land Sub Divisions</a></li>
                            <li><a href="/projects-properties/Commercial-Plaza-Area">Commercial Plaza / Area</a></li>
                            <li><a href="/projects-properties/Industrial-Estate-Zone">Industrial Estate / Zone</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{url("citylist")}}">City/Location</a>
                     <ul class="sub-menu">
                         <li><a href="/all">All Pakistan</a></li>
                         @foreach($cities as $city)
                         <li><a href="/all/{{ $city->name }}">{{ $city->name }}</a></li>
                       @endforeach
                     </ul>
                    </li>
                    <!-- <li class="houzez-megamenu"><a href="http://justdeal.pk/all-properties">All Properties</a></li> -->
                    <li class="houzez-megamenu"><a href="/agent_list">Agency</a></li>
                    {{--<li class="houzez-megamenu"><a href="http://justdeal.pk/blog">Blog</a></li>--}}

                </ul>
            </nav>
                    @else
                    <nav class="navi main-nav">
                        <ul>
                            <li><a href="" style="font-size: 30px; font-weight:bold; color: #004274 !important;">{{ $Agent->company_name }}</a></li>
                       <!-- <li>
                     <a href="#">City HomePage</a>
                     <ul class="sub-menu">
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Lahore</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Multan</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Islamabad</a></li>
                          <li> <a href="" target="_blank" data-pk="1" class="editable" data-title="Edit User Name" style="color: #0d70b7">Karachi</a></li>
                     </ul>
                    </li> -->
                    <li class="has-child">
                    @if(!empty( $value))
                        <a href="/city-sale-properties/{{$value}}">Sale</a>
                       @endif
                        <ul class="sub-menu">
                         @if(!empty( $value))
                            <li><a href="/city-sale-properties/Houses-Villas/{{$value}}">Houses / Villas</a></li>
                            <li><a href="/city-sale-properties/Plots-Files/{{$value}}">Res. Plots /Files</a></li>
                            <li><a href="/city-sale-properties/Flats-Apartments/{{$value}}">Flats / Apartments</a></li>
                            <li><a href="/city-sale-properties/Form-Houses/{{$value}}">Form Houses</a></li>
                            <li><a href="/city-sale-properties/Upper-Portion/{{$value}}">Upper Portion</a></li>
                            <li><a href="/city-sale-properties/Lower-Portion/{{$value}}">Lower Portion</a></li>
                            <li><a href="/city-sale-properties/Commercial-Plots-files/{{$value}}">Commercial Plots /files</a></li>
                            <li><a href="/city-sale-properties/Agricultural-Land/{{$value}}">Agricultural Land</a></li>
                            <li><a href="/city-sale-properties/Industrial-Land/{{$value}}">Industrial Land</a></li>
                            <li><a href="/city-sale-properties/Offices/{{$value}}">Offices</a></li>
                            <li><a href="/city-sale-properties/Shops-Showrooms/{{$value}}">Shops / Showrooms</a></li>
                            <li><a href="/city-sale-properties/Warehouses-Godown/{{$value}}">Warehouses / Godown</a></li>
                            <li><a href="/city-sale-properties/Buildings-Plaza/{{$value}}">Buildings / Plaza</a></li>
                            <li><a href="/city-sale-properties/Factories-Workshops/{{$value}}">Factories/Workshops</a></li>
                            <li><a href="/city-sale-properties/Guest-House-Hostels/{{$value}}">Guest House / Hostels</a></li>
                            <li><a href="/city-sale-properties/Schools-Colleges/{{$value}}">Schools / Colleges</a></li>
                            <li><a href="/city-sale-properties/Hotel-Restaurant/{{$value}}">Hotel / Restaurant</a></li>
                        @endif
                        </ul>
                    </li>
                    <li>@if(!empty( $value))
                        <a href="/city-rent-properties/{{$value}}">Rent</a>
                        @endif
                        <ul class="sub-menu">
                         @if(!empty( $value))
                            <li><a href="/city-rent-properties/Houses-Villas/{{$value}}">Houses / Villas</a></li>
                            <li><a href="/city-rent-properties/Plots-Files/{{$value}}">Res. Plots /Files</a></li>
                            <li><a href="/city-rent-properties/Flats-Apartments/{{$value}}">Flats / Apartments</a></li>
                            <li><a href="/city-rent-properties/Form-Houses/{{$value}}">Form Houses</a></li>
                            <li><a href="/city-rent-properties/Upper-Portion/{{$value}}">Upper Portion</a></li>
                            <li><a href="/city-rent-properties/Lower-Portion/{{$value}}">Lower Portion</a></li>
                            <li><a href="/city-rent-properties/Commercial-Plots-files/{{$value}}">Commercial Plots /files</a></li>
                            <li><a href="/city-rent-properties/Agricultural-Land/{{$value}}">Agricultural Land</a></li>
                            <li><a href="/city-rent-properties/Industrial-Land/{{$value}}">Industrial Land</a></li>
                            <li><a href="/city-rent-properties/Offices/{{$value}}">Offices</a></li>
                            <li><a href="/city-rent-properties/Shops-Showrooms/{{$value}}">Shops / Showrooms</a></li>
                            <li><a href="/city-rent-properties/Warehouses-Godown/{{$value}}">Warehouses / Godown</a></li>
                            <li><a href="/city-rent-properties/Buildings-Plaza/{{$value}}">Buildings / Plaza</a></li>
                            <li><a href="/city-rent-properties/Factories-Workshops/{{$value}}">Factories/Workshops</a></li>
                            <li><a href="/city-rent-properties/Guest-House-Hostels/{{$value}}">Guest House / Hostels</a></li>
                            <li><a href="/city-rent-properties/Schools-Colleges/{{$value}}">Schools / Colleges</a></li>
                            <li><a href="/city-rent-properties/Hotel-Restaurant/{{$value}}">Hotel / Restaurant</a></li>
                        @endif
                        </ul>
                    </li>
                    @if(!empty( $value))
                    <!-- <li class="houzez-megamenu"><a href="http://justdeal.pk/all-properties">All Properties</a></li> -->
                    <li class="houzez-megamenu"><a href="/city_agent_list/{{$value}}">Agency</a></li>
                        @endif
                        </ul>
                    </nav>
                    @endif
        </div>

        <div class="header-right">
            <div class="user">
               @if( !Auth::user())
               	 <a href="http://justdeal.pk/add_property" class="btn btn-default">Add Property</a>
                <!-- <a href="#" data-toggle="modal" data-target="#pop-login" class="btn btn-default">Add Property</a> -->
                @endif
             <?php if(!isset($_SESSION)){session_start();}?>
                @if( Auth::user())
                <a href="http://justdeal.pk/add_property" class="btn btn-default">Add Property</a>
                <a href="{{url("/logout")}}">SignOut</a>
                <a href="{{ url('/admin/') }}" class="">Profile</a>
                @else

                <a href="#" data-toggle="modal" data-target="#pop-login" >Sign In </a>
                    <a href="http://justdeal.pk/Signup">Register</a>
                @endif

            </div>
        </div>
    </div>
@if(\Request::path() != 'add_property')
    <!--start advanced search section-->
   @include('layouts.searchbar')
    <!--end advanced search section-->
    @endif

</header>
<div class="header-mobile visible-sm visible-xs">
    <div class="container">
        <!--start mobile nav-->
        <div class="mobile-nav">
            <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
            <div class="nav-dropdown main-nav-dropdown"></div>
        </div>
        <!--end mobile nav-->
        <div class="header-logo">
            <a href="{{ url('index') }}"><img src="{{asset('assets/images/logo-houzez-white.png')}}" alt="logo"></a>
        </div>
        <div class="header-user">
            <ul class="account-action">
                <li>
                    <span class="user-icon"><i class="fa fa-user"></i></span>
                    <div class="account-dropdown">
                        <ul>
                            <li> <a href=""> <i class="fa fa-plus-circle"></i>Add Property</a></li>
                            <li> <a href="#" data-toggle="modal" data-target="#pop-login"> <i class="fa fa-user"></i> Log in / Register </a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--end header section header v1-->

