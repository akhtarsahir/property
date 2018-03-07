<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class MetatagModel extends Model {

    protected $table = "matatag";
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'description', 'keywords', 'title'
    ];

    public function Edit($request) {
        $this->where('id', $request->id)
                ->update([
                    'user_id' => Auth::user()->id,
                    'description' => $request->description,
                    'keywords' => $request->keywords,
                    'title' => $request->title
        ]);
        return true;
    }

}
