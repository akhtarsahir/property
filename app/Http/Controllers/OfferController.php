<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\OfferModel;
use Session;
use Illuminate\Support\Facades\Redirect;

class OfferController extends Controller {

    public function __construct() {

        $this->OfferModel = new OfferModel();
    }

    public function store(Request $request) {

        if($this->OfferModel->store($request) == true){
            
         return redirect()->action('OfferController@view_banneroffer')->with('Message', 'Your offer Submit Successfully...!');
        }
    }

    public function index() {
        return view('admin.add_offer', compact('data'));
    }
    public function view_banneroffer() {
         $data =$this->OfferModel->get();
        return view('admin.view_offer', compact('data'));
    }
    public function edit_offer($id) {
        $data =$this->OfferModel->where('id',$id)->get();
        return view('admin.edit_offer', compact('data'));
    }

    public function update(Request $request) {
        //
        if ($this->OfferModel->Edit($request) == true) {
            return redirect()->action('OfferController@view_banneroffer')->with('Message', 'Your update Submit Successfully...!');
        }
    }
    
      public function delete_offer($id) {
          $this->OfferModel->destroy($id);
        return Redirect::action('OfferController@view_banneroffer')->with('delete', 'offer Deleted Successfully!');
    }

}
