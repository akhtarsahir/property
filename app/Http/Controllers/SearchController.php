<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;
use App\User;
use App\PropertyModel;
use App\SocialAcounts;
use App\CityModel;
use Illuminate\Http\Response;
use App\Adds;
use App\FeatureModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller {
    /*
     * load all intital files
     * */

    public function __construct() {
        $this->PropertyModel = new PropertyModel();
        $this->User = new User();
        $this->SocialAcounts = new SocialAcounts();
        $this->CityModel = new CityModel();
        $this->Adds = new Adds();
        $this->FeatureModel = new FeatureModel();
    }

    public function searchaddress(Request $request) {
        $term = $request->term;
        $properties = $this->PropertyModel->where('address', 'like', '%' . $term . '%')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        foreach ($properties as $query) {
            $data[] = array('value' => $query->address, 'id' => $query->id);
        }
        return response()->json($data);
    }

    /*
     * Search Data by Ajax on text filesd on change
     * */

    public function searchajax(Request $request) {
        $term = $request->term;
        $properties = $this->PropertyModel->where('title', 'like', '%' . $term . '%')->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->get();
        foreach ($properties as $query) {
            $data[] = array('value' => $query->title, 'id' => $query->id);
        }
        return response()->json($data);
    }

    public function SearchFormData_ddsdf_test() {
//       echo Input::get('price_from');
//            echo Input::get('price_to');
//            exit();
//        $total_property = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '1')->count();
//        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
//        $otherProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('type', '=', 'projects')->paginate(6);
//        $cities = $this->CityModel->get();
//        $SocialAcounts = $this->SocialAcounts->get();
//        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
//        $featuremodelData = $this->FeatureModel->get();
//
//
//
//        if (Input::get('city') != '' && Input::get('subtype') != '' && Input::get('purpose') != '' && Input::get('keyword') != '' && Input::get('keywordaddress') != '') {
//            $value = Input::get('city');
//            $keyword = Input::get('keyword');
//            $keywordaddress = Input::get('keywordaddress');
//            $properties = $this->PropertyModel
//                    ->where([['propertexpire', '>', date("Y-m-d")],
//                        ['status', '=', '1'],
//                        ['city', '=', Input::get('city')],
//                        ['purpose', '=', Input::get('purpose')], 
//                        ['subtype', '=', Input::get('subtype')],
//                        ['title', 'like', '%' . $keyword . '%'],
//                        ['address', 'like', '%' . $keywordaddress . '%'],
//                    ])
//                    ->paginate(10);
//            $total_property = $this->PropertyModel
//                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1'], ['city', '=', Input::get('city')], ['purpose', '=', Input::get('purpose')], ['subtype', '=', Input::get('subtype')]])
//                    ->count();
//            return view('search-result', ['value' => $value,'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
//        }
//        elseif (Input::get('city') != '' && Input::get('subtype') == 'All' && Input::get('purpose') == 'All' && Input::get('keyword') == '' && Input::get('keywordaddress') == '') {
//          $value = Input::get('city');
//            $keyword = Input::get('city');
//            $properties = $this->PropertyModel
//                    ->where([['propertexpire', '>', date("Y-m-d")],
//                        ['status', '=', '1'],
//                        ['city', '=', Input::get('city')],
//                    ])
//                    ->paginate(10);
//            $total_property = $this->PropertyModel
//                     ->where([['propertexpire', '>', date("Y-m-d")],
//                        ['status', '=', '1'],
//                        ['city', '=', Input::get('city')],
//                    ])
//                    ->count();
//            return view('search-result', ['value' => $value,'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
//        }
    }

    /*
     * Search Form submit Data
     *  */

    public function SearchFormData(Request $request) {
//       echo Input::get('price_from');
//            echo Input::get('price_to');
//            exit();
//        $total_property = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '1')->count();
        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $otherProperty = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '=', '1')->where('type', '=', 'projects')->paginate(6);
        $cities = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData = $this->FeatureModel->get();



        if (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') == 'Rs 5,000' && Input::get('price_to') == 'Rs 500,000') {

            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if only  price_to and price_from is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//           echo 'price';
            $strm = Input::get('price_from');
            $price_from = filter_var($strm, FILTER_SANITIZE_NUMBER_INT);
            $str = Input::get('price_to');
            $price_to = filter_var($str, FILTER_SANITIZE_NUMBER_INT);

            $properties = $this->PropertyModel
                    ->whereBetween('price', [$price_from, $price_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
//                    ->orwhere([
//                        ['price', '>=', $price_from], ['price', '<=', $price_to]])
//                    ->where([['propertexpire', '>', date("Y-m-d")],
//                        ['status', '=', '1']
//                    ])
                    ->whereBetween('price', [$price_from, $price_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
//-----if only  keyword is selected   
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//        echo "keyword"; 
//        exit();
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
//-----if only  Address (keywordaddress) is selected   
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//        echo "keywordaddress"; 
//        exit();
            $keywordaddress = Input::get('keywordaddress');
            $keyword = Input::get('keywordaddress');
//           echo $keywordaddress;
//           exit();
            $properties = $this->PropertyModel
                    ->where([
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['address', 'like', '%' . $keyword . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if only  city is selected    
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo "city"; 
//           exit();
            $value = Input::get('city');
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
//-----if only  purpose is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo "purpose"; 
//           exit();
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
//-----if only  subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//             echo "subtype";
//             exit();
            $properties = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if only  Land area(area_unit) is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//            echo 'Land area(area_unit)';
            $keyword = Input::get('area_unit');
            $properties = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if two   Land area, area_from  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'area_unit from';    
            $keyword = Input::get('area_from') . "" . Input::get('area_unit');
            $properties = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['area', '=', Input::get('area_from')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['area', '=', Input::get('area_from')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two  Land area, area_to is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'area_unit to';    
            $keyword = Input::get('area_to') . "" . Input::get('area_unit');
            $properties = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['area', '=', Input::get('area_to')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['area_unit', '=', Input::get('area_unit')],
                        ['area', '=', Input::get('area_to')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'area_unit from and to ';    
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . "" . Input::get('area_unit');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
//                    ->orderBy('area', 'ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if two  city ,purpose is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//          echo 'city an pursose';         
//          exit();
            $value = Input::get('city');
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   city ,subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//          echo 'city an subtype';        
//          exit();
            $value = Input::get('city');
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   city  and keyword is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//          echo " keyword and city"; 
//          exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   city  and address (keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keywordaddress');
//          echo " keywordaddress and city"; 
//          exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['address', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['address', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }


        //-----if two   keyword and purpose is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//          echo " keyword and purpose";
//          exit();
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   keyword and subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//         echo "keyword and subtype"; 
//         exit();
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two   keyword and address keywordaddress is selected           
        elseif (Input::get('keyword') != '' && Input::get('keywordaddress') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            echo "address keywordaddress ";
            exit();
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if two  address (keywordaddress) and purpose is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//         echo "keyword and subtype"; 
//         exit();
            $keyword = Input::get('keywordaddress');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['purpose', '=', Input::get('purpose')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['purpose', '=', Input::get('purpose')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two  address (keywordaddress) and subtype is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//         echo "keyword and subtype"; 
//         exit();
            $keyword = Input::get('keywordaddress');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two  purpose and subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//         echo "purpose and subtype"; 
//         exit();
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['subtype', '=', Input::get('subtype')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if two Land area unit, city is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_unit') . " in " . Input::get('city');

            $properties = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two Land area unit,purpose is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'purpose ';  
            $keyword = Input::get('area_unit') . " for " . Input::get('purpose');

            $properties = $this->PropertyModel
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', [ 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two Land area unit,subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'subtype ';  
            $keyword = Input::get('area_unit') . " for " . Input::get('subtype');

            $properties = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two Land area unit,keyword is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'keyword ';  
            $keyword = Input::get('keyword');

            $properties = $this->PropertyModel
                    ->where([['title', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['title', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', [ 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two Land area unit,keywordaddress is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'keywordaddress ';  
            $keyword = Input::get('keywordaddress');

            $properties = $this->PropertyModel
                    ->where([['address', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['address', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', [ 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if two Land area unit, price is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('area_unit');
//           echo 'price';
            $strm = Input::get('price_from');
            $price_from = filter_var($strm, FILTER_SANITIZE_NUMBER_INT);
            $str = Input::get('price_to');
            $price_to = filter_var($str, FILTER_SANITIZE_NUMBER_INT);

            $properties = $this->PropertyModel
                    ->whereBetween('price', [$price_from, $price_to])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->whereBetween('price', [$price_from, $price_to])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', [ 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }


        //-----if three city, purpose ,subtype field is selected    
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {

//              echo " city, purpose ,subtype"; 
//              exit();
            $value = Input::get('city');
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three city, address(keywordaddress) ,subtype field is selected    
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {

//              echo " city, address(keywordaddress) ,subtype"; 
//              exit();
            $value = Input::get('city');
            $keyword = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', '=', Input::get('keywordaddress')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', '=', Input::get('keywordaddress')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if three  city, address(keywordaddress) ,purpose field is selected    
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {

//              echo " city, address(keywordaddress) ,purpose"; 
//              exit();
            $value = Input::get('city');
            $keyword = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', '=', Input::get('keywordaddress')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', '=', Input::get('keywordaddress')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword,purpose and subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//             echo 'keyword,purpose and subtype';
//                          exit();
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword, address(keywordaddress) and subtype is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//             echo 'keyword,address(keywordaddress) and subtype';
//                          exit();
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword, address(keywordaddress) and purpose is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//             echo 'keyword,address(keywordaddress) and purpose';
//                          exit();
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword, address(keywordaddress) and city is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') != 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//             echo 'keyword,address(keywordaddress) and city';
//                          exit();
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword,city and subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//          echo 'keyword,city and subtype';
//                          exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  three   keyword,city and purpose is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//          echo 'keyword,city and subtype';
//                          exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if four purpose,  Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'purpose area_unit from and to ';   
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if four subtype,  Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'subtype area_unit from and to ';   
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . "" . Input::get('area_unit') . " for " . Input::get('subtype');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if four keyword,  Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'keyword area_unit from and to ';   
            $keyword = Input::get('keyword');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where([['title', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['title', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if four keywordaddress,  Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'keywordaddress area_unit from and to ';   
            $keyword = Input::get('keywordaddress');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where([['address', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['address', 'like', '%' . $keyword . '%']])
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if four city,  Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  four   keyword,city ,purpose and subtype is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
//            echo "keyword,city ,purpose and subtype "; 
//            exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if four keyword,city ,purpose and address(keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
//            echo "keyword,city ,purpose and keywordaddress "; 
//            exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  four   keyword,city ,subtype and address(keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
//            echo "keyword,city ,subtype and keywordaddress "; 
//            exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['city', '=', Input::get('city')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  four   keyword,purpose ,subtype and address(keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
//            echo "keyword,purpose ,subtype and keywordaddress "; 
//            exit();
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if  four  city,purpose ,subtype and address(keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keywordaddress');
            $keywordaddress = Input::get('keywordaddress');
//            echo "keywordaddress,purpose ,subtype and city "; 
//            exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if five city, purpose, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'purpose area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if five subtype, purpose, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'subtype purpose area_unit from and to ';   
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if five city, subtype, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') == 'All' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'subtype area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('subtype');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        //-----if Five  keyword ,city,purpose ,subtype and address(keywordaddress) is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') == '' && Input::get('area_from') == '' && Input::get('area_to') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keyword = Input::get('keyword');
            $keywordaddress = Input::get('keywordaddress');
//            echo "keywordaddress,purpose ,subtype and city "; 
//            exit();
            $value = Input::get('city');
            $properties = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['city', '=', Input::get('city')],
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keywordaddress . '%'],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();

            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        //-----if six, city, subtype,purpose, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'city purpose subtype area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
            $properties = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
        
       //-----if seven ,keyword, city, subtype,purpose, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') == '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'city purpose subtype area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
             $key = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where('title', 'like', '%' . $key . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('title', 'like', '%' . $key . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
       //-----if seven ,keywordaddress, city, subtype,purpose, Land area, area_from, area_to  is selected           
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
//           echo 'keywordaddress city purpose subtype area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
             $key = Input::get('keywordaddress');
            $properties = $this->PropertyModel
                    ->where('address', 'like', '%' . $key . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('address', 'like', '%' . $key . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value, 'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }

        // ----if all the field is selected than 
        elseif (Input::get('keywordaddress') != '' && Input::get('keyword') != '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('area_unit') != '' && Input::get('area_from') != '' && Input::get('area_to') != '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
            $keywordaddress = Input::get('keywordaddress');
//                echo 'keywordaddress city purpose subtype area_unit from and to ';   
            $value = Input::get('city');
            $keyword = Input::get('area_from') . " to " . Input::get('area_to') . " " . Input::get('area_unit') . " in " . Input::get('city') . " for " . Input::get('purpose');
            $area_from = Input::get('area_from');
            $area_to = Input::get('area_to');
//            echo $area_from .'='.$area_to;
             $key = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where('title', 'like', '%' . $key . '%')
                    ->where('address', 'like', '%' . $keywordaddress . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->orderBy('area', ' ASC')
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where('title', 'like', '%' . $key . '%')
                    ->where('address', 'like', '%' . $keywordaddress . '%')
                    ->where('city', '=', Input::get('city'))
                    ->where('purpose', '=', Input::get('purpose'))
                    ->where('subtype', '=', Input::get('subtype'))
                    ->where('area_unit', '=', Input::get('area_unit'))
                    ->whereBetween('area', [$area_from, $area_to])
                    ->where('propertexpire', '>', date("Y-m-d"))
                    ->where('status', '=', '1')
                    ->count();
            return view('search-result', ['value' => $value,'total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        } 
        // else condition 
        else {
//            echo 'nulll';
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->count();
            return view('search-result', ['total_property' => $total_property, 'SearchProperty' => $properties, 'keyword' => $keyword, 'keyword' => $keyword, 'featuremodelData' => $featuremodelData, 'Adds' => $Adds, 'Social_account' => $SocialAcounts, 'AllProperty' => $otherProperty, 'Agents' => $Agents, 'cities' => $cities]);
        }
    }

}
