<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Illuminate\Support\Facades\Auth;
//session_start();

class ManagementCart extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function save_cart(Request $request){

    	$coursesid = $request->coursesid_hidden;

    	$courses_info = DB::table('tbl_courses')->where('coursesE_id', $coursesid)->get();

    	$class_info = DB::table('tbl_class')->join('tbl_courses', 'tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
    	->where('tbl_class.coursesE_id', $coursesid)->orderby('class_id','desc')->get();

    	$data = array();

/*    	$coursesE_tuition = filter_var($request->coursesE_tuition, FILTER_SANITIZE_NUMBER_INT);
*/

        $data['online_name'] = $request->online_name;
        $data['online_phone'] = $request->online_phone;
        $data['online_email'] = $request->online_email;
        $data['class_id'] = $request->class_id;
        $data['coursesE_id'] = $request->coursesE_id;
        $data['online_status'] = '0';
        $data['online_desc'] = 'Đăng ký online';

        DB::table('tbl_classonline')->insert($data);
        Session::put('message','Gửi yêu cầu đăng ký khoá học thành công!');
        return Redirect::to('dang-ky');
    }

    public function show_cart(Request $request){

    	$coursesid = $request->coursesid_hidden;

    	$courses_info = DB::table('tbl_courses')->where('coursesE_id', $coursesid)->get();

    	$class_info = DB::table('tbl_class')->join('tbl_courses', 'tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
    	->where('tbl_class.coursesE_id', $coursesid)->orderby('class_id','desc')->get();

    	$category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

    	$cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

    	return view('pages.cart.show_cart')->with('category', $category)->with('courses_info', $courses_info)->with('class_info', $class_info)->with('cate_new', $cate_new);
    }

    public function all_online(Request $request){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_online = DB::table('tbl_classonline')->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            ->orderby('tbl_classonline.classonline_id','desc')->paginate(5);

            }elseif($sort_by == 'roi'){
                $all_advise = $all_online = DB::table('tbl_classonline')
                ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            	->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            	->where('tbl_classonline.online_status', '1')->orderby('tbl_classonline.classonline_id','asc')
            	->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'chua') {
                $all_advise = $all_online = DB::table('tbl_classonline')
                ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            	->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            	->where('tbl_classonline.online_status', '0')->orderby('tbl_classonline.classonline_id','asc')
            	->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {
                $all_advise = $all_online = DB::table('tbl_classonline')
                ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            	->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            	->orderby('tbl_classonline.online_name','asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_advise = $all_online = DB::table('tbl_classonline')
                ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            	->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            	->orderby('tbl_classonline.online_name','desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_online = DB::table('tbl_classonline')->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            ->orderby('tbl_classonline.classonline_id','desc')->paginate(5);

        }

        return view('admin.advise.online')->with('all_online', $all_online);

    }

   	public function search_online(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_online = DB::table('tbl_classonline')->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            ->orderby('tbl_classonline.classonline_id','desc')->paginate(5);
    
        $search_online = DB::table('tbl_classonline')->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
        ->where('online_name', 'like', '%'.$keywords.'%')->orderby('classonline_id', 'desc')->get();

       return view('admin.advise.search_online')->with('all_online', $all_online)->with('search_online', $search_online);
    }

    public function delete_online($classonline_id){
        $this->AuthLogin();
        DB::table('tbl_classonline')->where('classonline_id', $classonline_id)->delete();
        Session::put('message','Xoá học sinh thành công!');
        return Redirect::to('all-online');
    }

    public function unactive_online($classonline_id){
        $this->AuthLogin();
    	DB::table('tbl_classonline')->where('classonline_id', $classonline_id)->update(['online_status'=>0]);
    	Session::put('message',' Học sinh chưa được duyệt vào lớp!');
    	return Redirect::to('all-online');
    }

    public function active_online(Request $request, $classonline_id){
        $this->AuthLogin();

        $all_online = DB::table('tbl_classonline')
            ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
            ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
            ->get();

        foreach ($all_online as $key => $value) {
            $data = array();

            $data['student_name'] = $value->online_name;
            $data['student_phone'] = $value->online_phone;
            $data['student_email'] = $value->online_email;
            $data['student_desc'] = $value->online_desc;

            DB::table('tbl_student')->insert($data);
        }



    	DB::table('tbl_classonline')->where('classonline_id', $classonline_id)->update(['online_status'=>1]);
    	Session::put('message','Học sinh đã được duyệt vào lớp!');
    	return Redirect::to('all-online');
    }

    public function dang_ky(){
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

        if(Auth::user()){

            $userEmail = Auth::user()->email;

            $email = DB::table('tbl_classonline')->where('online_email', $userEmail)->exists();
            $email1 = DB::table('users')->where('email', $userEmail)->exists();

            if($email && $email1){
                $all_online = DB::table('tbl_classonline')
                ->join('tbl_class','tbl_class.class_id','=','tbl_classonline.class_id')
                ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_classonline.coursesE_id')
                ->where('online_email', $userEmail)
                ->orderby('tbl_classonline.classonline_id','desc')->get();  

            }else{
                return Redirect::to('dang-ky1');  
            }
             

        }else{            
            return Redirect::to('dang-ky1');           
        }
        
        
        return view('pages.cart.cart')->with('cate_new', $cate_new)->with('category', $category)->with('all_online', $all_online);
    }

    public function dang_ky1(){
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();        

        return view('pages.cart.cart1')->with('cate_new', $cate_new)->with('category', $category);
    }

    public function delete_show_online($classonline_id){
        $this->AuthLogin();
        DB::table('tbl_classonline')->where('classonline_id', $classonline_id)->delete();
        Session::put('message1','Xoá thành công!');
        return Redirect::to('dang-ky');
    }


}
