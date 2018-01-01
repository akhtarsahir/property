<?php

namespace App\Http\Controllers;

use App\Contactuspropertyinfo;
use DB;
use Mail;
use App\Mail\signupMail;
use App\Jobs\ExpireEmailLink;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;

class ContactuspropertyinfoController extends Controller
{
     public function __construct() {
        $this->Contactuspropertyinfo = new Contactuspropertyinfo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Contact_us = DB::table('contactus_propertyinfo')
          ->select('contactus_propertyinfo.*', 'property.*', 'contactus_propertyinfo.id AS cpid','property.id AS pro_id')
          ->join('property',  'property.id', '=', 'contactus_propertyinfo.property_id')
          ->get();
       
        return view('admin.view_propertyinfo', ['Contact_us' => $Contact_us]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single_user() {
        $Contact_us = DB::table('contactus_propertyinfo')
                ->where('property.created_by' , '=' , Auth::user()->id)
        ->select('contactus_propertyinfo.*', 'property.*', 'contactus_propertyinfo.id AS cpid','property.id AS pro_id')
         ->join('property',  'property.id', '=', 'contactus_propertyinfo.property_id')
         
        ->get();
        return view('admin.view_propertyinfo', ['Contact_us' => $Contact_us]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {

        if ($this->Contactuspropertyinfo->store($request) == true) {

            return Redirect::action('PropertyController@singleproperty',['id'=>$id])->with('Message', 'Your Feedback Submit Successfully...!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactus_reply() {
        $Contact_us = $this->Contactuspropertyinfo->where('id', Input::get('id'))->get();
        return view('admin.view_propertyinfo', ['Contact_us' => $Contact_us]);
//        return view('admin.contactus_reply', ['Contact_us' => $Contact_us]);
    }

    public function contactus_sendemail(Request $request) {
        $this->token = md5(time() . $request->get('emailAddress'));
        $request->token = $this->token;
//        $data = $this->ContactUs->store($request);
//        $UserData = User::find($data);

        Mail::to($request->emailAddress)->send(new signupMail($request));
        $job = (new ExpireEmailLink($request->id))->delay(Carbon::Now()->addMinutes(2));
        dispatch($job);
//        return Redirect::action('ContactUsController@index')->with('Block', 'Send email reply Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactus_status($action, $id) {
//        dd($action);
        if ($action == 'block') {
            $stmt = $this->Contactuspropertyinfo->markuserAs($id, 0);
            return Redirect::action('ContactUsController@index')->with('Block', 'Contact Status Block Successfully!');
        } else if ($action == 'unblock') {
            $this->Contactuspropertyinfo->markuserAs($id, 1);
            return Redirect::action('ContactUsController@index')->with('Success', 'Contact Status Approve Successfully!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//        Contactuspropertyinfo::where('id', Input::get('id'))->delete();
             DB::table('contactus_propertyinfo')->where('id', $id)->delete();
        return Redirect::action('ContactuspropertyinfoController@single_user')->with('delete', '  Deleted Successfully!');
    }

}
