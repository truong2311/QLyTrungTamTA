<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();
use PDF;

class ManagementTeacher extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

	public function add_teacher(){
        $this->AuthLogin();
		return view('admin.teacher.add_teacher');

	}

	public function all_teacher(Request $request){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_teacher = DB::table('tbl_teacher')->orderby('teacher_id', 'desc')->paginate(5);

            }elseif ($sort_by == 'az') {
                $all_teacher = DB::table('tbl_teacher')->orderby('teacher_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_teacher = DB::table('tbl_teacher')->orderby('teacher_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_teacher = DB::table('tbl_teacher')->orderby('teacher_id', 'desc')->paginate(5);
        }
    	return view('admin.teacher.all_teacher')->with('all_teacher', $all_teacher);
    }

	public function save_teacher(Request $request){
        $this->AuthLogin();
        $data = array();

        $teacher_salary = filter_var($request->teacher_salary, FILTER_SANITIZE_NUMBER_INT);


        $data['teacher_name'] = $request->teacher_name;
        $data['teacher_dateofbirth'] = $request->teacher_dateofbirth;
        $data['teacher_cccd'] = $request->teacher_cccd;
        $data['teacher_gender'] = $request->teacher_gender;
        $data['teacher_phone'] = $request->teacher_phone;
        $data['teacher_university'] = $request->teacher_university;
        $data['teacher_certificate'] = $request->teacher_certificate;
        $data['teacher_address'] = $request->teacher_address;
        $data['teacher_email'] = $request->teacher_email;
        $data['teacher_password'] = $request->teacher_password;
        $data['teacher_salary'] = $teacher_salary;
        $data['teacher_startday'] = $request->teacher_startday;
        $data['teacher_status'] = $request->teacher_status;
        $data['teacher_desc'] = $request->teacher_desc;

        $get_image = $request->file('teacher_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/teacher', $new_image);
            $data['teacher_image'] = $new_image;
            
            DB::table('tbl_teacher')->insert($data);
            Session::put('message','Thêm giáo viên thành công!');
            return Redirect::to('all-teacher');
        } 
        $data['teacher_image'] = '';
        DB::table('tbl_teacher')->insert($data);
        Session::put('message','Thêm giáo viên thành công!');
        return Redirect::to('all-teacher');
    }

    public function unactive_teacher($teacher_id){
        $this->AuthLogin();
    	DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->update(['teacher_status'=>0]);
    	Session::put('message','Xác nhận giáo viên tiếp tục làm việc!');
    	return Redirect::to('all-teacher');
    }

    public function active_teacher($teacher_id){
        $this->AuthLogin();
    	DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->update(['teacher_status'=>1]);
    	Session::put('message','Xác nhận giáo viên nghỉ việc!');
    	return Redirect::to('all-teacher');
    }

    public function edit_teacher($teacher_id){
        $this->AuthLogin();
        $edit_teacher = DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->get();
        return view('admin.teacher.edit_teacher')->with('edit_teacher', $edit_teacher);
    }

    public function update_teacher(Request $request, $teacher_id){
        $this->AuthLogin();
        $data = array();

        $teacher_salary = filter_var($request->teacher_salary, FILTER_SANITIZE_NUMBER_INT);


        $data['teacher_name'] = $request->teacher_name;
    	$data['teacher_cccd'] = $request->teacher_cccd;
    	$data['teacher_phone'] = $request->teacher_phone;
        $data['teacher_university'] = $request->teacher_university;
    	$data['teacher_certificate'] = $request->teacher_certificate;
    	$data['teacher_address'] = $request->teacher_address;
    	$data['teacher_email'] = $request->teacher_email;
    	$data['teacher_password'] = $request->teacher_password;
    	$data['teacher_salary'] = $teacher_salary;
    	$data['teacher_desc'] = $request->teacher_desc;

        $get_image = $request->file('teacher_image');
        
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/teacher', $new_image);
            $data['teacher_image'] = $new_image;
            DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->update($data);
            Session::put('message','Cập nhật giáo viên thành công!');
            return Redirect::to('all-teacher');
        }

        DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->update($data);
        Session::put('message','Cập nhật thông tin giáo viên thành công!');
        return Redirect::to('all-teacher');
    }

    public function delete_teacher($teacher_id){
        $this->AuthLogin();

        $delete = DB::table('tbl_class') ->where('teacher_id', $teacher_id)->exists();

        if($delete){
            Session::put('message','Giáo viên đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-teacher');
        }else{
            DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->delete();
        Session::put('message','Xoá giáo viên thành công!');
        return Redirect::to('all-teacher');
        }

        DB::table('tbl_teacher')->where('teacher_id', $teacher_id)->delete();
        Session::put('message','Xoá giáo viên thành công!');
        return Redirect::to('all-teacher');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_teacher = DB::table('tbl_teacher')->paginate(2);
        
        $search_teacher = DB::table('tbl_teacher')->where('teacher_name', 'like', '%'.$keywords.'%')->orderby('teacher_id', 'desc
            ')->get();

       return view('admin.teacher.search_teacher')->with('all_teacher', $all_teacher)->with('search_teacher', $search_teacher);
    }

    public function print_teacher(Request $request){
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($this->print_listteacher($request));        
        return $pdf -> stream();
    }

    public function print_listteacher(Request $request){
        $all_teacher = DB::table('tbl_teacher')->get();

        $output = '';

        $output.='<style>body{
            font-family: DejaVu Sans;
        }
        .table-styling{
            border: 1px solid #000;
        }
        .table-styling tbody tr td{
            border: 1px solid #000;
        }
        </style>
        <h1><center>Giáo viên</center></h1>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Tên giáo viên</th>
                    <th>CCCD</th>
                    <th>SĐT</th>
                    <th>Trường đại học</th>
                    <th>Chứng chỉ</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($all_teacher as $key => $value) {
               $output.='
                    <tr>
                        <td>'.$value->teacher_name.'</td>
                        <td>'.$value->teacher_cccd.'</td>
                        <td>'.$value->teacher_phone.'</td>
                        <td>'.$value->teacher_university.'</td>
                        <td>'.$value->teacher_certificate.'</td>
                        <td>'.$value->teacher_address.'</td>
                    </tr>';
            }
                
                $output.='

            </tbody>
        </table>';

        return $output;

    }
