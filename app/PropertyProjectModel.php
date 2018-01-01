<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use App\PropertyModel;

class PropertyProjectModel extends Model {

    protected $table = "property_projects";
    protected $primaryKey = 'propertyOpention_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'property_id', 'title', 'property_type', 'price', 'beds', 'bath', 'property_size'
//    ];
    protected $fillable = [
        'property_id', 'title0', 'property_type0', 'price0', 'beds0', 'bath0', 'property_size0','title1', 'property_type1', 'price1', 'beds1', 'bath1', 'property_size1','title2', 'property_type2', 'price2', 'beds2', 'bath2', 'property_size2','title3', 'property_type3', 'price3', 'beds3', 'bath3', 'property_size3'
    ];

    public function store($property_id, $property_type0, $price0, $title0, $beds0, $bath0, $property_size0,$property_type1, $price1, $title1, $beds1, $bath1, $property_size1,$property_type2, $price2, $title2, $beds2, $bath2, $property_size2,$property_type3, $price3, $title3, $beds3, $bath3, $property_size3) {
        

//$arr_implode = array($property_type, $property_id, $price, $title, $beds, $bath, $property_size);
//
////$separater = implode("+", $arr_implode);
////
////echo $separater; // name,email,phone
////echo '<br>';
//         for( $j = 0 ; $j < count(Input::get('title')) ; $j++)
//            {
////                $imageName = $j.'.'.Input::get('title')[$j]->get();
////                $this->where('propertyOpention_id', $property_id)->update(['image'.$j => '_'.$imageName]);
//                echo $j.'<br>';
//            }
               echo $property_type0;
               echo '<br>';
               echo $property_id0;
               echo '<br>';
               echo  $price0;
               echo '<br>';
               echo $title0;
               echo '<br>';
               echo $beds0;
               echo '<br>';
               echo $bath0; 
               echo '<br>';
               echo $property_size0;
               exit();
//         $dataSet = [];
//                  $ii = 0;
//             for($ii = 0; $ii < count(Input::get('title')) ; $ii++) {
//            echo $request[$ii]->title;
//               echo '<br>';
               echo $request->property_type0;
               echo '<br>';
               echo  $request->price0;
               echo '<br>';
               echo $request->title0;
               echo '<br>';
               echo $request->beds0;
               echo '<br>';
               echo $request->bath0; 
               echo '<br>';
               echo $request->property_size0;
            exit();
//                   $query =     PropertyProjectModel   ::create(array( 
//                                     'property_id' => $insertedId,
//                                    'property_type' => $property_type,
//                                    'price' => $price,
//                                    'title' => $title,
//                                    'beds' => $bed,
//                                    'bath' => $baths,
//                                    'property_size' => $property_sizes));
//            
//          
       
//                                $dataSet[] = [
                                   $this->property_id = $request->property_id;
                                   $this->property_type0 =$request->property_type0;
                                   $this->price0 =$request->price0;
                                   $this->title0 =$request->title0;
                                   $this->beds0 =$request->beds0;
                                   $this->bath0 =$request->bath0;
                                   $this-> property_size0 =$request->property_size0;
                                   $this-> property_type1 =$request->property_type1;
                                   $this-> price1 =$request->price1;
                                   $this-> title1 =$request->title1;
                                   $this-> beds1=$request->bed1;
                                   $this-> bath1 =$request->bath1;
                                   $this-> property_size1 =$request->property_size1;
                                   $this-> property_type2 =$request->property_type2;
                                   $this-> price2=$request->price2;
                                   $this-> title2 =$request->title2;
                                   $this-> beds2 =$request->bed2;
                                   $this-> bath2 =$request->baths2;
                                   $this->property_size2 =$request->property_sizes2;
                                   $this->property_type3 =$request->property_type3;
                                   $this-> price3 =$request->price3;
                                   $this-> title3 =$request->title3;
                                   $this-> beds3 =$request->bed3;
                                   $this->bath3 =$request->baths3;
                                   $this-> property_size3 =$request->property_sizes3;
//                                ];   
                                
//             }
        $this->save();
        return true;
    }

    public function Edit($request) {
        $this->where('id', $request->id)
                ->update(['name' => $request->city, 'zipcode' => $request->zipcode]);
        return true;
    }

    public function SingleProperty($id) {

        $propertyProjects = $this
                ->where('property_projects.property_id', '=', $id)
                ->select('services.name')
                ->get();
        return $propertyProjects;
    }

