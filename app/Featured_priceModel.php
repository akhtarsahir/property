<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured_priceModel extends Model
{
   protected $table = "featuredprice";
    protected $primaryKey = 'price_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'premium_homepageprice','featured_homepageprice','premium_listpageprice','featured_listpageprice'
    ];
    /*
 * The Function saving data
 * */
    public function update_price($request){
        //dd($request);


        $updatingData = [
            'premium_homepageprice'        => $request->premium_homepageprice,
            'featured_homepageprice'        => $request->featured_homepageprice,
            'premium_listpageprice'        => $request->premium_listpageprice,
            'featured_listpageprice'        => $request->featured_listpageprice
        ];

//        dd($updatingData);
        $this->where('price_id', $request->id)
            ->update($updatingData);
        return true;

    }
}
