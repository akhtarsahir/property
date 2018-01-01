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

class LogoModel extends Model
{
   protected $table = "logosite";
    protected $primaryKey = 'id';
    
      protected $fillable = [
        'image'
    ];
        public function Edit($request)
    {     
        $adds = $this->find($request->id);

        $adds->image      = $request->image;
        $adds->save();

        $insertedId = $request->id;

        if( $request->hasFile('image') )
        {
            $imageName = $insertedId.'.'.Input::file('image')->getClientOriginalExtension();
            $this->where('id', $insertedId)->update(['image' => $imageName]);

            $FolderCreate = public_path('/LogoImages/');
            if(!is_dir($FolderCreate)){   File::makeDirectory($FolderCreate, 0777, true, true);          }

            for( $i = 0 ; $i <= 1 ; $i++)
            {
                if($i == 0){ $size = '300x80_';  $height = '300';  $width = '80'; }
                if($i == 1){ $size = '245x71_'; $height = '245'; $width = '71'; }

                $path = public_path('LogoImages/'.$size.$imageName);
                Image::make($request->file('image')->getRealPath())->resize($height,$width)->save($path);
            }

        }
        return true;
    }
}
