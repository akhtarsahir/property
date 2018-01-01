<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\PropertyFeatureModel;
use App\PropertyServiceModel;
use App\PropertyProjectModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use File;
class OfferModel extends Model
{
  protected $table = "offers";
    protected $primaryKey = 'id';
    
      protected $fillable = [
        'image','link','show'
    ];
      
      
       public function store($request)
    {

        //dd($request);
        $this->image            = $request->image;
        $this->link      = $request->link;
        $this->show           = $request->show;
        $this->save();

        $insertedId = $this->id;

        if( $request->hasFile('image') )
        {
            $imageName = $insertedId.'.'.Input::file('image')->getClientOriginalExtension();
            $this->where('id', $insertedId)->update(['image' => $imageName]);

            $FolderCreate = public_path('/offerImages/');
            if(!is_dir($FolderCreate)){   File::makeDirectory($FolderCreate, 0777, true, true);          }

            for( $i = 0 ; $i <= 1 ; $i++)
            {
               if($i == 0){ $size = '300x200_';  $height = '300';  $width = '200'; }
               if($i == 1){ $size = '300x80_';  $height = '300';  $width = '80'; }
               
                $path = public_path('offerImages/'.$size.$imageName);
                Image::make($request->file('image')->getRealPath())->resize($height,$width)->save($path);
            }

        }
        return true;
    }
        public function Edit($request)
    {     
        $adds = $this->find($request->id);
        $adds->image      = $request->oldimage;
        $adds->link      = $request->link;
        $adds->show      = $request->show;
        $adds->save();

        $insertedId = $request->id;

        if( $request->hasFile('image') )
        {
            $imageName = $insertedId.'.'.Input::file('image')->getClientOriginalExtension();
            $this->where('id', $insertedId)->update(['image' => $imageName]);

            $FolderCreate = public_path('/offerImages/');
            if(!is_dir($FolderCreate)){   File::makeDirectory($FolderCreate, 0777, true, true);          }

            for( $i = 0 ; $i <= 1 ; $i++)
            {
                 if($i == 0){ $size = '300x200_';  $height = '300';  $width = '200'; }
                if($i == 1){ $size = '300x80_';  $height = '300';  $width = '80'; }

                $path = public_path('offerImages/'.$size.$imageName);
                Image::make($request->file('image')->getRealPath())->resize($height,$width)->save($path);
            }

        }
        return true;
    }
}
