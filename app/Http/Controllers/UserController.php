<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $user = DB::table('userdetails')->orderBy('id','DESC')->where('is_deleted',0)->first();
        return view("index",compact('user'));
    }

    public function view()
    {        
        $user = DB::table('userdetails')->orderBy('id','DESC')->where('is_deleted',0)->first();
        return view("view",compact('user'));
    }

    public function saveuserdetails(Request $request)
    {
        $id = isset($request->id) ? $request->id : ''; 
        
        $data = [];
        if($request->file('profile_picture')){
            $file = $request->file('profile_picture');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['profile_picture']= $filename;
        }
        $data['activities'] = json_encode($request->activities);
        $data['industries'] = isset($request->industries) ? $request->industries : '';
        $data['locations'] = json_encode($request->locations);
        $data['funding_source'] = isset($request->funding_source) ? $request->funding_source : '';
        $data['name'] = isset($request->name) ? $request->name : '';
        $data['mobile_no'] = isset($request->mobile_no) ? $request->mobile_no : '';
        $data['zip_code'] = isset($request->zip_code) ? $request->zip_code : '';
        $data['company_name'] = isset($request->company_name) ? $request->company_name : '';
        $data['skills'] = isset($request->skills) ? $request->skills : '';
        $data['created_at'] = date('Y-m-d H:i:s');
        

        if(empty($id)){
            DB::table('userdetails')->insert($data);
            return Redirect::to("/")->withSuccess('Profile saved successfully.');
        }else{
            DB::table('userdetails')->where('id',$id)->update($data);
            return Redirect::to("/")->withSuccess('Profile updated successfully.');
        }
    }

    public function deleteprofille($id)
    {
        $data =[];
        $data['is_deleted'] = 1; 
        DB::table('userdetails')->where('id',$id)->update($data);
        return Redirect::to("/")->withSuccess('Profile deleted successfully.');
    }
}