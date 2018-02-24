<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyModel;
use App\User;
use App\SocialAcounts;
use App\CityModel;
use App\Adds;
use App\FeatureModel;
use Auth;

class PropertiesController extends Controller {

    public $subtype = [
        'Houses-Villas' => 'Houses / Villas',
        'Plots-Files' => 'Plots / Files',
        'Flats-Apartments' => 'Flats / Appartments',
        'Form-Houses' => 'Form Houses',
        'Upper-Portion' => 'Upper Portion',
        'Lower-Portion' => 'Lower Protion',
        'Commercial-Plots-files' => 'Commercial Plots / Files',
        'Agricultural-Land' => 'Agricultural Land',
        'Industrial-Land' => 'Industrial Land',
        'Offices' => 'Office',
        'Shops-Showrooms' => 'Shops / Showrooms',
        'Warehouses-Godown' => 'Warehouses / Godown',
        'Buildings-Plaza' => 'Building',
        'Factories-Workshops' => 'Factories',
        'Guest-House-Hostels' => 'Guest House/Banquet Hall',
        'Schools-Colleges' => 'School / College',
        'Hotel-Restaurant' => 'Hotel / Resturant',
        'Residental-Towns-Scheeme' => 'Residental Town / Schemes',
        'Land-Sub-Divisions' => 'Land Sub Divisions',
        'Commercial-Plaza-Area' => 'Commercial Plaza / Tower',
        'Industrial-Estate-Zone' => 'Industrial Estates /Zone',
        'null' => ''
    ];
    
  
    public function __construct() {
        $this->PropertyModel = new PropertyModel ();
        $this->user = new User();
        $this->SocialAcounts = new SocialAcounts();
        $this->CityModel = new CityModel();
        $this->Adds = new Adds();
        $this->FeatureModel = new FeatureModel();
    }
    /*
     * Get All Property
     * */

