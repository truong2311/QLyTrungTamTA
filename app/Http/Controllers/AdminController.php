<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }

    public function show_dashboard(Request $request){
        $this->AuthLogin();

    	return view('admin.dashboard');
    }

    public function dashboard(Request $request){
    	$admin_email = $request -> admin_email;
    	$admin_password = md5($request -> admin_password);

    	$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password', $admin_password) -> first();

       	if(isset($result)){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return view('admin.dashboard');
        }else{
            Session::put('message','Vui lòng kiểm tra lại thông tin đăng nhập!');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
    	Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
