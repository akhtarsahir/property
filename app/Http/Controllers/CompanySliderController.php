<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\CompanySliderModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CompanySliderController extends Controller
{
    public function __construct() {
        $this->User = new User();
        $this->CompanySliderModel = new CompanySliderModel();
    }
    public function save(Request $request){
          if($this->CompanySliderModel->store($request)== true)
          {
          return Redirect::action('UserController@view_user')->with('success12', 'Company slider image store Successfully!');
          }
    }
     public function companyslider_delete($id) {
        $this->CompanySliderModel->where('id',$id)->delete();
        return Redirect::action('UserController@view_user')->with('success13', 'Slider Image delete Successfully!');
    }
}
