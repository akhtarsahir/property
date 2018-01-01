<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Session;
use App\PaymentMethodModel;
use App\Featured_priceModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PropertyRequest;

class PaymentMethodController extends Controller
{
    
    public function __construct() {

        $this->PaymentMethodModel = new PaymentMethodModel();
        $this->Featured_priceModel = new Featured_priceModel();

    }

    public function add_paymentMethod() {

        return view('admin.add_paymentmethod');
    }

    public function paymentmethod_store(Request $request) {

        if ($this->PaymentMethodModel->store($request) == true) {
            return redirect()->action('PaymentMethodController@View_paymentmethod');
        }
    }

    public function View_paymentmethod(Request $request) {
       
        $paymentmethod = $this->PaymentMethodModel->get();
        return view('admin.view_paymentmethod', ['paymentmethod' => $paymentmethod]);
    }

    public function edit_paymentmethod($id) {

        $paymentmethod = $this->PaymentMethodModel->where('id', $id)->get();
       

        return view('admin.edit_paymentmethod', ['paymentmethod' => $paymentmethod] );
    }

    public function Update_paymentmethod(Request $request) {
//        dd($request);
        if ($this->PaymentMethodModel->update_paymentmethod($request) == true) {
            return redirect()->action('PaymentMethodController@View_paymentmethod');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_paymentmethod($id) {
        if ($this->PaymentMethodModel->delete_paymentmethod($id) == true) {
            return redirect()->action('PaymentMethodController@View_paymentmethod');
        }
    }
    
//    featured price ste 
    public function set_featuredprice() {
      $price_set = $this->Featured_priceModel->get();
       return view('admin.featured_priceSet',['price_set'=>$price_set]);
    }
    public function price_update(Request $request) {
//        echo 'ali';exit();
        if ($this->Featured_priceModel->update_price($request) == true) {
           
            return redirect()->action('PaymentMethodController@set_featuredprice')->with('success', 'Price Update Successfully!');
        }
    }

}
