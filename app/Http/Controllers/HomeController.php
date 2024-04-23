<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class HomeController extends Controller
{
    public function index(Request $request){

    	$category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

    	/*$all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_id','desc')->get();*/

    	$cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();
    	

    	$all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->where('coursesE_status', '0')->orderby('coursesE_id','desc')->limit(3)->get();

    	$teacher = DB::table('tbl_teacher')->where('teacher_status', '0')->orderby('teacher_id','desc')->limit(4)->get();

    	return view('pages.home')->with('category', $category)->with('teacher', $teacher)->with('all_coursesE', $all_coursesE)->with('cate_new', $cate_new);
    }

    public function about_us(){
	    $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

      	$category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

    	return view('pages.gioithieu.about_us')->with('cate_new', $cate_new)->with('category', $category);
    }

    public function learn(){
	    $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

      	$category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

    	return view('pages.gioithieu.learn')->with('cate_new', $cate_new)->with('category', $category);
    }

    public function lien_he(){
        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        return view('pages.gioithieu.contact')->with('cate_new', $cate_new)->with('category', $category);
    }

/*    public function add_advise(){
    
        $category = DB::table('tbl_category_coueses')->orderby('category_id','desc')->get();
        return view('pages.home')->with('category', $category);
    }*/

    public function save_advise(Request $request){  
        $data = array();

        $data['advise_name'] = $request->advise_name;
        $data['advise_phone'] = $request->advise_phone;
        $data['advise_email'] = $request->advise_email;
        $data['category_id'] = $request->category_id;
        $data['advise_status'] = '0';

        DB::table('tbl_advise')->insert($data);
        Session::put('message','Gửi yêu cầu tư vấn khoá học thành công!');
        return Redirect::to('trang-chu');
    }
}