    public function property() {
        return $this->belongsToMany('App\PropertyModel');
    }

}
//
//
//
//
// if(!empty($request->title0) && !empty($request->property_type0) && !empty($request->price0) && !empty($request->beds0) && !empty($request->bath0) && !empty($request->property_size0) && !empty($request->title1) && !empty($request->property_type1) && !empty($request->price1)&& !empty($request->beds1) && !empty($request->bath1) && !empty($request->property_size1) && !empty($request->title2) && !empty($request->property_type2) && !empty($request->price2) && !empty($request->beds2) && !empty($request->bath2) && !empty($request->property_size2) && !empty($request->title3) && !empty($request->property_type3) && !empty($request->price3) && !empty($request->beds3) && !empty($request->bath3) && !empty($request->property_size3)) {
//             echo      $request->title0;
//             echo      $request->property_type0;
//             echo      $request->price0;
//             echo      $request->beds0 ;
//             echo      $request->bath0 ;
//             echo      $request->property_size0 ;
//             echo      $request->title1 ;
//             echo      $request->property_type1;
//             echo      $request->price1 ;
//             echo      $request->beds1 ;
//             echo      $request->bath1 ;
//             echo      $request->property_size1 ;
//             echo      $request->title2 ;
//             echo      $request->property_type2;
//             echo      $request->price2 ;
//             echo      $request->beds2 ;
//             echo      $request->bath2 ;
//             echo      $request->property_size2 ;
//             echo      $request->title3 ;
//             echo      $request->property_type3 ;
//             echo      $request->price3 ;
//             echo      $request->beds3 ;
//             echo      $request->bath3 ;
//             echo      $request->property_size3;
//                  exit();
//           $this->PropertyProjectModel->store( $insertedId , $request->title0 ,$request->property_type0 ,$request->price0 ,$request->beds0 ,$request->bath0 ,$request->property_size0 , $request->title1 ,$request->property_type1 ,$request->price1 ,$request->beds1 ,$request->bath1 ,$request->property_size1 , $request->title2 ,$request->property_type2 ,$request->price2 ,$request->beds2 ,$request->bath2 ,$request->property_size2 , $request->title3 ,$request->property_type3 ,$request->price3 ,$request->beds3 ,$request->bath3 ,$request->property_size3);
//        }
//         if(!empty($request->title)&& !empty($request->property_type)&& !empty($request->price)&& !empty($request->beds)&& !empty($request->bath)&& !empty($request->property_size)) {
//            for($ii = 0; $ii < count($request) ; $ii++) {
//            echo $request[$ii]->title;
//               echo '<br>';
//               echo $request[$ii]->property_type;
//               echo '<br>';
//               echo  $request[$ii]->price;
//               echo '<br>';
//               echo $request[$ii]->title;
//               echo '<br>';
//               echo $request[$ii]->beds;
//               echo '<br>';
//               echo $request[$ii]->bath; 
//               echo '<br>';
//               echo $request[$ii]->property_size;
//            exit();}
//            $this->PropertyProjectModel->store($request->title, $insertedId ,$request->property_type,$request->price,$request->beds,$request->bath,$request->property_size);
//        }
//        echo 'store';
//         exit();    
//ALTER TABLE `property` DROP `pdf`;
//ALTER TABLE `property` ADD `title2` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size1`, ADD `property_type2` VARCHAR(191) NULL DEFAULT NULL AFTER `title2`, ADD `price2` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type2`, ADD `beds2` VARCHAR(191) NULL DEFAULT NULL AFTER `price2`, ADD `bath2` VARCHAR(191) NULL DEFAULT NULL AFTER `beds2`, ADD `property_size2` VARCHAR(191) NULL DEFAULT NULL AFTER `bath2`, ADD `title3` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size2`, ADD `property_type3` VARCHAR(191) NULL DEFAULT NULL AFTER `title3`, ADD `price3` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type3`, ADD `beds3` VARCHAR(191) NULL DEFAULT NULL AFTER `price3`, ADD `bath3` VARCHAR(191) NULL DEFAULT NULL AFTER `beds3`, ADD `property_size3` VARCHAR(191) NULL DEFAULT NULL AFTER `bath3` 
//ALTER TABLE `property` ADD `title0` VARCHAR(191) NULL DEFAULT NULL AFTER `paymentPlansImage4`, ADD `property_type0` VARCHAR(191) NULL DEFAULT NULL AFTER `title0`, ADD `price0` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type0`, ADD `beds0` VARCHAR(191) NULL DEFAULT NULL AFTER `price0`, ADD `bath0` VARCHAR(191) NULL DEFAULT NULL AFTER `beds0`, ADD `property_size0` VARCHAR(191) NULL DEFAULT NULL AFTER `bath0`, ADD `title1` VARCHAR(191) NULL DEFAULT NULL AFTER `property_size0`, ADD `property_type1` VARCHAR(191) NULL DEFAULT NULL AFTER `title1`, ADD `price1` VARCHAR(191) NULL DEFAULT NULL AFTER `property_type1`, ADD `beds1` VARCHAR(191) NULL DEFAULT NULL AFTER `price1`, ADD `bath1` VARCHAR(191) NULL DEFAULT NULL AFTER `beds1`, ADD `property_size1` VARCHAR(191) NULL DEFAULT NULL AFTER `bath1`;
//ALTER TABLE `property_projects` CHANGE `propertyOpention_id` `propertyOpention_id` INT(11) NOT NULL AUTO_INCREMENT, CHANGE `property_id` `property_id` TINYINT(4) UNSIGNED NULL DEFAULT NULL, CHANGE `title` `title0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `property_type` `property_type0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `price` `price0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `beds` `beds0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `bath` `bath0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `property_size` `property_size0` VARCHAR(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `created_at` `created_at` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT NULL, CHANGE `updated_at` `updated_at` TIMESTAMP NULL DEFAULT NULL;