    public function active_property() {
        //echo 'ACtive property';exit;
        $value ="Sell And Rent";
        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $properties = $this->PropertyModel->orderBy('featured_category', 'desc')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->paginate(6);
        $total_result = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '1')->count();
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $cities = $this->CityModel->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $feature = $this->FeatureModel->get();
        return view('all-properties', ['value' =>$value,'total_result' => $total_result,'featuremodelData' => $feature, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    /*
     * Get All Rent Property
     * */

    public function rent_property() {
        $url_value = \Request::segment(2);
        if (empty($url_value)) {
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'rent')
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'rent')
                    ->count();
        } else {
            $subtype = $this->subtype[$url_value];
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('subtype', '=', $subtype)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('subtype', '=', $subtype)
                    ->count();
        }

        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
       $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('all-properties', ['url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    /*
     * Get All Projects Property
     * */

    public function projects_property() {
        $url_value = \Request::segment(2);
        $value ="Sell And Rent";
        if (empty($url_value)) {
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('type', '=', 'projects')
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
             $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('type', '=', 'projects')
                    ->count();
        } else {
            $subtype = $this->subtype[$url_value];
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('type', '=', 'projects')
                    ->where('subtype', '=', $subtype)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
             $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('type', '=', 'projects')
                    ->where('subtype', '=', $subtype)
                    ->count();
        }


        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('all-properties', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    /*
     * Get All sale Property
     * */

    public function sale_property() {
        $url_value = \Request::segment(2);
        if (empty($url_value)) {
            $properties = $this->PropertyModel
//                    ->where('propertexpire', '>', date("Y-m-d"))
//                    ->where('status', '=', '1')
//                    ->where('purpose', '=', 'sell')
                    ->where([['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
                    ->orwhere([['number', '=', '1'],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
//                    ->where('propertexpire', '>', date("Y-m-d"))
//                    ->where('status', '1')
//                    ->where('purpose', '=', 'sell')
                    ->where([['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
                    ->orwhere([['number', '=', '1'],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
                    ->count();
        } else {
            $subtype = $this->subtype[$url_value];
            $properties = $this->PropertyModel
//                    ->where('propertexpire', '>', date("Y-m-d"))
//                    ->where('status', '=', '1')
//                    ->where('purpose', '=', 'sell')
//                    ->where('subtype', '=', $subtype)
                    ->where([['subtype', '=', $subtype],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
                    ->orwhere([['number', '=', '1'],['subtype', '=', $subtype],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
//                    ->where('propertexpire', '>', date("Y-m-d"))
//                    ->where('status', '1')
//                    ->where('purpose', '=', 'sell')
//                    ->where('subtype', '=', $subtype)
                     ->where([['subtype', '=', $subtype],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]])
                     ->orwhere([['number', '=', '1'],['subtype', '=', $subtype],['purpose', '=', 'sell'],['status', '=', '1'],['propertexpire', '>', date("Y-m-d")]]) 
                     ->count();
        }
//        print_r($properties);exit();
//        dd($properties);
//        foreach($properties as $property){
//        $id = $property->created_by;
//        $Agent = $this->user->where('id', '=', $id )->get();
//        }
//        dd($id);        
//        dd($Agent);
        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        //dd($username);
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('all-properties', ['url_value' =>$url_value,'total_result' => $total_result, 'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }
  
    public function allcity_property(){
        $url_value = \Request::segment(2);
        if (empty($url_value)) {
              $value = "All Pakistan properties";
               $city = '';
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
//                  ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
             $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->count();
        } else {
            $city = $this->CityModel->where('name',$url_value)->first();
//            $city = $this->city[$url_value];
            $city =$city->name;
            $value = $city;
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('city', '=', $city)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
             $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('city', '=', $city)
                    ->count();
        }


        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('allcity_properties', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
  
           
    }
    
     /*
     * city page resuts in rent sale and agents citywise
     * Get All city Rent Property
     * 
     */

    public function city_rent_property() {
        $url_value = \Request::segment(2);
        $value = \Request::segment(3);
        if (empty($url_value)) {
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'rent')
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'rent')
                    ->count();
        } else {
            $subtype = $this->subtype[$url_value];
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('subtype', '=', $subtype)
                    ->where('city', $value)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('subtype', '=', $subtype)
                    ->where('city', $value)
                    ->count();
        }

        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
       $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('cityaddressproperty', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    /*
     * Get All city sale Property
     * */

    public function city_sale_property() {
        $url_value = \Request::segment(2);
          $value = \Request::segment(3);
         if (empty($url_value)) {
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'sell')
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'sell')
                    ->count();
        } else {
            $subtype = $this->subtype[$url_value];
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'sell')
                    ->where('subtype', '=', $subtype)
                    ->where('city', $value)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'sell')
                    ->where('subtype', '=', $subtype)
                    ->where('city', $value)
                    ->count();
        }
        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        //dd($username);
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('cityaddressproperty', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result, 'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }
    
     /*
     * city page resuts in rent sale and agents citywise
     * Get All city Rent Property
     * 
     */

    public function citysingle_rent_property() {
          $url_value = '';
        $value = \Request::segment(2);
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('city', $value)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'rent')
                    ->where('city', $value)
                    ->count();
        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('cityaddressproperty', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    /*
     * Get All city sale Property
     * */

    public function citysingle_sale_property() {
         $url_value = '';
          $value = \Request::segment(2);
            $properties = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->where('purpose', '=', 'sell')
                    ->where('city', $value)
//                    ->orderBy('number', 'desc')
                    ->orderBy('featured_category', 'desc')
                    ->paginate(6);
            $total_result = $this->PropertyModel
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '1')
                    ->where('purpose', '=', 'sell')
                    ->where('city', $value)
                    ->count();
        $Agents = $this->user->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        //dd($username);
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('cityaddressproperty', ['value' =>$value,'url_value' =>$url_value,'total_result' => $total_result, 'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }
}
