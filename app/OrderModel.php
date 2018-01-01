<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class OrderModel extends Model
{
 
   protected $table = "orders";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','property_id','property_title','featured_category','featured_expire','featured_price','featured_city','payment_option','status','payment_TID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
       public function store($request)
    {
        $this->order_id          = $request->order_id;
        $this->property_id       = $request->property_id;
        $this->property_title    = $request->property_title;
        $this->featured_price    = $request->featured_price;
        $this->payment_option    = $request->payment_option;
        $this->featured_category =$request->featured_category;
        $this->featured_city      =$request->featured_city;
        $this->featured_expire   = date("Y-m-d", strtotime("+".$request->featured_expire." month", strtotime(date('Y-m-d'))));
        $this->status            = '0';
        $this->payment_TID            = '3';
        $this->created_by        = Auth::user()->id;
        $this->updated_by       = '0';
   
        $this->save();
       
        $insertedId = $this->id;
//        echo $insertedId;
//        exit();
        return $insertedId;

    }
    /*
 * The Function saving data
 * */
    public function update_order($request){
        //dd($request);


        $updatingData = [
//            'id'           => $request->id,
            'order_id'           => $request->order_id,
            'property_id'        => $request->property_id,
            'property_title'     => $request->property_title,
            'featured_price'     => $request->featured_price,
            'payment_option'     => $request->payment_option,
            'featured_category'  => $request->featured_category,
            'featured_city'       => $request->featured_city,
            'featured_expire'    => date("Y-m-d", strtotime("+".$request->featured_expire." month", strtotime(date('Y-m-d')))),
            'status'             =>'0',
            'updated_by'         => Auth::user()->id,
        ];

//        dd($updatingData);
        $this->where('id', $request->id)
            ->update($updatingData);
        return true;

    }
   public function delete_order($id)
    {
        $this->destroy($id);
        return true;
    }
}
