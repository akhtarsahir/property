<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Contactuspropertyinfo extends Model

  {
       protected $table = "contactus_propertyinfo";
       protected $primaryKey = 'id';
    
      protected $fillable = [
        'email','phone','name','message','status','property_id'
    ];
      
       public function store($request){

        $this->email     = $request->email;
        $this->phone     = $request->phone;
        $this->name     = $request->name;
        $this->message     = $request->message;
        $this->created_by     = Auth::user()->id;
        $this->updated_by     = Auth::user()->id;
        $this->property_id     = $request->id;
        $this->status     = '2';
        
        $this->save();

        return true;
    }
    
        public function Edit($request)
    {
        $this->where('id', $request->id)
            ->update(['email' => $request->email,'phone' => $request->phone,'name' => $request->name,'message' => $request->message,'status' => $request->status]);
        return true;
    }
    // status active and inactive
    function markuserAs($id,$value) {
 
        $stmt =  Contactuspropertyinfo::where('id', $id)->update(array('status' => $value));
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}
