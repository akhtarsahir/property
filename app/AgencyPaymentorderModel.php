<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AgencyPaymentorderModel extends Model
{
     //

   protected $table = "agencypaymentorders";
    protected $primaryKey = 'agencypayementorder_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agencyorder_id','user_id','order_no','transferId','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
       public function store($request)
    {
        $this->agencyorder_id          = $request->agencyorder_id;
        $this->user_id       = $request->user_id;
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
//            'agencypayementorder_id'           => $request->agencypayementorder_id,
            'agencyorder_id'           => $request->agencyorder_id,
            'user_id'        => $request->user_id,
            'order_no'     => $request->order_no,
            'transferId'     => $request->transferId,
            'status'             =>'0',
            'updated_by'         => Auth::user()->id,
        ];

//        dd($updatingData);
        $this->where('agencypayementorder_id', $request->agencypayementorder_id)
            ->update($updatingData);
        return true;

    }
   public function delete_paymentorder($id)
    {
        $this->destroy($id);
        return true;
    }
}
