<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CitySubAddresModel extends Model
{
   use SoftDeletes;
    /*
*The attributes that is used to define table name for this model.
*/
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = "citysubaddress";
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cityname','citysubaddress','latitude','longitude'
    ];


    /*
     * The Function saving data
     * */
    public function store($request){
       
        $this->cityname         = $request->cityname;
        $this->citysubaddress      = $request->citysubaddress;
        $this->latitude     = $request->latitude;
        $this->longitude    = $request->longitude;
        $this->save();
        return true;
    }

    public function Edit($request)
    {
        $this->where('id', $request->id)
            ->update(['cityname' => $request->cityname , 'citysubaddress' => $request->citysubaddress , 'latitude' => $request->latitude ,'longitude' => $request->longitude]);
        return true;
    }
}
