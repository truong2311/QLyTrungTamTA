<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class CategoryCourses extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_courses(){
        $this->AuthLogin();
    	return view('admin.category.add_courses');
    }

    public function all_courses(Request $request){
        $this->AuthLogin();
    	
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_courses = DB::table('tbl_category_coueses')->paginate(5);

            }elseif ($sort_by == 'az') {
                $all_courses = DB::table('tbl_category_coueses')->orderby('category_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_courses = DB::table('tbl_category_coueses')->orderby('category_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_courses = DB::table('tbl_category_coueses')->paginate(5);
        }

    	return view('admin.category.all_courses')->with('all_courses', $all_courses);
    }

    public function save_courses(Request $request){
        $this->AuthLogin();

        $category_name = $request -> category_name;
        $category_desc = $request -> category_desc;

        $result = DB::table('tbl_category_coueses')->where('category_name', $category_name) -> first();

    	$data = array();
    	$data['category_name'] = $category_name;
        $data['category_slug'] = $request->category_slug;
    	$data['category_desc'] = $category_desc;
    	$data['category_status'] = $request->category_courses_status;

        if(isset($result)){
            Session::put('message','Danh mục đã có!');
            return Redirect::to('add-courses');
        }else{
            DB::table('tbl_category_coueses')->insert($data);
            Session::put('message','Thêm danh mục khoá học thành công!');
            return Redirect::to('all-courses');
        }


    	DB::table('tbl_category_coueses')->insert($data);
    	Session::put('message','Thêm danh mục khoá học thành công!');
    	return Redirect::to('all-courses');

        
    }

    public function unactive_category_courses($category_courses_id){
        $this->AuthLogin();
    	DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->update(['category_status'=>0]);
    	Session::put('message','Hiển thị danh mục khoá học thành công!');
    	return Redirect::to('all-courses');
    }

    public function active_category_courses($category_courses_id){
        $this->AuthLogin();
    	DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->update(['category_status'=>1]);
    	Session::put('message','Ẩn danh mục khoá học thành công!');
    	return Redirect::to('all-courses');
    }

    public function edit_category_courses($category_courses_id){
        $this->AuthLogin();
        $edit_category_courses = DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->get();
        return view('admin.category.edit_category_courses')->with('edit_category_courses', $edit_category_courses);
    }

    public function update_category_courses(Request $request, $category_courses_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_courses;
        $data['category_slug'] = $request->category_slug;
        $data['category_desc'] = $request->category_courses_desc;
        DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->update($data);
        Session::put('message','Cập nhật danh mục khoá học thành công!');
        return Redirect::to('all-courses');
    }

    public function delete_category_courses($category_courses_id){
        $this->AuthLogin();

        $all_coursesE = DB::table('tbl_courses') ->where('category_id', $category_courses_id)
        ->exists();

        if($all_coursesE){
            Session::put('message','Khoá học đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-courses');
        }else{
            DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->delete();
            Session::put('message','Xoá danh mục khoá học thành công!');
            return Redirect::to('all-courses');
        }

        DB::table('tbl_category_coueses')->where('category_id', $category_courses_id)->delete();
        Session::put('message','Xoá danh mục khoá học thành công!');
        return Redirect::to('all-courses');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_category = DB::table('tbl_category_coueses')->paginate(5);
        
        $search_category = DB::table('tbl_category_coueses')->where('category_name', 'like', '%'.$keywords.'%')->orderby('tbl_category_coueses.category_id', 'desc')->get();

       return view('admin.category.search_category_courses')->with('all_category', $all_category)->with('search_category', $search_category);
    }

    //fontend
    public function show_category_home($coursesE_slug){

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();
        
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $cate = DB::table('tbl_category_coueses')->where('category_slug', $coursesE_slug)->take(1)->get();

        foreach ($cate as $key => $val) {
            $category1 = $val->category_id;
        }

        $category_by_id = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id', '=', 'tbl_courses.category_id')->where('tbl_category_coueses.category_id', $category1)->where('tbl_courses.coursesE_status', '0')->get();

        $category_name = DB::table('tbl_category_coueses')->where('tbl_category_coueses.category_slug', $coursesE_slug)->first();

        return view('pages.category.show_category')->with('category', $category)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('cate_new', $cate_new);

    }

}
