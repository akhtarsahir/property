<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityModel;
use App\CitySubAddresModel;
use DB;
class CitySubAddressController extends Controller {

    public function __construct() {
        $this->CityModel = new CityModel;
        $this->CitySubAddresModel = new CitySubAddresModel;
    }

    public function index() {
        $data = $this->CityModel->get();
        return view('admin.add_citysubAddress', ['data' => $data]);
    }

    public function store(Request $request) {
        $no = $request->cityname;
        $cityid = CityModel::where('cityno', $no)->first();
        $id = DB::table('citysubaddress')->insertGetId(
                ['cityname' => $cityid->name,'citysubaddress' => $request->citysubaddress,'latitude' => $request->latitude,'longitude' => $request->longitude,'city_id' => $cityid->id]
        );
        $rtno = $cityid->cityno.str_pad($id, 3, "0", STR_PAD_LEFT);
        $this->CitySubAddresModel->where('id', $id)
                ->update(['address_no' => $rtno]);
//        if ($this->CitySubAddresModel->store($request) == true) {
            $data = $this->CitySubAddresModel->get();
            return view('admin.view_allcitysubaddress', ['data' => $data])->with('Message', 'Your City Created Successfully...!');
//        }
        //echo 'store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxdata(Request $request) {
       $data = $request->all(); // This will get all the request data.

        dd($data); // This will dump and die
       echo 'helllo word ';exit();
        return response()->json($test);
    }
    
    
    public function view() {
        $data = $this->CitySubAddresModel->get();
        return view('admin.view_allcitysubaddress', ['data' => $data]);
    }

    public function show($id) {
        $data = $this->CityModel->get();
        $edit = $this->CitySubAddresModel->find($id);
        return view('admin.edit_citysubAddress', ['data' => $data, 'edit' => $edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if ($this->CitySubAddresModel->Edit($request) == true) {
            $data = $this->CitySubAddresModel->get();
            return view('admin.view_allcitysubaddress', ['data' => $data])->with('Message', 'Your Sub City  updated Successfully...!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $city = $this->CitySubAddresModel->destroy($id);
        //$data =$this->CityModel->get();
        return redirect()->action('CitySubAddressController@view');
        //return view('admin.city',  ['data' => $data])->with('Message' , 'Your City Deleted Successfully...!');
    }

}
