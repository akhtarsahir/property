<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\SocialAcounts;
use App\User;
use App\PropertyModel;
use Request;
use App\CityModel;
use App\agentModel;
use App\Adds;
use App\FeatureModel;
use App\AboutUs;
use App\CompanySliderModel;
use Auth;
use DB;

class AgentController extends Controller {

    public function __construct() {
        $this->SocialAcounts = new SocialAcounts();
        $this->User = new User();
        $this->PropertyModel = new PropertyModel();
        $this->CityModel = new CityModel();
        $this->agentModel = new agentModel();
        $this->Adds = new Adds();
        $this->FeatureModel = new FeatureModel();
        $this->AboutUs = new AboutUs();
        $this->CompanySliderModel = new CompanySliderModel();
    }

    /*
     * Get Agent Detail
     * */

    public function subaddresscityname($addressname) {
//          $addressname = preg_replace('([^a-zA-Z0-9\+\?])', ' ', $addressname);
//          echo $addressname;
//        exit();
        $url_value = $addressname;
        $properties = $this->PropertyModel->where('address', $addressname)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->orderBy('featured_category', 'desc')->paginate(6);
        $total_result = $this->PropertyModel->where('address', $addressname)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->count();

        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('cityaddressproperty', ['url_value' => $url_value, 'total_result' => $total_result, 'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
    }

    public function agent_detail() {
        $server = explode('.', Request::server('HTTP_HOST'));
        // echo $server[0];exit;
        if ($server[0] == 'lahore') {
            $value = 'Lahore';
            $duplicates = DB::table('property')
                ->where('propertexpire', '>', date("Y-m-d"))
                ->where('status', '=', '1')
                ->where('city', $value)
                ->distinct()
                ->get(['address','city']);
            $Agent = $this->User->where('DisplayName', '=', $server[0])->first();
            $id = $Agent->id;
            $Agents = $this->User->where('user_id', '=', $id)->where('BusinessType', '=', '1')->where('isActive', '=', '1')->get();

            $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
            $agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
            $properties = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            //dd($properties);
            $Saleproperties = $this->PropertyModel->where('city', '=', 'Lahore')->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Saleproperties = $this->PropertyModel->where('city', '=', 'Lahore')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->paginate(12);
            $Rentproperties = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            $leatest_Rentproperties = $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
//     primium
            $Projects = $this->PropertyModel->where('city', '=', 'Lahore')->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Projects = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();

            $Social_account = $this->SocialAcounts->get();
            $cities = $this->CityModel->get();
            $featuremodelData = $this->FeatureModel->get();
            return view('city_index', ['duplicates' => $duplicates,'value' => $value, 'Agent' => $Agent, 'Agents' => $Agents, 'featuremodelData' => $featuremodelData, 'Social_account' => $Social_account, 'Projects' => $Projects, 'leatest_Projects' => $leatest_Projects, 'properties' => $properties, 'Saleproperties' => $Saleproperties, 'Rentproperties' => $Rentproperties, 'leatest_Saleproperties' => $leatest_Saleproperties, 'leatest_Rentproperties' => $leatest_Rentproperties, 'Agents' => $agents, 'cities' => $cities, 'Adds' => $Adds]);
        } elseif ($server[0] == 'multan') {
            $value = 'Multan';
            $duplicates = DB::table('property')
                ->where('propertexpire', '>', date("Y-m-d"))
                ->where('status', '=', '1')
                ->where('city', $value)
                ->distinct()
                ->get(['address','city']);
            $Agent = $this->User->where('DisplayName', '=', $server[0])->first();
            $id = $Agent->id;
            $Agents = $this->User->where('user_id', '=', $id)->where('BusinessType', '=', '1')->where('isActive', '=', '1')->get();

            $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
            $agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
            $properties = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            //dd($properties);
            $Saleproperties = $this->PropertyModel->where('city', '=', 'Multan')->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Saleproperties = $this->PropertyModel->where('city', '=', 'Multan')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->paginate(12);
            $Rentproperties = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            $leatest_Rentproperties = $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
//     primium
            $Projects = $this->PropertyModel->where('city', '=', 'Multan')->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Projects = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();

            $Social_account = $this->SocialAcounts->get();
            $cities = $this->CityModel->get();
            $featuremodelData = $this->FeatureModel->get();
            return view('city_index', ['duplicates' => $duplicates,'value' => $value, 'Agent' => $Agent, 'Agents' => $Agents, 'featuremodelData' => $featuremodelData, 'Social_account' => $Social_account, 'Projects' => $Projects, 'leatest_Projects' => $leatest_Projects, 'properties' => $properties, 'Saleproperties' => $Saleproperties, 'Rentproperties' => $Rentproperties, 'leatest_Saleproperties' => $leatest_Saleproperties, 'leatest_Rentproperties' => $leatest_Rentproperties, 'Agents' => $agents, 'cities' => $cities, 'Adds' => $Adds]);
        } elseif ($server[0] == 'islamabad') {
            $value = 'Islamabad';
            $duplicates = DB::table('property')
                ->where('propertexpire', '>', date("Y-m-d"))
                ->where('status', '=', '1')
                ->where('city', $value)
                ->distinct()
                ->get(['address','city']);
            $Agent = $this->User->where('DisplayName', '=', $server[0])->first();
            $id = $Agent->id;
            $Agents = $this->User->where('user_id', '=', $id)->where('BusinessType', '=', '1')->where('isActive', '=', '1')->get();

            $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
            $agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
            $properties = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            //dd($properties);
            $Saleproperties = $this->PropertyModel->where('city', '=', 'Islamabad')->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Saleproperties = $this->PropertyModel->where('city', '=', 'Islamabad')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->paginate(12);
            $Rentproperties = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            $leatest_Rentproperties = $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
//     primium
            $Projects = $this->PropertyModel->where('city', '=', 'Islamabad')->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Projects = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();

            $Social_account = $this->SocialAcounts->get();
            $cities = $this->CityModel->get();
            $featuremodelData = $this->FeatureModel->get();
            return view('city_index', ['duplicates' => $duplicates,'value' => $value, 'Agent' => $Agent, 'Agents' => $Agents, 'featuremodelData' => $featuremodelData, 'Social_account' => $Social_account, 'Projects' => $Projects, 'leatest_Projects' => $leatest_Projects, 'properties' => $properties, 'Saleproperties' => $Saleproperties, 'Rentproperties' => $Rentproperties, 'leatest_Saleproperties' => $leatest_Saleproperties, 'leatest_Rentproperties' => $leatest_Rentproperties, 'Agents' => $agents, 'cities' => $cities, 'Adds' => $Adds]);
        } elseif ($server[0] == 'karachi') {
            $value = 'karachi';
            $duplicates = DB::table('property')
                ->where('propertexpire', '>', date("Y-m-d"))
                ->where('status', '=', '1')
                ->where('city', $value)
                ->distinct()
                ->get(['address','city']);
            $Agent = $this->User->where('DisplayName', '=', $server[0])->first();
            $id = $Agent->id;
            $Agents = $this->User->where('user_id', '=', $id)->where('BusinessType', '=', '1')->where('isActive', '=', '1')->get();

            $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
            $agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
            $properties = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            //dd($properties);
            $Saleproperties = $this->PropertyModel->where('city', '=', 'karachi')->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Saleproperties = $this->PropertyModel->where('city', '=', 'karachi')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->paginate(12);
            $Rentproperties = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            $leatest_Rentproperties = $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
//     primium
            $Projects = $this->PropertyModel->where('city', '=', 'karachi')->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('featured_category', 'desc')->get();
            $leatest_Projects = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();

            $Social_account = $this->SocialAcounts->get();
            $cities = $this->CityModel->get();
            $featuremodelData = $this->FeatureModel->get();
            return view('city_index', ['duplicates' => $duplicates,'value' => $value, 'Agent' => $Agent, 'Agents' => $Agents, 'featuremodelData' => $featuremodelData, 'Social_account' => $Social_account, 'Projects' => $Projects, 'leatest_Projects' => $leatest_Projects, 'properties' => $properties, 'Saleproperties' => $Saleproperties, 'Rentproperties' => $Rentproperties, 'leatest_Saleproperties' => $leatest_Saleproperties, 'leatest_Rentproperties' => $leatest_Rentproperties, 'Agents' => $agents, 'cities' => $cities, 'Adds' => $Adds]);
        } else {
            $Agent = $this->User->where('DisplayName', '=', $server[0])->first();
            $id = $Agent->id;
            $Agents = $this->User->where('user_id', '=', $id)->where('BusinessType', '=', '1')->where('isActive', '=', '1')->get();

            $RentProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('purpose', '=', 'rent')->where('created_by', '=', $id)->paginate(10);
            $SellProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('purpose', '=', 'sell')->where('created_by', '=', $id)->paginate(10);
            $projects = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('type', '=', 'projects')->where('created_by', '=', $id)->paginate(10);
            $cities = $this->CityModel->get();

            $agents = $this->agentModel->where('user_id', $id)->get();
              
            $Companyslider = $this->CompanySliderModel->where('user_id',$id)->get();
            $Allproperties = $this->PropertyModel->where('created_by', '=', $id)->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d"))->orderBy('id', 'desc')->get();
            $premimum             = $this->PropertyModel->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('featured_category', 'desc')->get();
            $Saleproperties       = $this->PropertyModel->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('featured_category', 'desc')->get();
            $leatest_Saleproperties= $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('featured_category', 'ASC') ->paginate(12);
           
            $SocialAcounts = $this->SocialAcounts->get();
            $companyprofile = $this->User->where('user_id', $id)->get();
            $feature = $this->FeatureModel->get();

            $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Single')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

        $Agent_property = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        $Allpojectsproperties = $this->PropertyModel->where('type', '=', 'projects')->orderBy('featured_category', 'desc')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->paginate(6);
        $Allsaleproperties = $this->PropertyModel->where('purpose', '=', 'sell')->orderBy('featured_category', 'desc')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->paginate(6);
        $AllRentproperties = $this->PropertyModel->where('purpose', '=', 'rent')->orderBy('featured_category', 'desc')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->paginate(6);
            //dd($Agent);
            // dd($companyprofile);
            return view('company_profile', ['featuremodelData' => $feature,
                'Social_account' => $SocialAcounts,
                'Adds' => $Adds,
                'RentProperty' => $RentProperty,
                'SellProperty' => $SellProperty,
                'projects' => $projects,
                'Agents' => $Agents,
                'cities' => $cities,
                'agents' => $agents,
                'Allproperties' => $Allproperties,
                'premimum' => $premimum,
                'Saleproperties' => $Saleproperties,
                'leatest_Saleproperties' => $leatest_Saleproperties,
                'companyprofile' => $companyprofile,
                'Agent' => $Agent,
                'Companyslider' => $Companyslider,
                'Agent_property'=> $Agent_property,
                'Allpojectsproperties' => $Allpojectsproperties,
                'Allproperty' => $Allproperty,
                'Allsaleproperties' => $Allsaleproperties,
                'AllRentproperties' => $AllRentproperties
            ]);
        }
    }

//    All agency show in listing
    
    public function agent_list() {
        $SocialAcounts = $this->SocialAcounts->get();
        $Agent = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->paginate(4);
        $RentProperty = $this->PropertyModel->where('purpose', '=', 'rent')->paginate(10);
        $SellProperty = $this->PropertyModel->where('purpose', '=', 'sell')->paginate(10);
        $AllProperty = $this->PropertyModel->paginate(10);
        $cities = $this->CityModel->get();
        $feature = $this->FeatureModel->get();

        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Single')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

        //dd($SellProperty);
        return view('agent_list', ['featuremodelData' => $feature, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'Agents' => $Agent, 'RentProperty' => $RentProperty, 'SellProperty' => $SellProperty, 'AllProperty' => $AllProperty, 'cities' => $cities]);
    }
    
//    city vise agent list show 
    
    public function city_agent_list($city) {
        $value =$city;
        $SocialAcounts = $this->SocialAcounts->get();
        $Agent = $this->User->where('BusinessType', '=', '2')->where('city', '=', $city)->where('isActive', '=', '1')->paginate(4);
        $RentProperty = $this->PropertyModel->where('purpose', '=', 'rent')->paginate(10);
        $SellProperty = $this->PropertyModel->where('purpose', '=', 'sell')->paginate(10);
        $AllProperty = $this->PropertyModel->paginate(10);
        $cities = $this->CityModel->get();
        $feature = $this->FeatureModel->get();

        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Single')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();

        //dd($SellProperty);
        return view('city_agentlist', ['value' =>$value,'featuremodelData' => $feature, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'Agents' => $Agent, 'RentProperty' => $RentProperty, 'SellProperty' => $SellProperty, 'AllProperty' => $AllProperty, 'cities' => $cities]);
    }
    

}