//Người dùng là giáo viên
    public function TeacherLogin(){
        $teacher_id = Session::get('teacher_id');
        if($teacher_id){
            return Redirect::to('admin.teacher_dashboard');
        }else{
            return Redirect::to('teacher')->send();
        }
    }

    public function login_teacher(){
        return view('admin.teacher.login_teacher');
    }

    public function teacher_index(){
        return view('admin.teacher.login_teacher');
    }

    public function show_dashboard_teacher(){
        $this->TeacherLogin();
        return view('admin.teacher_dashboard');
    }

    public function teacher(Request $request){
        $teacher_email = $request -> teacher_email;
        $teacher_password = $request -> teacher_password;

        $result = DB::table('tbl_teacher')->where('teacher_email',$teacher_email)->where('teacher_password', $teacher_password) -> first();

        if(isset($result)){
            Session::put('teacher_name',$result->teacher_name);
            Session::put('teacher_id',$result->teacher_id);
            return view('admin.teacher_dashboard');
        }else{
            Session::put('message','Vui lòng kiểm tra lại thông tin đăng nhập!');
            return Redirect::to('/teacher');
        }
    }

    public function logout_teacher(){
        $this->TeacherLogin();
        Session::put('teacher_name',null);
        Session::put('teacher_id',null);
        return Redirect::to('/login-teacher');
    }

    public function all_classteacher(){
        $this->TeacherLogin();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_id', 'desc')->paginate(5);

            }elseif ($sort_by == 'az') {
                $all_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_name', 'asc')
                ->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_name', 'desc')
                ->paginate(5)->appends(request()->query());
            }

        }else{
            $all_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_id', 'desc')->paginate(5);
        }

        return view('admin.teacher.all_class')->with('all_classteacher', $all_classteacher);
    }

    public function search_class_teacher(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_id', 'desc')->paginate(5);
        
        $search_classteacher = DB::table('tbl_courses')
                ->join('tbl_class', 'tbl_courses.coursesE_id', '=', 'tbl_class.coursesE_id')
                ->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_class.teacher_id')
                ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
                ->orderby('tbl_teacher.teacher_id', 'desc')
                ->where('teacher_name', 'like', '%'.$keywords.'%')->orderby('tbl_teacher.teacher_id', 'desc')->get();

       return view('admin.teacher.search_class_teacher')->with('all_classteacher', $all_classteacher)->with('search_classteacher', $search_classteacher);
    }

//Chấm công

    public function add_chamcong(){
        $this->AuthLogin();

        $teacher = DB::table('tbl_teacher')->where('teacher_status', '0')->orderby('teacher_id','desc')->get();

        return view('admin.teacher.chamcong')->with('teacher', $teacher);

    }

    public function save_chamcong(Request $request){
        $this->AuthLogin();
        $data = array();

        $data['teacher_id'] = $request->teacher_id;
        $data['teacher_chamcong'] = $request->teacher_chamcong;
        $data['teacher_number'] = $request->teacher_number;
        $data['teacher_price'] = $request->teacher_price;


        DB::table('tbl_chamcong')->insert($data);
        Session::put('message','Chấm công giáo viên thành công!');
        return Redirect::to('add-chamcong');
    }

    public function all_chamcong(Request $request){
        $this->AuthLogin();

        $chamcong = DB::table('tbl_chamcong')->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_chamcong.teacher_id')
        ->orderby('chamcong_id', 'desc')->paginate(5);

        return view('admin.teacher.all_chamcong')->with('chamcong', $chamcong);
    }

    public function add_chigiaovien($chamcong_id){
        $this->AuthLogin();
        $chamcong = DB::table('tbl_chamcong')->join('tbl_teacher', 'tbl_teacher.teacher_id', '=', 'tbl_chamcong.teacher_id')
        ->where('chamcong_id', $chamcong_id)->get();
        return view('admin.chi.add_chigiaovien')->with('chamcong', $chamcong);
    }

    public function save_chigiaovien(Request $request, $chamcong_id){
        $this->AuthLogin();
        $data = array();

        $data['teacher_name'] = $request->teacher_name;
        $data['teacher_salary'] = $request->teacher_salary;

        DB::table('tbl_chigiaovien')->insert($data);
        Session::put('message','Chấm công giáo viên thành công!');
        return Redirect::to('all-spend');
    }



//fontend

    public function show_teacher1(){

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();

        $teacher = DB::table('tbl_teacher')->where('teacher_status', '0')->orderby('teacher_id','desc')->get();
        
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();


        return view('pages.teacher.show_teacher')->with('teacher', $teacher)->with('category', $category)->with('cate_new', $cate_new);
    }


}
