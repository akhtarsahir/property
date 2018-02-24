<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\AgencyfeatureOrderModel;
use App\AgencyPaymentorderModel;
use App\PaymentMethodModel;
use App\CityModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AgencyPaymentorderController extends Controller
{
      public function __construct() {

        $this->AgencyfeatureOrderModel = new AgencyfeatureOrderModel ();
        $this->AgencyPaymentorderModel = new AgencyPaymentorderModel ();
         $this->PaymentMethodModel = new PaymentMethodModel();
        $this->CityModel = new CityModel ();
        $this->User = new User();
    }

    public function add_agencypaymentTID($id) {

        $orders = $this->AgencyfeatureOrderModel->where('id', $id)->get();
        return view('admin.add_agencypaymentTID', ['orders' => $orders]);
    }

    public function paymentOrderTID_store(Request $request) {

        if ($this->AgencyPaymentorderModel->store($request) == true) {
         $this->AgencyfeatureOrderModel->where('id', $request->agencyorder_id)->update(['payment_TID' => '2']);
            return redirect()->action('DashboardController@index')->with('success12', 'Company data update Successfully!');
        }
    }
    public function clickhere_store(Request $request) {

        if ($this->AgencyPaymentorderModel->store($request) == true) {
         $this->AgencyfeatureOrderModel->where('id', $request->agencyorder_id)->update(['payment_TID' => '2']);
            return redirect()->action('AgencyPaymentorderController@ViewagencyOrders_paymentList')->with('success12', 'Company data update Successfully!');
        }
    }

   public function ViewagencyOrders_paymentList() {
        if (Auth::user()->type == 'admin') {
            $Total_orders = $this->AgencyPaymentorderModel->join('agencyfeatureOrder', 'agencypaymentorders.agencyorder_id','=', 'agencyfeatureOrder.id')->get();
        } else {
            $Total_orders = $this->AgencyPaymentorderModel->join('agencyfeatureOrder', 'agencypaymentorders.agencyorder_id','=', 'agencyfeatureOrder.id')->where('agencypaymentorders.user_id', '=', Auth::user()->id)->get();
        }
           $paymentmenthod = $this->PaymentMethodModel->get();
//        $Total_orders = $this->PaymentOrderModel->get();
        return view('admin.viewagency_paymentList', ['Total_orders' => $Total_orders, 'paymentmenthod' => $paymentmenthod]);
    }
   public function single_paymentList($id) {
       
            $Total_orders = $this->AgencyPaymentorderModel
                    ->join('agencyfeatureOrder', 'agencypaymentorders.agencyorder_id','=', 'agencyfeatureOrder.id')
                    ->where('agencypaymentorders.agencyorder_id', '=', $id)
                    ->get();
             $paymentmenthod = $this->PaymentMethodModel->get();
        return view('admin.view_singleagencypaymentlist', ['Total_orders' => $Total_orders, 'paymentmenthod' => $paymentmenthod]);
    }

    public function edit_paymentTID($id) {

        $payments = $this->AgencyPaymentorderModel->where('agencypayementorder_id', $id)->get();
        $orderno = $this->AgencyfeatureOrderModel->where('id', $id)->get();
        return view('admin.edit_agencypaymentTID', ['orderno' => $orderno,'payments'=>$payments]
        );
    }

    public function update_paymentTID(Request $request) {
        //dd($request);
       
        if ($this->AgencyPaymentorderModel->update_paymentorder($request) == true) {
            $user_id = $request->user_id;
            $this->User->where('id', $user_id)->update(['feature_status' => '2']);
            $this->AgencyfeatureOrderModel->where('id', $request->agencyorder_id)->update(['status' => '2','payment_TID' => '2']);
            return redirect()->action('AgencyPaymentorderController@ViewagencyOrders_paymentList');
        }
    }

    public function activate_paymentTID($id) {
        $this->AgencyPaymentorderModel->where('payementorder_id', $id)
                ->update(['status' => '1']);
        $id = $this->AgencyPaymentorderModel
              ->where('payementorder_id', $id)
              ->first();
          $this->AgencyfeatureOrderModel->where('id', $id->order_id)->update(['payment_TID' => '1']);
        return redirect()->action('AgencyPaymentorderController@ViewagencyOrders_paymentList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate_paymentTID($id) {
        $this->AgencyPaymentorderModel->where('payementorder_id', $id)
                ->update(['status' => '2']);
          $id = $this->AgencyPaymentorderModel
              ->where('payementorder_id', $id)
              ->first();
          $this->AgencyfeatureOrderModel->where('id', $id->order_id)->update(['payment_TID' => '0']);
        return redirect()->action('AgencyPaymentorderController@ViewagencyOrders_paymentList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_paymentTID($id) {
        $order = $this->AgencyPaymentorderModel
              ->where('agencypayementorder_id', $id)
              ->first();
        $this->AgencyfeatureOrderModel->where('id', $order->agencyorder_id)->update(['payment_TID' => '3']);
        $agents = $this->User->where('id', $order->user_id)->update(['feature_status' => 0]);
        if ($this->AgencyPaymentorderModel->delete_paymentorder($id) == true) {
            return redirect()->action('AgencyPaymentorderController@ViewagencyOrders_paymentList');
        }
    }

  
    
}
