<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\SocialAcounts;
use App\User;
use App\PropertyModel;
//use Request;
use App\CityModel;
use App\agentModel;
use App\Adds;
use App\FeatureModel;
use App\AboutUs;
use App\AgencyPaymentorderModel;
use App\PaymentOrderModel;
use App\PaymentMethodModel;
use App\Featured_priceModel;
use App\AgencyfeatureOrderModel;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

//use App\Http\Requests\PropertyRequest;

class AgencyController extends Controller {

    public function __construct() {
        $this->AgencyPaymentorderModel = new AgencyPaymentorderModel ();
        $this->PaymentOrderModel = new PaymentOrderModel ();
        $this->PaymentMethodModel = new PaymentMethodModel();
        $this->Featured_priceModel = new Featured_priceModel();
        $this->AgencyfeatureOrderModel = new AgencyfeatureOrderModel();
        $this->SocialAcounts = new SocialAcounts();
        $this->User = new User();
        $this->PropertyModel = new PropertyModel();
        $this->CityModel = new CityModel();
        $this->agentModel = new agentModel();
        $this->Adds = new Adds();
        $this->FeatureModel = new FeatureModel();
        $this->AboutUs = new AboutUs();
    }

    public function add_Orderfeature_Agency($id) {

        $order = (rand(10, 1000));
        $order = $this->orderID($order);

        $property = $this->User->where('id', $id)->get();

        $cities = $this->CityModel->get();
        $PaymentMethod = $this->PaymentMethodModel->get();
        $pricefeatured = $this->Featured_priceModel->get();
        return view('admin.add_Orderfeature_Agency', ['pricefeatured' => $pricefeatured, 'property' => $property, 'cities' => $cities, 'order' => $order, 'PaymentMethod' => $PaymentMethod]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function agency_FeatureOrderStore(Request $request) {
        $id = DB::table('agencyfeatureOrder')->insertGetId(array(
            'order_no' => $request->order_no,
            'user_id' => $request->user_id,
            'agency_name' => $request->agency_name,
            'featured_price' => $request->featured_price,
            'payment_option' => $request->payment_option,
            'featured_category' => $request->featured_category,
            'featured_city' => $request->featured_city,
            'featured_expire' => date("Y-m-d", strtotime("+" . $request->featured_expire . " month", strtotime(date('Y-m-d')))),
            'status' => '0',
            'created_by' => Auth::user()->id,
            'updated_by' => '0',
            'created_at' => date('y-m-d'),
            'updated_at' => date('y-m-d'),
        ));
//        echo $id;
//            exit();
        $feature_category = $this->AgencyfeatureOrderModel
                ->where('id', $id)
                ->first();
        $this->User->where('id', $feature_category->user_id)->update(['feature_status' => '0']);
        return redirect()->action('AgencyController@thanku_agencyfeatured', $id);
    }

    public function thanku_agencyfeatured($id) {
        $paymentmenthod = $this->PaymentMethodModel->get();
        $last_order = $this->AgencyfeatureOrderModel->where('id', $id)->first();
        return view('admin.thanku_agencyfeatured', ['last_order' => $last_order, 'paymentmenthod' => $paymentmenthod]);
    }

    public function ViewOrders_List(Request $request) {
        if (Auth::user()->type == 'admin') {
            $agents = $this->AgencyfeatureOrderModel->select('users.*', 'agencyfeatureOrder.*', 'agencyfeatureOrder.id as agencyfeatureOrder_id ')->join('users', 'agencyfeatureOrder.user_id', '=', 'users.id')->get();
        } else {
            $agents = $this->AgencyfeatureOrderModel->select('users.*', 'agencyfeatureOrder.*', 'agencyfeatureOrder.id as agencyfeatureOrder_id ')->join('users', 'agencyfeatureOrder.user_id', '=', 'users.id')->where('users.id', '=', Auth::user()->id)->get();
//       echo $agents;
//            exit();
            }
        $paymentmenthod = $this->PaymentMethodModel->get();
        return view('admin.all_featured_agent', ['agents' => $agents, 'paymentmenthod' => $paymentmenthod]);
    }

    //    agent featured listing 

    public function view_agent_all() {
        if (Auth::user()->type == 'admin') {
            $agents = $this->User->where('BusinessType', 2)->where('isActive', '=', '1')->get();
        } else {
            $agents = $this->User->where('BusinessType', 2)->where('isActive', '=', '1')->where('id', '=', Auth::user()->id)->get();
        }
        //dd($SellProperty);
        return view('admin/view_all_agents', ['agents' => $agents]);
    }
    
    public function edit_order($id) {

        $orderno = $this->AgencyfeatureOrderModel->where('id', $id)->get();
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
        return view('admin.edit_agencyOrderfeature', ['pricefeatured' => $pricefeatured,'orderno' => $orderno, 'cities' => $cities,'month' => $month,'PaymentMethod' => $PaymentMethod]
        );
    }

    public function update_order(Request $request) {
        //dd($request);
       
        if ($this->AgencyfeatureOrderModel->update_order($request) == true) {
            $userid = $request->user_id;
            $agents = $this->User->where('id', $userid)->update(['feature_status' => 2]);
            return redirect()->action('AgencyController@ViewOrders_List');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_order($id) {
        
         $feature_category = $this->AgencyfeatureOrderModel
              ->where('id', $id)
              ->first();
         $this->AgencyPaymentorderModel->where('agencyorder_id', $id)->delete();
         $agents = $this->User->where('id', $feature_category->user_id)->update(['feature_status' => 0]);
        if ($this->AgencyfeatureOrderModel->delete_order($id) == true) {
            
            return redirect()->action('AgencyController@ViewOrders_List');
            
        }
    }

//    add featured agent 
    public function addfeature_agent($id) {
        $this->AgencyfeatureOrderModel->where('user_id', $id)
                ->update(['status' => '1', 'payment_TID' => '1']);
        $agents = $this->User->where('id', $id)->update(['feature_status' => 1]);

        $this->AgencyPaymentorderModel->where('user_id', $id)
                ->update(['status' => '1']);
        return Redirect::action('AgencyController@ViewOrders_List');
    }

//    reject featured agent 
    public function rejectfeature_agent($id) {
        $this->AgencyfeatureOrderModel->where('user_id', $id)
                ->update(['status' => '2', 'payment_TID' => '0']);
        $agents = $this->User->where('id', $id)->update(['feature_status' => 2]);

        $this->AgencyPaymentorderModel->where('user_id', $id)
                ->update(['status' => '2']);
        return Redirect::action('AgencyController@ViewOrders_List');
    }

    //    auto no gernate
    public function orderID($order) {

//        $AlreadeyExist = $this->OrderModel->where('order_id', '=', $order)->select('id')->exists();
        $AlreadeyExist = "";

        if ($AlreadeyExist == true) {
            $AddDigit = $order . (rand(10, 1000));
            return $this->orderID($AddDigit);
        } else {
            return $order;
        }
    }

}
