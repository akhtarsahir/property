<?php

namespace App\Http\Controllers;

use App\FeatureModel;
use App\User;
use Illuminate\Http\Request;
use App\PropertyModel;
use App\SocialAcounts;
use App\CityModel;
use App\Adds;



class IndexController extends Controller
{



    /*
     * load all intital files
     * */
    public function __construct()
    {
        $this->PropertyModel = new PropertyModel();
        $this->User          = new User();
        $this->SocialAcounts = new SocialAcounts();
        $this->CityModel     = new CityModel();
        $this->Adds          = new Adds();
        $this->FeatureModel  = new FeatureModel();

    }

    /*
     * Main Index Page
     * */
    public function testindex2()
    {

        $Adds  = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $agents  = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $properties           = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        //dd($properties);
        $Saleproperties       = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'sell')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $leatest_Saleproperties= $this->PropertyModel->where('purpose', '=', 'sell')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $Rentproperties       = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $leatest_Rentproperties= $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $Projects             = $this->PropertyModel->where('number', '=', '1')->where('type', '=', 'projects')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $leatest_Projects     = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
       
        $Social_account       = $this->SocialAcounts->get();
        $cities               = $this->CityModel->get();
        $featuremodelData              = $this->FeatureModel->get();
        return view('index',  ['featuremodelData' => $featuremodelData ,'Social_account' => $Social_account , 'Projects' => $Projects,'leatest_Projects' => $leatest_Projects , 'properties' => $properties , 'Saleproperties' => $Saleproperties , 'Rentproperties' => $Rentproperties ,'leatest_Saleproperties' => $leatest_Saleproperties , 'leatest_Rentproperties' => $leatest_Rentproperties , 'Agents' => $agents , 'cities' => $cities , 'Adds' => $Adds]);   
        }
    public function index()
    {

        $Adds  = $this->Adds->where('status', '=', '1')->where('type', '=', 'Front')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $agents  = $this->User->where('feature_status', '=', '1')->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $properties           = $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        //dd($properties);
       $Rentproperties       = $this->PropertyModel->where('number', '=', '1')->where('purpose', '=', 'rent')->where('number', '=', '1')->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $leatest_Rentproperties= $this->PropertyModel->where('purpose', '=', 'rent')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
//     primium
        $Projects             = $this->PropertyModel->where('number', '=', '1')->where('featured_category', '=', '1')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('featured_category', 'desc')->get();
//    featured
        $Saleproperties       = $this->PropertyModel->where('number', '=', '1')->where('featured_category', '=', '2')->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('featured_category', 'desc')->get();
//    leatest sale 
        $leatest_Saleproperties= $this->PropertyModel->where('status', '=', '1')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc') ->paginate(12);
        
        $leatest_Projects     = $this->PropertyModel->where('status', '=', '1')->where('type', '=', 'projects')->where('propertexpire', '>=', date("Y-m-d")) ->orderBy('id', 'desc')->get();
        $Social_account       = $this->SocialAcounts->get();
        $cities               = $this->CityModel->get();
        $featuremodelData              = $this->FeatureModel->get();
        return view('index',  ['featuremodelData' => $featuremodelData ,'Social_account' => $Social_account , 'Projects' => $Projects,'leatest_Projects' => $leatest_Projects , 'properties' => $properties , 'Saleproperties' => $Saleproperties , 'Rentproperties' => $Rentproperties ,'leatest_Saleproperties' => $leatest_Saleproperties , 'leatest_Rentproperties' => $leatest_Rentproperties , 'Agents' => $agents , 'cities' => $cities , 'Adds' => $Adds]);   
        }


}
