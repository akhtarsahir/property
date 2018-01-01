<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\PaymentOrderModel;
use App\PaymentMethodModel;
use App\Featured_priceModel;
use App\PropertyModel;
use App\OrderModel;
use App\CityModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PropertyRequest;

class OrderController extends Controller {

    public function __construct() {
         $this->PaymentOrderModel = new PaymentOrderModel ();
        $this->PaymentMethodModel = new PaymentMethodModel();
         $this->Featured_priceModel = new Featured_priceModel();
        $this->PropertyModel = new PropertyModel();
        $this->OrderModel = new OrderModel ();
        $this->CityModel = new CityModel ();
        $this->user = new User();
    }

    public function add_feature($id) {

        $order = (rand(10, 1000));
        $order = $this->orderID($order);

        $property = $this->PropertyModel->where('id', $id)->get();

        $cities = $this->CityModel->get();
        $PaymentMethod = $this->PaymentMethodModel->get();
        $pricefeatured = $this->Featured_priceModel->get();
        return view('admin.add_feature', ['pricefeatured' => $pricefeatured,'property' => $property, 'cities' => $cities, 'order' => $order,'PaymentMethod' => $PaymentMethod]);
    }

    public function Orderdata_store(Request $request) {
        $id = DB::table('orders')-> insertGetId(array(
            'order_id'           => $request->order_id,
            'property_id'        => $request->property_id,
            'property_title'     => $request->property_title,
            'featured_price'     => $request->featured_price,
            'payment_option'     => $request->payment_option,
            'featured_category'  => $request->featured_category,
            'featured_city'       => $request->featured_city,
            'featured_expire'    => date("Y-m-d", strtotime("+".$request->featured_expire." month", strtotime(date('Y-m-d')))),
            'status'             =>'0',
            'created_by'         => Auth::user()->id,
            'updated_by'         => '0',
            'created_at'         => date('y-m-d'),
            'updated_at'         => date('y-m-d'),
           ));
//        echo $id;
//            exit();
//       $this->OrderModel->store($request);
         $feature_category = $this->OrderModel
              ->where('id', $id)
              ->first();
        $this->PropertyModel->where('id', $feature_category->property_id)->update(['featured_category' => '5','number' => '5',]);
            return redirect()->action('OrderController@thankyou_featureorder',$id);
    }
    public function thankyou_featureorder($id) {
         $paymentmenthod = $this->PaymentMethodModel->get();
            $last_order =$this->OrderModel->where('id',$id)->first();
            return view('admin.thankyou_featureorder',['last_order'=>$last_order,'paymentmenthod'=>$paymentmenthod]);

    }

    public function ViewOrders_List(Request $request) {
        if (Auth::user()->type == 'admin') {
            $Total_orders = $this->OrderModel->get();
        } else {
            $Total_orders = $this->OrderModel->where('created_by', '=', Auth::user()->id)->get();
        }
        $paymentmenthod = $this->PaymentMethodModel->get();
        return view('admin.view_orderlist', ['Total_orders' => $Total_orders,'paymentmenthod' => $paymentmenthod] );
    }

    public function edit_order($id) {

        $orderno = $this->OrderModel->where('id', $id)->get();
        foreach ($orderno as $order) {
            $date = date("Y-m-d", strtotime("+" . $order->featured_expire . " month", strtotime(date('Y-m-d'))));
            $moth_indatabase = date('m', strtotime($order->featured_expire));
            $year_indatabase = date('y', strtotime($order->featured_expire));
            $current_month = date("m");
            $current_year = date("y");
            if ($current_year == $year_indatabase) {
                $month = $moth_indatabase - $current_month;
            } elseif ($current_year < $year_indatabase) {
                $year2 = $moth_indatabase + 12;
                $month = $year2 - $current_month;
            }
        }
        $cities = $this->CityModel->get();
        $PaymentMethod = $this->PaymentMethodModel->get();
        $pricefeatured = $this->Featured_priceModel->get();
        return view('admin.edit_orderfeature', ['pricefeatured' => $pricefeatured,'orderno' => $orderno, 'cities' => $cities,'month' => $month,'PaymentMethod' => $PaymentMethod]
        );
    }

    public function update_order(Request $request) {
        //dd($request);
       
        if ($this->OrderModel->update_order($request) == true) {
            $propertyid = $request->property_id;
            $this->PropertyModel->where('id', $propertyid)->update(['number' => '2']);
            return redirect()->action('OrderController@ViewOrders_List');
        }
    }

    public function activate_order($id) {
        $this->OrderModel->where('id', $id)
                ->update(['status' => '1']);
        $feature_category = $this->OrderModel
              ->where('id', $id)
              ->first();
        $this->PropertyModel->where('id', $feature_category->property_id)->update([
            'number' => '1',
            'featured_expire' => $feature_category->featured_expire,
            'featured_category' => $feature_category->featured_category,
            'feature_city' => $feature_category->featured_city,
            ]);
        
        
        $this->PaymentOrderModel->where('order_id', $id)
                ->update(['status' => '1']);
        $idorderpayment = $this->PaymentOrderModel
              ->where('order_id', $id)
              ->first();
          $this->OrderModel->where('id', $idorderpayment->order_id)->update(['payment_TID' => '1']);
        return redirect()->action('OrderController@ViewOrders_List');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate_order($id) {
        $this->OrderModel->where('id', $id)
                ->update(['status' => '2']);
        $feature_category = $this->OrderModel
              ->where('id', $id)
              ->first();
        $this->PropertyModel->where('id', $feature_category->property_id)->update([
            'number' => '2',
            'featured_expire' => '',
            'featured_category' => '0',
            'feature_city' => '',
            ]);
        
         $this->PaymentOrderModel->where('order_id', $id)
                ->update(['status' => '2']);
        $idorderpayment = $this->PaymentOrderModel
              ->where('order_id', $id)
              ->first();
          $this->OrderModel->where('id', $idorderpayment->order_id)->update(['payment_TID' => '0']);
        return redirect()->action('OrderController@ViewOrders_List');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_order($id) {
        
         $feature_category = $this->OrderModel
              ->where('id', $id)
              ->first();
         $this->PaymentOrderModel->where('order_id', $id)->delete();
        $this->PropertyModel->where('id', $feature_category->property_id)->update([
            'number' => '2',
            'featured_expire' => '',
            'featured_category' => '0',
            'feature_city' => '',
            ]);
        $this->OrderModel->delete_order($id);
        if ($this->OrderModel->delete_order($id) == true) {
            
            return redirect()->action('OrderController@ViewOrders_List');
            
        }
    }

//    auto no gernate
    public function orderID($order) {

        $AlreadeyExist = $this->OrderModel->where('order_id', '=', $order)->select('id')->exists();

        if ($AlreadeyExist == true) {
            $AddDigit = $order . (rand(10, 1000));
            return $this->orderID($AddDigit);
        } else {
            return $order;
        }
    }
  
    
}
