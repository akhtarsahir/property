<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PaymentOrderModel extends Model
{
    //

   protected $table = "paymentorders";
    protected $primaryKey = 'payementorder_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id','property_id','order_no','transferId','status'
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
        $this->order_no    = $request->order_no;
        $this->transferId    = $request->transferId;
        $this->status            = '0';
        $this->created_by        = Auth::user()->id;
        $this->updated_by       = '0';
   
        $this->save();
       
        $insertedId = $this->id;
        return true;

    }
    /*
 * The Function saving data
 * */
    public function update_paymentorder($request){
        //dd($request);


        $updatingData = [
//            'payementorder_id'           => $request->payementorder_id,
            'order_id'           => $request->order_id,
            'property_id'        => $request->property_id,
            'order_no'     => $request->order_no,
            'transferId'     => $request->transferId,
            'status'             =>'0',
            'updated_by'         => Auth::user()->id,
        ];

//        dd($updatingData);
        $this->where('id', $request->payementorder_id)
            ->update($updatingData);
        return true;

    }
   public function delete_paymentorder($id)
    {
        $this->destroy($id);
        return true;
    }
}
