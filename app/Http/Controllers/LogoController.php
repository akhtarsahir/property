<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\LogoModel;
use Session;
use Illuminate\Support\Facades\Redirect;

class LogoController extends Controller
{
    public function __construct()
    {
        
        $this->LogoModel = new LogoModel();
    }
public function index(){
    
    $data =$this->LogoModel->get();
        return view('admin.edit_logosite', compact('data'));
}
public function update(Request $request)
    {
        //
        if($this->LogoModel->Edit($request) == true)
        {
              $data =$this->LogoModel->get();
           return redirect()->action('LogoController@index')->with('Message', 'Your update Submit Successfully...!');

        }
    }
}
