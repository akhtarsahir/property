<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\PropertyModel;
use App\OrderModel;
use App\PaymentOrderModel;
use App\PaymentMethodModel;
use App\CityModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PropertyRequest;

class PaymentorderController extends Controller
{
    public function __construct() {

        $this->PropertyModel = new PropertyModel();
        $this->OrderModel = new OrderModel ();
        $this->PaymentOrderModel = new PaymentOrderModel ();
         $this->PaymentMethodModel = new PaymentMethodModel();
        $this->CityModel = new CityModel ();
        $this->user = new User();
    }

    public function add_paymentTID($id) {

        $orders = $this->OrderModel->where('id', $id)->get();
        return view('admin.add_paymentTID', ['orders' => $orders]);
    }

    public function paymentOrderTID_store(Request $request) {

        if ($this->PaymentOrderModel->store($request) == true) {
         $this->OrderModel->where('id', $request->order_id)->update(['payment_TID' => '2']);
            return redirect()->action('DashboardController@index')->with('success12', 'Company data update Successfully!');
        }
    }
    public function clickhere_store(Request $request) {

        if ($this->PaymentOrderModel->store($request) == true) {
         $this->OrderModel->where('id', $request->order_id)->update(['payment_TID' => '2']);
            return redirect()->action('PaymentorderController@ViewOrders_paymentList')->with('success12', 'Company data update Successfully!');
        }
    }

   public function ViewOrders_paymentList(Request $request) {
        if (Auth::user()->type == 'admin') {
            $Total_orders = $this->PaymentOrderModel->join('orders', 'paymentorders.order_id','=', 'orders.id')->get();
        } else {
            $Total_orders = $this->PaymentOrderModel->where('created_by', '=', Auth::user()->id)->join('orders', 'paymentorders.order_id','=', 'orders.id')->get();
        }
           $paymentmenthod = $this->PaymentMethodModel->get();
//        $Total_orders = $this->PaymentOrderModel->get();
        return view('admin.viewOrders_paymentList', ['Total_orders' => $Total_orders, 'paymentmenthod' => $paymentmenthod]);
    }
   public function single_paymentList($id) {
       
            $Total_orders = $this->PaymentOrderModel
                    ->join('orders', 'paymentorders.order_id','=', 'orders.id')
                    ->where('paymentorders.order_id', '=', $id)
                    ->get();
             $paymentmenthod = $this->PaymentMethodModel->get();
        return view('admin.view_singlepaymentorderlist', ['Total_orders' => $Total_orders, 'paymentmenthod' => $paymentmenthod]);
    }

    public function edit_paymentTID($id) {

        $payments = $this->PaymentOrderModel->where('payementorder_id', $id)->get();
        $orderno = $this->OrderModel->where('id', $id)->get();
        return view('admin.edit_paymentTID', ['orderno' => $orderno,'payments'=>$payments]
        );
    }

    public function update_paymentTID(Request $request) {
        //dd($request);
       
        if ($this->PaymentOrderModel->update_paymentorder($request) == true) {
            $propertyid = $request->property_id;
            $this->PropertyModel->where('id', $propertyid)->update(['number' => '2']);
            $this->OrderModel->where('id', $request->order_id)->update(['payment_TID' => '2']);
            return redirect()->action('PaymentorderController@ViewOrders_paymentList');
        }
    }

    public function activate_paymentTID($id) {
        $this->PaymentOrderModel->where('payementorder_id', $id)
                ->update(['status' => '1']);
        $id = $this->PaymentOrderModel
              ->where('payementorder_id', $id)
              ->first();
          $this->OrderModel->where('id', $id->order_id)->update(['payment_TID' => '1']);
        return redirect()->action('PaymentorderController@ViewOrders_paymentList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate_paymentTID($id) {
        $this->PaymentOrderModel->where('payementorder_id', $id)
                ->update(['status' => '2']);
          $id = $this->PaymentOrderModel
              ->where('payementorder_id', $id)
              ->first();
          $this->OrderModel->where('id', $id->order_id)->update(['payment_TID' => '0']);
        return redirect()->action('PaymentorderController@ViewOrders_paymentList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_paymentTID($id) {
        $order = $this->PaymentOrderModel
              ->where('payementorder_id', $id)
              ->first();
        $this->OrderModel->where('id', $id->order_id)->update(['payment_TID' => '0']);
        if ($this->PaymentOrderModel->delete_paymentorder($id) == true) {
            return redirect()->action('PaymentorderController@ViewOrders_paymentList');
        }
    }

  
    
    
}
