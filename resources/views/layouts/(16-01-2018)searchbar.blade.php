{{--{{ dd($featuremodelData) }}--}}
<!--start advanced search section-->
<section class="advanced-search advance-search-header hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('Search-Result') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <div class="form-group no-margin">
                                <div class="input-search input-icon">
                                    <input class="form-control" type="text" name="keyword" id="keyword"  placeholder="Search for a place to stay?">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="form-group no-margin">
                                <div class="search-location">
                                    <input class="form-control" type="text" placeholder="Location" name="keywordaddress" id="keywordaddress"  >
                                    <i class="location-trigger fa fa-dot-circle-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2">
                            <div class="form-group no-margin">
                                <div class="search-location">
                                    <select class="form-control" name="city" >
                                        <option value="All">All City</option>
                                       @foreach($cities as $citys)
                                         @if(!empty( $value))
                                        <option value="{{ $citys->name }}" @if(!empty( $value == $citys->name)) selected @endif >{{ $citys->name }}</option>
                                        @else
                                        <option value="{{ $citys->name }}">{{ $citys->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-2">
                            <div class="form-group no-margin">
                                <div class="search-location">
                                    <select name="purpose" class="form-control " >
                                        <option value="All">Purpose</option>
                                        <option value="sell">For Sale</option>
                                        <option value="rent">For Rent</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-7">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <select name="subtype" class="form-control">
                                        <option value="All">All Type</option>
                                        <option value="Houses / Villas"> Houses / Villas</option>
                                        <option value="Res. Plots /Files"> Res. Plots /Files</option>
                                        <option value="Flats / Apartments"> Flats / Apartments</option>
                                        <option value="Form Houses"> Form Houses </option>
                                        <option value="Upper Portion"> Upper Portion</option>
                                        <option value="Lower Portion"> Lower Portion</option>
                                        <option value="Commercial Plots /files"> Commercial Plots /files</option>
                                        <option value="Agricultural Land"> Agricultural Land</option>
                                        <option value="Industrial Land"> Industrial Land</option>
                                        <option value="Offices"> Offices</option>
                                        <option value="Shops / Showrooms"> Shops / Showrooms</option>
                                        <option value="Warehouses / Godown"> Warehouses / Godown</option>
                                        <option value="Buildings / Plaza"> Buildings / Plaza</option>
                                        <option value="Factories/Workshops"> Factories/Workshops</option>
                                        <option value="Guest House / Hostels"> Guest House / Hostels</option>
                                        <option value="Schools / Colleges"> Schools / Colleges</option>
                                        <option value="Hotel / Restaurant"> Hotel / Restaurant</option>
                                        <option value="Residental Towns / Scheeme"> Residental Towns / Scheeme</option>
                                        <option value="Land Sub Divisions"> Land Sub Divisions</option>
                                        <option value="Commercial Plaza / Area"> Commercial Plaza / Area</option>
                                        <option value="Industrial Estate / Zone"> Industrial Estate / Zone</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-6 text-center">
                                    <button class="advance-btn btn" type="button"><i class="fa fa-gear"></i> Advance</button>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="advance-fields">
                      <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="form-control" name="OwnerShipStatus" title="Owner Ship">
                                       <option value="">Select OwnerShip</option>
                                        <option value="Allotment">Allotment </option>
                                        <option value="Registered">Registered </option>
                                        <option value="Leased">Leased  </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="form-control"  name="kitchens" title="Number of kitchens">
                                       <option value="">Select kitchen</option>
                                        <option value="1"> 1</option>
                                        <option value="2"> 2</option>
                                        <option value="3"> 3</option>
                                        <option value="4"> 4</option>
                                        <option value="5"> 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="form-control" name="beds" title="Number of Beds">
                                        <option value="">Select Bed</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="6">05</option>
                                        <option value="6">06</option>
                                        <option value="7">07</option>
                                        <option value="8">08</option>
                                        <option value="9">09</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="form-group">
                                    <select class="form-control"title="Number of Baths">
                                        <option value="">Select Bath</option>
                                        <option value="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                        <option value="4">04</option>
                                        <option value="5">05</option>
                                    </select>
                                </div>
                            </div>

                            {{--<div class="col-sm-3 col-xs-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<select class="form-control" data-live-search="true" data-live-search-style="begins" name="area_unit" title="Area Unit">--}}
                                        {{--<option value="Marla">Marla</option>--}}
                                        {{--<option value="Kanal">Kanal</option>--}}
                                        {{--<option value="acres">Acres</option>--}}
                                        {{--<option value="Square Yard">Square Yard</option>--}}
                                        {{--<option value="Square Feet">Square Feet</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6 col-xs-6">
                                <div class="range-advanced-main">
                                    <div class="range-text">
                                        <input type="text" name="price_from" class="min-price-range-hidden range-input" readonly >
                                        <input type="text" name="price_to" class="max-price-range-hidden range-input" readonly >
                                        <p><span class="range-title">Price Range:</span> from <span class="min-price-range"></span> to <span class="max-price-range"></span></p>
                                    </div>
                                    <div class="range-wrap">
                                        <div class="price-range-advanced"></div>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-sm-12 col-xs-12 features-list">

                                <label class="advance-trigger text-uppercase title"><i class="fa fa-plus-square"></i> Other Features </label>
                                <div class="clearfix"></div>
                                <div class="field-expand">
                                    @foreach($featuremodelData as $key => $feature)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="feature[]" value="{{ $feature->id }}"> {{ $feature->name }}
                                        </label>
                                    @endforeach
                                </div>-->
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--end advanced search section-->

<!--start advanced search section-->
<!--    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ url('Search-Result') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-search input-icon">
                                    <input class="form-control" type="text" name="keyword" id="keyword"  placeholder="Search for a place to stay?">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="search-location">
                                    <input class="form-control" type="text" placeholder="Location" name="keywordaddress" id="keywordaddress"  >
                                    <i class="location-trigger fa fa-dot-circle-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="search-location">
                                    <select class="form-control" data-live-search="false" data-live-search-style="begins" name="city" >
                                        <option value="All">All City</option>
                                        @foreach($cities as $citys)
                                         @if(!empty( $value))
                                        <option value="{{ $citys->name }}" @if(!empty( $value == $citys->name)) selected @endif >{{ $citys->name }}</option>
                                        @else
                                        <option value="{{ $citys->name }}">{{ $citys->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="search-location">
                                    <select name="purpose" class="form-control" data-live-search="false" data-live-search-style="begins">
                                        <option value="All">Purpose</option>
                                        <option value="sell">For Sale</option>
                                        <option value="rent">For Rent</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-7">
                            <div class="row">
                                <div class="col-sm-8">
                                    <select name="subtype" class="form-control" data-live-search="false" data-live-search-style="begins">
                                        <option value="All">All Type</option>
                                        <option value="Houses / Villas"> Houses / Villas</option>
                                        <option value="Res. Plots /Files"> Res. Plots /Files</option>
                                        <option value="Flats / Apartments"> Flats / Apartments</option>
                                        <option value="Form Houses"> Form Houses </option>
                                        <option value="Upper Portion"> Upper Portion</option>
                                        <option value="Lower Portion"> Lower Portion</option>
                                        <option value="Commercial Plots /files"> Commercial Plots /files</option>
                                        <option value="Agricultural Land"> Agricultural Land</option>
                                        <option value="Industrial Land"> Industrial Land</option>
                                        <option value="Offices"> Offices</option>
                                        <option value="Shops / Showrooms"> Shops / Showrooms</option>
                                        <option value="Warehouses / Godown"> Warehouses / Godown</option>
                                        <option value="Buildings / Plaza"> Buildings / Plaza</option>
                                        <option value="Factories/Workshops"> Factories/Workshops</option>
                                        <option value="Guest House / Hostels"> Guest House / Hostels</option>
                                        <option value="Schools / Colleges"> Schools / Colleges</option>
                                        <option value="Hotel / Restaurant"> Hotel / Restaurant</option>
                                        <option value="Residental Towns / Scheeme"> Residental Towns / Scheeme</option>
                                        <option value="Land Sub Divisions"> Land Sub Divisions</option>
                                        <option value="Commercial Plaza / Area"> Commercial Plaza / Area</option>
                                        <option value="Industrial Estate / Zone"> Industrial Estate / Zone</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-secondary btn-block"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>-->
<!--end advanced search section-->