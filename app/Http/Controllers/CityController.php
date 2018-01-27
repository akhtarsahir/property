<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PropertyModel;
use App\SocialAcounts;
use App\CityModel;
use App\CitySubAddresModel;
use Illuminate\Http\Response;
use App\Adds;
use App\FeatureModel;
use DB;
class CityController extends Controller {

    public function __construct() {
        $this->PropertyModel = new PropertyModel();
        $this->User = new User();
        $this->SocialAcounts = new SocialAcounts();
        $this->CityModel = new CityModel();
        $this->Adds = new Adds();
        $this->FeatureModel = new FeatureModel();
        $this->CitySubAddresModel = new CitySubAddresModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = $this->CityModel->get();
        return view('admin.city', ['data' => $data]);
    }

    public function citylisting() {
        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $otherProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('type', '=', 'projects')->paginate(6);
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();


        $data = $this->CityModel->get();
        return view('citylisting', [ 'data' => $data, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
    }

    public function citysubaddress($name) {
        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $otherProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('type', '=', 'projects')->paginate(6);
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();
//           echo $name;
//        $data = $this->CitySubAddresModel->where('cityname', $name)->get();
//        $duplicates = $this->PropertyModel->where('city', $name)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
      
       $duplicates = DB::table('property')
                ->where('propertexpire', '>', date("Y-m-d"))
                ->where('status', '=', '1')
                ->where('city', $name)
                ->distinct()
                ->get(['address','city']);
//        $data = $this->PropertyModel
//    ->select('city','address', DB::raw('COUNT(*) as `count`'))
//    ->where('city', $name)
////    ->where('propertexpire', $today)
////    ->where('status', '1')
//    ->groupBy('city','address')
//    ->havingRaw('COUNT(*) > 1')
//    ->get();
////        $duplicates = $this->CitySubAddresModel->get();
////        $duplicates = collect($duplicates);
////        dd($results);
//foreach ($duplicates as $duplicates){
//echo $duplicates->address;
//$id = DB::table('property')->where('city', $name)->where('address', $duplicates->address)->groupBy('address')->count();
//exit();
//}
        return view('citysubaddress', ['duplicates' => $duplicates,'name' => $name, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
    }
    public function addresscityname($addressname) {
//          $addressname = preg_replace('([^a-zA-Z0-9\+\?])', ' ', $addressname);
//          echo $addressname;
//        exit();
            $url_value = $addressname;
            $properties = $this->PropertyModel->where('address', $addressname )->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->orderBy('featured_category', 'desc')->paginate(6);
            $total_result = $this->PropertyModel ->where('address', $addressname)->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->count();

        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();

        $Allproperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
       $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();

        return view('all-properties', ['url_value' =>$url_value,'total_result' => $total_result,'featuremodelData' => $featuremodelData, 'AllProperty' => $Allproperty, 'Social_account' => $SocialAcounts, 'properties' => $properties, 'Agents' => $Agents, 'cities' => $cities, 'Adds' => $Adds]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($this->CityModel->store($request) == true) {
            $data = $this->CityModel->get();
            return view('admin.city', ['data' => $data])->with('Message', 'Your City Created Successfully...!');
        }
        //echo 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $edit = $this->CityModel->find($id);
        return view('admin.editcity', compact('edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if ($this->CityModel->Edit($request) == true) {
            $data = $this->CityModel->get();
            return view('admin.city', ['data' => $data])->with('Message', 'Your City Created Successfully...!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $city = $this->CityModel->destroy($id);
        //$data =$this->CityModel->get();
        return redirect()->action('CityController@index');
        //return view('admin.city',  ['data' => $data])->with('Message' , 'Your City Deleted Successfully...!');
    }

}
