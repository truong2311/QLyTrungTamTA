<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\LengthAwarePaginatorsimplePaginate;
use Illuminate\Pagination\Paginator;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class ManagementCourses extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_coursesE(){
        $this->AuthLogin();
    	$category = DB::table('tbl_category_coueses')->orderby('category_id','desc')->get();
    	return view('admin.courses.add_coursesE')->with('category', $category);
    }

    public function all_coursesE(Request $request){
        $this->AuthLogin();
/*    	$all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_id','desc')->get();
*/
    
        /*$category_by_slug = DB::table('tbl_category_coueses')->where('category_slug', $category_slug)->get();
        foreach ($category_slug as $key => $value) {
            $category_id = $value->category_id;
        }*/

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
            $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_id','desc')->paginate(5);

            }elseif($sort_by == 'tang'){
                $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_tuition','asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'giam') {
                $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_tuition','desc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {
                $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_title','asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_title','desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_id','desc')->paginate(5);
        }

    	return view('admin.courses.all_coursesE')->with('all_coursesE', $all_coursesE);
    }

    public function save_coursesE(Request $request){
        $this->AuthLogin();    
     	$data = array();

        $coursesE_tuition = filter_var($request->coursesE_tuition, FILTER_SANITIZE_NUMBER_INT);

    	$data['category_id'] = $request->category;
    	$data['coursesE_title'] = $request->coursesE_title;
        $data['coursesE_slug'] = $request->coursesE_slug;
    	$data['coursesE_content'] = $request->coursesE_content;
        $data['coursesE_seats'] = $request->coursesE_seats;
/*        $data['coursesE_starttime'] = $request->coursesE_starttime;
        $data['coursesE_endtime'] = $request->coursesE_endtime;
*/    	$data['coursesE_number'] = $request->coursesE_number;
    	$data['coursesE_tuition'] = $coursesE_tuition;
/*    	$data['coursesE_startday'] = $request->coursesE_startday;
    	$data['coursesE_endday'] = $request->coursesE_endday;*/
    	$data['coursesE_status'] = $request->coursesE_status;
    	$data['coursesE_desc'] = $request->coursesE_desc;

    	$get_image = $request->file('coursesE_image');
    	if($get_image){
        	$get_name_image = $get_image->getClientOriginalName();
        	$name_image = current(explode('.', $get_name_image));
        	$new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        	$get_image->move('public/upload/courses', $new_image);
        	$data['coursesE_image'] = $new_image;
        	DB::table('tbl_courses')->insert($data);
        	Session::put('message','Thêm khoá học thành công!');
        	return Redirect::to('all-coursesE');
    	} 
    	$data['coursesE_image'] = '';
    	DB::table('tbl_courses')->insert($data);
    	Session::put('message','Thêm khoá học thành công!');
    	return Redirect::to('all-coursesE');
    }

    public function unactive_coursesE($coursesE_id){
        $this->AuthLogin();
    	DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->update(['coursesE_status'=>0]);
    	Session::put('message','Hiển thị khoá học thành công!');
    	return Redirect::to('all-coursesE');
    }

    public function active_coursesE($coursesE_id){
        $this->AuthLogin();
    	DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->update(['coursesE_status'=>1]);
    	Session::put('message','Ẩn khoá học thành công!');
    	return Redirect::to('all-coursesE');
    }

    public function edit_coursesE($coursesE_id){
        $this->AuthLogin();

    	$category = DB::table('tbl_category_coueses')->orderby('category_id','desc')->get();

        $edit_coursesE = DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->get();

        $manager_coursesE = view('admin.courses.edit_coursesE')->with('edit_coursesE', $edit_coursesE)->with('category', $category);
        return view('admin_layout')->with('admin.courses.edit_coursesE', $manager_coursesE);
    }

    public function update_coursesE(Request $request, $coursesE_id){
        $this->AuthLogin();
    	$data = array();

        $coursesE_tuition = filter_var($request->coursesE_tuition, FILTER_SANITIZE_NUMBER_INT);


    	$data['category_id'] = $request->category;
    	$data['coursesE_title'] = $request->coursesE_title;
        $data['coursesE_slug'] = $request->coursesE_slug;
    	$data['coursesE_content'] = $request->coursesE_content;
        $data['coursesE_seats'] = $request->coursesE_seats;
/*        $data['coursesE_starttime'] = $request->coursesE_starttime;
        $data['coursesE_endtime'] = $request->coursesE_endtime;*/
    	$data['coursesE_number'] = $request->coursesE_number;
    	$data['coursesE_tuition'] = $coursesE_tuition;
/*    	$data['coursesE_startday'] = $request->coursesE_startday;
    	$data['coursesE_endday'] = $request->coursesE_endday;*/

    	$get_image = $request->file('coursesE_image');
    	if($get_image){
        	$get_name_image = $get_image->getClientOriginalName();
        	$name_image = current(explode('.', $get_name_image));
        	$new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        	$get_image->move('public/upload/courses', $new_image);
        	$data['coursesE_image'] = $new_image;
        	DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->update($data);
        	Session::put('message','Cập nhật thông tin khoá học thành công!');
        	return Redirect::to('all-coursesE');
    	} 
    	DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->update($data);
        Session::put('message','Cập nhật thông tin khoá học thành công!');
    	return Redirect::to('all-coursesE');
    }

    public function delete_coursesE($coursesE_id){
        $this->AuthLogin();
        DB::table('tbl_courses')->where('coursesE_id', $coursesE_id)->delete();
        Session::put('message','Xoá khoá học thành công!');
        return Redirect::to('all-coursesE');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->orderby('tbl_courses.coursesE_id','desc')->get();
        
        $search_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->where('coursesE_title', 'like', '%'.$keywords.'%')->orderby('tbl_courses.coursesE_id', 'desc')->get();

       return view('admin.courses.search_coursesE')->with('all_coursesE', $all_coursesE)->with('search_coursesE', $search_coursesE);
    }

//fontend
    public function details_courses($coursesE_slug, Request $request){

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();
        
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $detail_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->where('tbl_courses.coursesE_slug', $coursesE_slug)->where('coursesE_status', '0')->take(1)->get();


        foreach ($detail_coursesE as $key => $value){
            $category1 = $value->category_id;
            $category_id = $value->category_id;
            $coursesE_id = $value->coursesE_id;
            $url_canonical = $request->url();
        }

        $class_name = DB::table('tbl_class')->join('tbl_courses', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
        ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
        ->where('tbl_class.coursesE_id', $coursesE_id)->get();


        $related_coursesE = DB::table('tbl_courses')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_courses.category_id')->where('tbl_category_coueses.category_id', $category_id)->where('coursesE_status', '0')->whereNotIn('coursesE_slug', [$coursesE_slug])->get();

        return view('pages.courses.show_detail')->with('category', $category)->with('detail_coursesE', $detail_coursesE)->with('related_coursesE', $related_coursesE)->with('class_name', $class_name)->with('url_canonical', $url_canonical)->with('cate_new', $cate_new);
    }

}
