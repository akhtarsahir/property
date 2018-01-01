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




class PropertyModel extends Model
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
    protected $table = "property";
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'title0', 'property_type0', 'price0', 'beds0', 'bath0', 'property_size0','title1', 'property_type1', 'price1', 'beds1', 'bath1', 'property_size1','title2', 'property_type2', 'price2', 'beds2', 'bath2', 'property_size2','title3', 'property_type3', 'price3', 'beds3', 'bath3', 'property_size3',
        'title' ,'description',
        'purpose','type',
        'subtype',
        'propety_number',
        'street','sector',
        'city','region',
        'latitude',
        'longitude',
        'price',
        'Label',
        'ConstructedArea',
        'OpenArea',
        'ConstructionYear',
        'OwnerShipStatus',
        'floor',
        'image0',
        'image1',
        'image2',
        'image3',
        'image4',
        'paymentPlansImage0',
        'paymentPlansImage1',
        'paymentPlansImage2',
        'paymentPlansImage3',
        'paymentPlansImage4',
        'area',
        'area_unit',
        'beds',
        'bathroom',
        'kitchens',
        'powerroom',
        'propertexpire',
        'created_by',
        'remember_token',
        'status',
        'agent_id',
        'featured_expire',
        'featured_category',
        'feature_city'
        
    ];






    /*
     * The Function saving data
     * */
    public function store($request)
    {
        //dd(Input::file('image')[0]);
        //echo count(Input::file('image'));
        //dd(Input::file('image'));
        $ConstructedArea        = $request->ConstructedArea;
        $ConstructedAreaunit    = $request->CAarea_unit;
        $CAUnit                 = "$ConstructedArea"."$ConstructedAreaunit";
        $openArea               = $request->OpenArea;
        $openAreaunit           = $request->OAarea_unit;
        $OAUnit                 = "$openArea"."$openAreaunit";
        $this->purpose          = $request->purpose;
        $this->number           = '0';
        $this->type             = $request->type;
//        $this->type             = $request->type;
        $this->subtype          = $request->subtype;
        $this->city             = $request->city;
        $this->address          = $request->address;
        $this->latitude         = $request->latitude;
        $this->longitude        = $request->longitude;
        $this->title            = $request->title;
        $this->description      = $request->description;
        $this->area             = $request->area;
        $this->area_unit        = $request->area_unit;
        $this->Label            = $request->Label;
//        $this->ConstructedArea  = $request->ConstructedArea;
        $this->ConstructedArea  = $CAUnit;
//        $this->OpenArea         = $request->OpenArea;
        $this->OpenArea         = $OAUnit;
        $this->ConstructionYear = $request->ConstructionYear;
        $this->OwnerShipStatus  = $request->OwnerShipStatus;
        $this->beds             =  $request->beds;
        $this->bathroom         =  $request->bathroom;
        $this->floor            =  $request->floor;
        $this->kitchens         =  $request->kitchens;
        $this->height           = $request->height;
        $this->width            = $request->width;
        $this->price            = $request->price;
        $this->video_url        = $request->video_url;
        $this->agent_id         = $request->agent_id;
        $this->propertexpire    = date("Y-m-d", strtotime("+".$request->propertexpire." month", strtotime(date('Y-m-d'))));
        $this->remember_token   = $request->_token;
        $this->status           = '0';
        $this->created_by       = Auth::user()->id;
//        $this->created_by       = '0';
        $this->property_type0   =$request->property_type0;
        $this->price0           =$request->price0;
        $this->title0           =$request->title0;
        $this->beds0            =$request->beds0;
        $this->bath0            =$request->bath0;
        $this->property_size0   =$request->property_size0;
        $this->property_type1   =$request->property_type1;
        $this->price1           =$request->price1;
        $this->title1           =$request->title1;
        $this->beds1            =$request->beds1;
        $this->bath1            =$request->bath1;
        $this->property_size1   =$request->property_size1;
        $this->property_type2   =$request->property_type2;
        $this->price2           =$request->price2;
        $this->title2           =$request->title2;
        $this->beds2            =$request->beds2;
        $this->bath2            =$request->bath2;
        $this->property_size2   =$request->property_size2;
        $this->property_type3   =$request->property_type3;
        $this->price3           =$request->price3;
        $this->title3           =$request->title3;
        $this->beds3            =$request->beds3;
        $this->bath3            =$request->bath3;
        $this->property_size3   =$request->property_size3;
        $this->property_type4   =$request->property_type4;
        $this->price4           =$request->price4;
        $this->title4           =$request->title4;
        $this->beds4            =$request->beds4;
        $this->bath4            =$request->bath4;
        $this->property_size4   =$request->property_size4;
        $this->property_type5   =$request->property_type5;
        $this->price5           =$request->price5;
        $this->title5           =$request->title5;
        $this->beds5            =$request->beds5;
        $this->bath5            =$request->bath5;
        $this->property_size5   =$request->property_size5;
        $this->property_type6   =$request->property_type6;
        $this->price6           =$request->price6;
        $this->title6           =$request->title6;
        $this->beds6            =$request->beds6;
        $this->bath6            =$request->bath6;
        $this->property_size6   =$request->property_size6;
//        $this->featured_expire   =$request->featured_expire;
//        $this->featured_category   =$request->featured_category;
//        $this->feature_city   =$request->feature_city;
        
        $this->save();
       
        $insertedId = $this->id;

        //echo $insertedId;exit;
//echo count($request->hasFile('image'));exit;
        if($request->hasFile('image'))
        {
            for( $j = 0 ; $j < count(Input::file('image')) ; $j++)
            {
                $imageName = $j.'.'.Input::file('image')[$j]->getClientOriginalExtension();
                $this->where('id', $insertedId)->update(['image'.$j => '_'.$imageName]);
//                echo $j.'<br>';
                for( $i = 0 ; $i <= 7 ; $i++)
                {
                    if($i == 0){ $size = '355x240_';  $height = '355';  $width = '240'; }
                    if($i == 1){ $size = '1170x600_'; $height = '1170'; $width = '600'; }
                    if($i == 2){ $size = '750x388_';  $height = '750';  $width = '388'; }
                    if($i == 3){ $size = '100x75_';   $height = '100';  $width = '75';  }
                    if($i == 4){ $size = '370x202_';  $height = '370';  $width = '202'; }
                    if($i == 5){ $size = '364x244_';  $height = '364';  $width = '244'; }
                    if($i == 6){ $size = '385x258_';  $height = '385';  $width = '258'; }
                    if($i == 7){ $size = '194x143_';  $height = '194';  $width = '143'; }


                    //$Image = Input::file('image')->move(public_path() . '/propetyImages/'.Auth::user()->id.'/', $imageName);

                    $path = public_path('/propetyImages/'.$insertedId.'/'. $size.$imageName);
                    $FolderCreate = public_path('/propetyImages/'.$insertedId.'/');
                    if(!is_dir($FolderCreate))
                    {
                    File::makeDirectory($FolderCreate, 0777, true, true);
                    }

                    Image::make($request->file('image')[$j]->getRealPath())->resize($height,$width)->save($path);
                    // Image::make($request->file('image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);
                }
            }
            
            if($request->hasFile('paymentPlansImage')  != '')
            {
            for( $j = 0 ; $j < count(Input::file('paymentPlansImage')) ; $j++)
            {
                $paymentPlansImagesName = $j.'.'.Input::file('paymentPlansImage')[$j]->getClientOriginalExtension();
                $this->where('id', $insertedId)->update(['paymentPlansImage'.$j => '_'.$paymentPlansImagesName]);
//                echo $j.'<br>';
                for( $i = 0 ; $i <= 7 ; $i++)
                {
                    if($i == 0){ $size = '355x240_';  $height = '355';  $width = '240'; }
                    if($i == 1){ $size = '1170x600_'; $height = '1170'; $width = '600'; }
                    if($i == 2){ $size = '750x388_';  $height = '750';  $width = '388'; }
                    if($i == 3){ $size = '100x75_';   $height = '100';  $width = '75';  }
                    if($i == 4){ $size = '370x202_';  $height = '370';  $width = '202'; }
                    if($i == 5){ $size = '364x244_';  $height = '364';  $width = '244'; }
                    if($i == 6){ $size = '385x258_';  $height = '385';  $width = '258'; }
                    if($i == 7){ $size = '194x143_';  $height = '194';  $width = '143'; }
                    
                    $path = public_path('/propertypaymentPlansImage/'.$insertedId.'/'. $size.$paymentPlansImagesName);
                    $FolderCreate = public_path('/propertypaymentPlansImage/'.$insertedId.'/');
                    if(!is_dir($FolderCreate))
                    {
                    File::makeDirectory($FolderCreate, 0777, true, true);
                    }

                    Image::make($request->file('paymentPlansImage')[$j]->getRealPath())->resize($height,$width)->save($path);
                    // Image::make($request->file('image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);
                }
            }
        }     
      }
//            if($request->hasFile('pdf')) {
//                $pdf = time() . '.' . Input::file('pdf')->getClientOriginalExtension();
//                $this->where('id', $insertedId)->update(['pdf' => $pdf]);
//                Input::file('pdf')->move(public_path() . '/propetyImages/' . $insertedId. '/', $pdf);
//            }
//}
            
       $this->PropertyFeatureModel     = new PropertyFeatureModel;
        $this->PropertyServiceModel     = new PropertyServiceModel;
          if(!empty($request->feature )){
                $this->PropertyFeatureModel->store($request->feature , $insertedId , $request->type );
            }
            if(!empty($request->services)) {
                $this->PropertyServiceModel->store($request->services, $insertedId , $request->type);
            }

        return true;

    }




    /*
 * The Function saving data
 * */
    public function update_property($request){
        //dd($request);
        //dd(Input::file('new_image1'));


        $updatingData = [
            'purpose'          => $request->purpose,
            'number'           => $request->number,
            'type'             => $request->type,
            'subtype'          => $request->subtype,
            'city'             => $request->city,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'address'          => $request->address,
            'title'            => $request->title,
            'description'      => $request->description,
            'ConstructedArea'  => $request->ConstructedArea,
            'OpenArea'         => $request->OpenArea,
            'ConstructionYear' => $request->ConstructionYear,
            'OwnerShipStatus'  => $request->OwnerShipStatus,
            'beds'             => $request->beds,
            'bathroom'         =>  $request->bathroom,
            'floor'            => $request->floor,
            'kitchens'         => $request->kitchens,
            'area'             => $request->area,
            'area_unit'        => $request->area_unit,
            'height'           => $request->height,
            'width'            => $request->width,
            'price'            => $request->price,
            'video_url'        => $request->video_url,
            'agent_id'         => $request->agent_id,
            'propertexpire'    => date("Y-m-d", strtotime("+".$request->propertexpire." month", strtotime(date('Y-m-d')))),
            'remember_token'   => $request->_token,
            'status'           =>'0',
            'property_type0'   => $request->property_type0,
            'price0'           => $request->price0,
            'title0'           =>$request->title0,
            'beds0'            =>$request->beds0,
            'bath0'            =>$request->bath0,
            'property_size0'   =>$request->property_size0,
            'property_type1'   =>$request->property_type1,
            'price1'           =>$request->price1,
            'title1'           =>$request->title1,
            'beds1'            =>$request->beds1,
            'bath1'            =>$request->bath1,
            'property_size1'   =>$request->property_size1,
            'property_type2'   =>$request->property_type2,
            'price2'           =>$request->price2,
            'title2'           =>$request->title2,
            'beds2'            =>$request->beds2,
            'bath2'            =>$request->bath2,
            'property_size2'   =>$request->property_size2,
            'property_type3'   =>$request->property_type3,
            'price3'           =>$request->price3,
            'title3'           =>$request->title3,
            'beds3'            =>$request->beds3,
            'bath3'            =>$request->bath3,
            'property_size3'   =>$request->property_size3,
            'property_type4'   =>$request->property_type4,
            'price4'           =>$request->price4,
            'title4'           =>$request->title4,
            'beds4'            =>$request->beds4,
            'bath4'            =>$request->bath4,
            'property_size4'   =>$request->property_size4,
            'property_type5'   =>$request->property_type5,
            'price5'           =>$request->price5,
            'title5'           =>$request->title5,
            'beds5'            =>$request->beds5,
            'bath5'            =>$request->bath5,
            'property_size5'   =>$request->property_size5,
            'property_type6'   =>$request->property_type6,
            'price6'           =>$request->price6,
            'title6'           =>$request->title6,
            'beds6'            =>$request->beds6,
            'bath6'            =>$request->bath6,
            'property_size6'   =>$request->property_size6,
        ];

        //dd($updatingData);
        $this->where('id', $request->id)
            ->update($updatingData);


        if($request->hasFile('new_image0'))
        {
            $imageName = '0.'. Input::file('new_image0')->getClientOriginalExtension();

            $this->uploadimage($imageName , $request->old_image0 ,$request->id , $request->file('new_image0'));
            $this->where('id', $request->id)->update(['image0' => '_'.$imageName]);

        }

        if($request->hasFile('new_image1'))
        {
            $imageName = '1.'. Input::file('new_image1')->getClientOriginalExtension();

            $this->uploadimage($imageName , $request->old_image1 ,$request->id , $request->file('new_image1'));
            $this->where('id', $request->id)->update(['image1' => '_'.$imageName]);

        }

        if($request->hasFile('new_image2'))
        {
            $imageName =  '2.'. Input::file('new_image2')->getClientOriginalExtension();

            $this->uploadimage($imageName , $request->old_image2 ,$request->id , $request->file('new_image2'));
            $this->where('id', $request->id)->update(['image2' => '_'.$imageName]);

        }
        if($request->hasFile('new_image3'))
        {
            $imageName =  '3.'. Input::file('new_image3')->getClientOriginalExtension();

            $this->uploadimage($imageName , $request->old_image3 ,$request->id , $request->file('new_image3'));
            $this->where('id', $request->id)->update(['image3' => '_'.$imageName]);

        }
        if($request->hasFile('new_image4'))
        {
            $imageName =  '4.' . Input::file('new_image4')->getClientOriginalExtension();

            $this->uploadimage($imageName , $request->old_image4 ,$request->id , $request->file('new_image4'));
            $this->where('id', $request->id)->update(['image4' => '_'.$imageName]);

        }
        if($request->hasFile('new_paymentPlansImage0'))
        {
            $imageName = '0.'. Input::file('new_paymentPlansImage0')->getClientOriginalExtension();

            $this->uploadpaymentPlansImage($imageName , $request->old_paymentPlansImage0 ,$request->id , $request->file('new_paymentPlansImage0'));
            $this->where('id', $request->id)->update(['paymentPlansImage0' => '_'.$imageName]);

        }

        if($request->hasFile('new_paymentPlansImage1'))
        {
            $imageName = '1.'. Input::file('new_paymentPlansImage1')->getClientOriginalExtension();

            $this->uploadpaymentPlansImage($imageName , $request->old_paymentPlansImage1 ,$request->id , $request->file('new_paymentPlansImage1'));
            $this->where('id', $request->id)->update(['paymentPlansImage1' => '_'.$imageName]);

        }

        if($request->hasFile('new_paymentPlansImage2'))
        {
            $imageName =  '2.'. Input::file('new_paymentPlansImage2')->getClientOriginalExtension();

            $this->uploadpaymentPlansImage($imageName , $request->old_paymentPlansImage2 ,$request->id , $request->file('new_paymentPlansImage2'));
            $this->where('id', $request->id)->update(['paymentPlansImage2' => '_'.$imageName]);

        }
        if($request->hasFile('new_paymentPlansImage3'))
        {
            $imageName =  '3.'. Input::file('new_paymentPlansImage3')->getClientOriginalExtension();

            $this->uploadpaymentPlansImage($imageName , $request->old_paymentPlansImage3 ,$request->id , $request->file('new_paymentPlansImage3'));
            $this->where('id', $request->id)->update(['paymentPlansImage3' => '_'.$imageName]);

        }
        if($request->hasFile('new_paymentPlansImage4'))
        {
            $imageName =  '4.' . Input::file('new_paymentPlansImage4')->getClientOriginalExtension();

            $this->uploadpaymentPlansImage($imageName , $request->old_paymentPlansImage4 ,$request->id , $request->file('new_paymentPlansImage4'));
            $this->where('id', $request->id)->update(['paymentPlansImage4' => '_'.$imageName]);

        }

        $this->PropertyFeatureModel     = new PropertyFeatureModel;
        $this->PropertyServiceModel     = new PropertyServiceModel;

        if($this->PropertyFeatureModel->where('property_id', $request->id)->first()):
        $this->PropertyFeatureModel->where('property_id', $request->id)->delete();
            endif;
        if($this->PropertyServiceModel->where('property_id', $request->id)->first()):
        $this->PropertyServiceModel->where('property_id', $request->id)->delete();
            endif;

        if($request->feature):
        $this->PropertyFeatureModel->store($request->feature , $request->id , $request->type);
            endif;
        if($request->services):
        $this->PropertyServiceModel->store($request->services , $request->id , $request->type );
        endif;
        return true;

    }

    public function delete_property($id)
    {

//            for( $i = 0 ; $i <= 6 ; $i++)
//            {
//                if($i == 0){ $size = '355x240_';  $height = '355';  $width = '240'; }
//                if($i == 1){ $size = '1170x600_'; $height = '1170'; $width = '600'; }
//                if($i == 2){ $size = '750x388_';  $height = '750';  $width = '388'; }
//                if($i == 3){ $size = '100x75_';   $height = '100';  $width = '75';  }
//                if($i == 4){ $size = '370x202_';  $height = '370';  $width = '202'; }
//                if($i == 5){ $size = '364x244_';  $height = '364';  $width = '244'; }
//                if($i == 6){ $size = '385x258_';  $height = '385';  $width = '258'; }
//
//                $this->delete_image(public_path() . '/propetyImages/'.$request->created_by.'/'.$size.$request->old_image);
//            }



        $this->destroy($id);
        return true;
    }


    public  function uploadimage($imageName , $old_image ,$id , $requestfile){


        for( $i = 0 ; $i <= 6 ; $i++)
        {
            if($i == 0){ $size = '355x240_';  $height = '355';  $width = '240'; }
            if($i == 1){ $size = '1170x600_'; $height = '1170'; $width = '600'; }
            if($i == 2){ $size = '750x388_';  $height = '750';  $width = '388'; }
            if($i == 3){ $size = '100x75_';   $height = '100';  $width = '75';  }
            if($i == 4){ $size = '370x202_';  $height = '370';  $width = '202'; }
            if($i == 5){ $size = '364x244_';  $height = '364';  $width = '244'; }
            if($i == 6){ $size = '385x258_';  $height = '385';  $width = '258'; }


            $this->delete_image(public_path() . '/propetyImages/'.$id.'/'.$size.$old_image);
            $path = public_path('/propetyImages/'.$id.'/' . $size.$imageName);

            Image::make($requestfile->getRealPath())->resize($height,$width)->save($path);
            // Image::make($request->file('new_image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);

        }

    }
    public  function uploadpaymentPlansImage($imageName , $old_image ,$id , $requestfile){


        for( $i = 0 ; $i <= 6 ; $i++)
        {
            if($i == 0){ $size = '355x240_';  $height = '355';  $width = '240'; }
            if($i == 1){ $size = '1170x600_'; $height = '1170'; $width = '600'; }
            if($i == 2){ $size = '750x388_';  $height = '750';  $width = '388'; }
            if($i == 3){ $size = '100x75_';   $height = '100';  $width = '75';  }
            if($i == 4){ $size = '370x202_';  $height = '370';  $width = '202'; }
            if($i == 5){ $size = '364x244_';  $height = '364';  $width = '244'; }
            if($i == 6){ $size = '385x258_';  $height = '385';  $width = '258'; }


            $this->delete_image(public_path() . '/propertypaymentPlansImage/'.$id.'/'.$size.$old_image);
            $path = public_path('/propertypaymentPlansImage/'.$id.'/' . $size.$imageName);

            Image::make($requestfile->getRealPath())->resize($height,$width)->save($path);
            // Image::make($request->file('new_image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);

        }

    }

    public function delete_image($file_path)
    {
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        parent::delete();
    }

    /**
     * Get the property that owns the User.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function property_features(){
        return $this->belongsToMany('App\PropertyFeatureModel' , 'property_feature', 'feature_id', 'property_id');
    }
}
//ALTER TABLE `property` ADD `title6` VARCHAR(191) NULL DEFAULT NULL AFTER `price6`, ADD `beds6` VARCHAR(191) NULL DEFAULT NULL AFTER `title6`, ADD `bath6` VARCHAR(191) NULL DEFAULT NULL AFTER `beds6`, ADD `property_size6` VARCHAR(191) NULL DEFAULT NULL AFTER `bath6`;
//ALTER TABLE `property` ADD `property_type4` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size3`, ADD `price4` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type4`, ADD `title4` VARCHAR(191) NULL DEFAULT NULL AFTER `price4`, ADD `beds4` VARCHAR(191) NULL DEFAULT NULL AFTER `title4`, ADD `bath4` VARCHAR(191) NULL DEFAULT NULL AFTER `beds4`, ADD `property_size4` VARCHAR(191) NULL DEFAULT NULL AFTER `bath4`, ADD `property_type5` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size4`, ADD `price5` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type5`, ADD `title5` VARCHAR(191) NULL DEFAULT NULL AFTER `price5`, ADD `beds5` VARCHAR(191) NULL DEFAULT NULL AFTER `title5`, ADD `bath5` VARCHAR(191) NULL DEFAULT NULL AFTER `beds5`, ADD `property_size5` VARCHAR(191) NULL DEFAULT NULL AFTER `bath5`, ADD `property_type6` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size5`, ADD `price6` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type6`, ADD `title6` VARCHAR(191) NU[...]
//Query add paymentsimages
//ALTER TABLE `property` ADD `paymentPlansImage0` VARCHAR(191) NULL DEFAULT NULL AFTER `image4`, ADD `paymentPlansImage1` VARCHAR(191) NULL DEFAULT NULL AFTER `paymentPlansImage0`, ADD `paymentPlansImage2` VARCHAR(191) NULL DEFAULT NULL AFTER `paymentPlansImage1`, ADD `paymentPlansImage3` VARCHAR(191) NULL DEFAULT NULL AFTER `paymentPlansImage2`, ADD `paymentPlansImage4` VARCHAR(191) NULL DEFAULT NULL AFTER `paymentPlansImage3`;