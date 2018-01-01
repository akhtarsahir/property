<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PaymentMethodModel extends Model
{

   protected $table = "paymentmethod";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method_name','description_acount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
       public function store($request)
    {
        $this->method_name          = $request->method_name;
        $this->description_acount       = $request->description_acount;
        $this->created_by        = Auth::user()->id;
        $this->updated_by       = '0';
   
        $this->save();
       
        $insertedId = $this->id;
        return true;

    }
    /*
 * The Function saving data
 * */
    public function update_paymentmethod($request){
        //dd($request);
        $updatingData = [
//            'id'           => $request->id,
            'method_name'           => $request->method_name,
            'description_acount'        => $request->description_acount,
            'updated_by'         => Auth::user()->id,
        ];

//        dd($updatingData);
        $this->where('id', $request->id)
            ->update($updatingData);
        return true;

    }
   public function delete_paymentmethod($id)
    {
        $this->destroy($id);
        return true;
    }
}
