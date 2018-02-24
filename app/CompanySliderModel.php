<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Validation;
use App\Http\Controllers\Controller;

class CompanySliderModel extends Model
{
     protected $table = "companyslider";
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','image_title','image_link','slider_image','created_at','updated_at','created_by','updated_by'
    ];
    
    public function store($request)
    {
        //dd($request);

        $inputData = [
            'image_title'    => $request->image_title,
            'image_link'  => $request->image_link,
            'slider_image'  => 'slider_image',
            'user_id' => Auth::user()->id,
            'created_by'    =>  Auth::user()->id
        ];

        //dump($inputData);
        $lastId = self::create($inputData);
        $insertedId = $lastId->id;

        if($request->hasFile('slider_image'))
        {
            $imageName = $insertedId.'.' . Input::file('slider_image')->getClientOriginalExtension();
            $this->where('id', $insertedId)->update(['slider_image' => $imageName]);

            for( $i = 0 ; $i <= 1 ; $i++)
            {
                if($i == 0){ $size = '1170x400_';   $width = '1170';  $height = '400';   }
                if($i == 1){ $size = '1470x605_';    $width = '1470';  $height = '605';  }

                $path = public_path('CompanySliderImage/' . $size.$imageName);

                \Image::make($request->file('slider_image')->getRealPath())->resize($width,$height)->save($path);

            }

        }


        return true;
    }
    
     public function updateslider($request)
    {

        $agentModel = $this->find($request->id);
        $agentModel->image_title = $request->image_title;
        $agentModel->image_link = $request->image_link;
        $agentModel->updated_by   =  Auth::user()->id;
        $agentModel->save();


        if($request->hasFile('slider_image'))
        {
            $imageName = $request->id. '.' . Input::file('slider_image')->getClientOriginalExtension();
            $this->where('id', $request->id)->update(['slider_image' => $imageName]);

            for( $i = 0 ; $i <= 1 ; $i++)
            {
                if($i == 0){ $size = '1170x400_';    $height = '400';   $width = '1170'; }
                if($i == 1){ $size = '1470x605_';    $height = '605';   $width = '1470'; }

                $path = public_path('/CompanySliderImage/' . $size.$imageName);

                \Image::make($request->file('slider_image')->getRealPath())->resize($height,$width)->save($path);

            }
        }
        return $this->where('user_id', Auth::user()->id)->get();;
    }

}
