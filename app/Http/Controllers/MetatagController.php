<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\MetatagModel;
use Illuminate\Support\Facades\Redirect;

class MetatagController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
        $this->MetatagModel = new MetatagModel();
    }
    
     public function edit_metatag()
    {
         $data =$this->MetatagModel->get();
        return view('admin.edit_metatag', compact('data'))->with('Message' , 'Your Package Permission list Created Successfully...!');
    }
     public function update(Request $request)
    {     
     if($this->MetatagModel->Edit($request) == true)
        {
            $data =$this->MetatagModel->get();
           return redirect()->action('MetatagController@edit_metatag')->with('Message', 'Your Update Submit Successfully...!');

        }
    }
}
