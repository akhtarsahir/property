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

class SearchController extends Controller
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
     * Search Data by Ajax on text filesd on change
     * */
    public function searchajax(Request $request)
    {
        $term = $request->term;
        $properties = $this->PropertyModel->where('title' , 'like' , '%'. $term .'%')->where('propertexpire' , '>' , date("Y-m-d")) ->where('status' , '=' , '1')->get();
        foreach ( $properties as $query ){
            $data[] = array('value' => $query->title, 'id' =>$query->id);
        }
        return response()->json($data);
    }

    /*
     * Search Form submit Data
     *  */
    public function  SearchFormData(Request $request)
    {
//       echo Input::get('price_from');
//            echo Input::get('price_to');
//            exit();
//        $total_property = $this->PropertyModel->where('propertexpire', '>', date("Y-m-d"))->where('status', '1')->count();
        $Agents = $this->User->where('BusinessType', '=', '2')->where('isActive', '=', '1')->get();
        $otherProperty =$this->PropertyModel->where('propertexpire' , '>' , date("Y-m-d")) ->where('status' , '=' , '1')->where('type' , '=' , 'projects')->paginate(6);
        $cities               = $this->CityModel->get();
        $SocialAcounts = $this->SocialAcounts->get();
        $Adds  = $this->Adds->where('status', '=', '1')->where('type', '=', 'Listing')->where('expiry_date', '>', date('Y-m-d H:i:s'))->get();
        $featuremodelData              = $this->FeatureModel->get();
        
        session_start();
        
        if (Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') == 'Rs 5,000' && Input::get('price_to') == 'Rs 500,000') {

              $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")],['status', '=', '1']])
                    ->count();
          return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  price_to and price_from is selected           
       elseif (Input::get('keyword') == '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
           $keyword = Input::get('keyword');
//           echo 'price';
              $strm = Input::get('price_from');
              $price_from = filter_var($strm, FILTER_SANITIZE_NUMBER_INT);
              $str = Input::get('price_to');
              $price_to = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
              
           $properties = $this->PropertyModel
                    ->orwhere([
                        ['price', '>=', $price_from],['price', '<=', $price_to]])
                    ->where([['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property = $this->PropertyModel
                  ->orwhere([
                        ['price', '>=', $price_from],['price', '<=', $price_to]])
                    ->where([['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
//-----if only  keyword is selected   
      elseif (Input::get('keyword') != '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
                        ['title','like', '%' . $keyword . '%'],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
//-----if only  city is selected           
        } 
        elseif (Input::get('keyword') == '' && Input::get('city') != ''&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
//-----if only  purpose is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') != ''&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
            $total_property =$this->PropertyModel
                    ->where([
                        ['purpose', '=', Input::get('purpose')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
//-----if only  subtype is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') != ''&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  OwnerShipStatus is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') != ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
//           echo 'OwnerShipStatus';    
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['OwnerShipStatus', '=', Input::get('OwnerShipStatus')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property =$this->PropertyModel
                    ->where([
                        ['OwnerShipStatus', '=', Input::get('OwnerShipStatus')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  kitchens is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') != ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
//           echo 'kitchens';    
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['kitchens', '=', Input::get('kitchens')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property =$this->PropertyModel
                    ->where([
                        ['kitchens', '=', Input::get('kitchens')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  beds is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') != ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
//           echo 'beds';    
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['beds', '=', Input::get('beds')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property =$this->PropertyModel
                    ->where([
                        ['beds', '=', Input::get('beds')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  bathroom is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') == 'All'&& Input::get('purpose') == 'All'&& Input::get('subtype') == 'All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') != ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
//           echo 'bathroom';    
            $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['bathroom', '=', Input::get('bathroom')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property =$this->PropertyModel
                    ->where([
                        ['bathroom', '=', Input::get('bathroom')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
 
         //-----if only  city ,purpose is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') == 'All' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
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
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        } 
        //-----if only  city ,subtype is selected           
        elseif (Input::get('keyword') == '' && Input::get('city') != ''&& Input::get('purpose') == 'All'&& Input::get('subtype') != '' && Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        } 
        //-----if only  keyword and city is selected           
        elseif (Input::get('keyword') != '' && Input::get('city') != ''&& Input::get('purpose') == 'All' && Input::get('subtype') == 'All' && Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
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
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        
        
        //-----if only  keyword and purpose is selected           
        elseif (Input::get('keyword') != '' && Input::get('city') =='All'&& Input::get('purpose') != ''&& Input::get('subtype') =='All'&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
        //-----if only  keyword and subtype is selected           
       elseif (Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') == 'All' && Input::get('subtype') !='' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {
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
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
       
        //-----if city, purpose ,subtype field is selected    
        elseif (Input::get('keyword') == '' && Input::get('city') != '' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {

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
             return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
         
        }
        //-----if only  keyword,purpose and subtype is selected           
         elseif (Input::get('keyword') != '' && Input::get('city') == 'All' && Input::get('purpose') != '' && Input::get('subtype') != '' && Input::get('OwnerShipStatus') == '' && Input::get('kitchens') == '' && Input::get('beds') == '' && Input::get('bathroom') == '' && Input::get('price_from') != '' && Input::get('price_to') != '') {    
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
           return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
       
        //-----if only  keyword,city and subtype is selected           
        elseif (Input::get('keyword') != '' && Input::get('city') != ''&& Input::get('purpose') == 'All'&& Input::get('subtype') != ''&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
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
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
          //-----if only  keyword,city ,purpose and subtype is selected           
        elseif (Input::get('keyword') != '' && Input::get('city') != ''&& Input::get('purpose') != ''&& Input::get('subtype') != ''&& Input::get('OwnerShipStatus') == ''&& Input::get('kitchens') == ''&& Input::get('beds') == ''&& Input::get('bathroom') == '') {
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
           
           return view('search-result',  ['value'=>$value,'total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }


 // ----if all the field is selected than 
        elseif (Input::get('keyword') != '' && Input::get('city') != ''&& Input::get('purpose') != ''&& Input::get('subtype') != ''&& Input::get('OwnerShipStatus') != ''&& Input::get('kitchens') != ''&& Input::get('beds') != ''&& Input::get('bathroom') != ''&& Input::get('price_from') != ''&& Input::get('price_to') != '') {
           $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['OwnerShipStatus', '=', Input::get('OwnerShipStatus')],
                        ['kitchens', '=', Input::get('kitchens')],
                        ['beds', '=', Input::get('beds')],
                        ['bathroom', '=', Input::get('bathroom')],
                        ['price', '>=', Input::get('price_from')],
                        ['price', '<=', Input::get('price_to')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([
                        ['title', 'like', '%' . $keyword . '%'],
                        ['address', 'like', '%' . $keyword . '%'],
                        ['city', '=', Input::get('city')],
                        ['purpose', '=', Input::get('purpose')],
                        ['subtype', '=', Input::get('subtype')],
                        ['OwnerShipStatus', '=', Input::get('OwnerShipStatus')],
                        ['kitchens', '=', Input::get('kitchens')],
                        ['beds', '=', Input::get('beds')],
                        ['bathroom', '=', Input::get('bathroom')],
                        ['price', '>=', Input::get('price_from')],
                        ['price', '<=', Input::get('price_to')],
                        ['propertexpire', '>', date("Y-m-d")],
                        ['status', '=', '1']
                    ])
                    ->count();
             return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
       
        } 
       
        else {  
//            echo 'nulll';
              $keyword = Input::get('keyword');
            $properties = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")], ['status', '=', '1']])
                    ->paginate(10);
            $total_property = $this->PropertyModel
                    ->where([['propertexpire', '>', date("Y-m-d")],['status', '=', '1']])
                    ->count();
          return view('search-result',  ['total_property'=>$total_property,'SearchProperty' => $properties ,'keyword' => $keyword ,'keyword' => $keyword ,'featuremodelData' => $featuremodelData , 'Adds' => $Adds , 'Social_account' => $SocialAcounts ,'AllProperty' => $otherProperty , 'Agents' => $Agents , 'cities' => $cities]);
        }
    }
}
