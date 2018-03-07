<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Interfaces\SaveObjectsInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Roles;
use DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Session\Storage;
use Intervention\Image\ImageManagerStatic as Image;



class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'DisplayName','email','password', 'BusinessType','remember_token',
        'cell_phone','city','package_type','type','image','status','package_id' , 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * This method is used to logout the user
     **/
    public function logoutUser()
    {
        $this->updateLogoutTime();
        Auth::logout();
    }


    /**
     * This method is used to update the logout time of user
     */
    public function updateLogoutTime()
    {
        $user = Auth::User();
        $user->last_login = Carbon::now();
        $user->save();
    }


    public function SignupForm($request){
        //echo $request->_token;exit;
        //dd(Input::file('image'));
       // dd($request);

        //echo public_path();exit;
        $inputData = [
            'first_name'    => $request->FirstName,
            'last_name'     => $request->lastname,
            'DisplayName'   => $request->DisplayName,
            'email'         => $request->emailAddress,
            'city'          => $request->CityName,
            'cell_phone'    => $request->ConatctNumber,
            'password'      => $request->password,
            'BusinessType'  => $request->BusinessType,
            'package_id'  => $request->package,
            'description'  => $request->description,

            'type'          => 'user',
            'image'          => 'image',
            'status'        => 1,
            'remember_token'=> $request->_token
        ];

      //dump($inputData);
        $lastId = self::create($inputData);
        $insertedId = $lastId->id;

        if($request->hasFile('image'))
        {
            $imageName = $insertedId. '_' . $request->FirstName . '.' . Input::file('image')->getClientOriginalExtension();
            //Input::file('image')->move(public_path() . '/ProfileImage/', $imageName);
            $this->where('id', $insertedId)->update(['image' => $imageName]);

            for( $i = 0 ; $i <= 6 ; $i++)
            {
                if($i == 0){ $size = '74x74_';    $height = '74';   $width = '74'; }
                if($i == 1){ $size = '71x71_';    $height = '71';   $width = '71'; }
                if($i == 2){ $size = '330x330_';  $height = '330';  $width = '330';}
                if($i == 3){ $size = '239x239_';  $height = '239';  $width = '239';}
                if($i == 4){ $size = '200x150_';  $height = '200';  $width = '150';}
                if($i == 5){ $size = '35x35_';    $height = '35';   $width = '35';}
                if($i == 6){ $size = '90x90_';    $height = '90';   $width = '90';}


                $path = public_path('/ProfileImage/' . $size.$imageName);

                Image::make($request->file('image')->getRealPath())->resize($height,$width)->save($path);
                // Image::make($request->file('new_image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);

            }

        }


        return $lastId->id;
    }

    /**
     * This method is used to login existing User
     * @param $request
     * @return Collection
     */
    public function loginUser($request)
    {

        if(isset($request['remember'])) {
            $remember = $request['remember'];
        }else{
            $remember = 0;
        }/*use for remember me functionality*/
        $email = $request['email'];
        $password = $request['password'];


        if (Auth::attempt(['email' => $email, 'password' => $password , 'status' => 1], $remember))
        {
            if (Auth::User()->type == 'admin')
            {
                return collect(['status' => 'success', 'redirectTo' => 'admin/home']);
            }
            if (Auth::User()->type == 'user')
            {
                return collect(['status' => 'success', 'redirectTo' => 'admin/home']);
            }
        }
        return collect(['status' => 'failure', 'message' => 'Invalid Credentials']);
    }
// status active and inactive
    function markuserAs($id,$value) {
        //$where = ['id','=', $id];
        $stmt =  DB::table('users')->where('id','=',$id)->update(['status' => $value]);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }


    public function update_profile($request)
    {
        $user =$this->where('id', Auth::user()->id)->first();

        $this->where('id', Auth::user()->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'cell_phone' => $request->cell_phone
            ]);

        if($request->hasFile('profile_image'))
        {
            $imageName = Auth::user()->id. '_' . $request->first_name . '.' . Input::file('profile_image')->getClientOriginalExtension();

            for( $i = 0 ; $i <= 6 ; $i++)
            {
                if($i == 0){ $size = '74x74_';    $height = '74';   $width = '74'; }
                if($i == 1){ $size = '71x71_';    $height = '71';   $width = '71'; }
                if($i == 2){ $size = '330x330_';  $height = '330';  $width = '330';}
                if($i == 3){ $size = '239x239_';  $height = '239';  $width = '239';}
                if($i == 4){ $size = '200x150_';  $height = '200';  $width = '150';}
                if($i == 5){ $size = '35x35_';    $height = '35';   $width = '35';}
                if($i == 6){ $size = '90x90_';    $height = '90';   $width = '90';}

                $path = public_path('/ProfileImage/'. $size.$imageName);

                $oldImagePath = public_path('/ProfileImage/'. $size.$user->image);

                $this->delete_image($oldImagePath);

                Image::make($request->file('profile_image')->getRealPath())->resize($height,$width)->save($path);
                // Image::make($request->file('profile_image')->getRealPath())->resize($height,$width)->insert(public_path() .'/propetyImages/watermark.png' , 'bottom-right', 10, 10)->save($path);

            }
            $this->where('id', Auth::user()->id)->update(['image' => $imageName]);

        }
        return true;

    }


    public function delete_image($file_path)
    {
        if(file_exists($file_path)){
            @unlink($file_path);
        }
        parent::delete();
    }


    /**
     * Get the comments for the blog post.
     */
    public function property()
    {
        return $this->hasMany('App\PropertyModel', 'id', 'created_by');
    }



}
