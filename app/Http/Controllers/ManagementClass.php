<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class ManagementClass extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_class(){
        $this->AuthLogin();
    	$courses = DB::table('tbl_courses')->orderby('coursesE_id','desc')->get();
    	$teacher = DB::table('tbl_teacher')->orderby('teacher_id','desc')->get();
    	$teacher2 = DB::table('tbl_teacher')->orderby('teacher_id','desc')->get();

    	return view('admin.class.add_class')->with('courses', $courses)->with('teacher', $teacher)->with('teacher2', $teacher2);
    }

    public function all_class(){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(5);

            }elseif ($sort_by == 'az') {
                $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->orderby('tbl_class.class_name','asc')->paginate(2)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->orderby('tbl_class.class_name','desc')->paginate(2)->appends(request()->query());
            }

        }else{
            $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(5);
        }

        return view('admin.class.all_class')->with('all_class', $all_class);
    }

    public function save_class(Request $request){
        $this->AuthLogin();  

        $class_name = $request -> class_name;

        $result = DB::table('tbl_class')->where('class_name', $class_name) -> first();

  
     	$data = array();
     	$data['class_name'] = $class_name;
    	$data['coursesE_id'] = $request->coursesE_id;
    	$data['teacher_id'] = $request->teacher_id;
    	$data['teacher_id2'] = $request->teacher_id2;
    	$data['class_status'] = $request->class_status;
    	$data['class_desc'] = $request->class_desc;


        if(isset($result)){
            Session::put('message','Lớp học đã có!');
            return Redirect::to('add-class');
        }else{
            DB::table('tbl_class')->insert($data);
        Session::put('message','Tạo lớp thành công!');
        return Redirect::to('all-class');
        }


    	DB::table('tbl_class')->insert($data);
    	Session::put('message','Tạo lớp thành công!');
    	return Redirect::to('all-class');
    }

    public function unactive_class($class_id){
        $this->AuthLogin();
        DB::table('tbl_class')->where('class_id', $class_id)->update(['class_status'=>0]);
        Session::put('message','Hiển thị lớp học thành công!');
        return Redirect::to('all-class');
    }

    public function active_class($class_id){
        $this->AuthLogin();
        DB::table('tbl_class')->where('class_id', $class_id)->update(['class_status'=>1]);
        Session::put('message','Ẩn lớp học thành công!');
        return Redirect::to('all-class');
    }

    public function edit_class($class_id){
        $this->AuthLogin();

        $courses = DB::table('tbl_courses')->orderby('coursesE_id','desc')->get();
        $teacher = DB::table('tbl_teacher')->orderby('teacher_id','desc')->get();
        $teacher2 = DB::table('tbl_teacher')->orderby('teacher_id','desc')->get();

        $edit_class = DB::table('tbl_class')->where('class_id', $class_id)->get();

        $manager_class = view('admin.class.edit_class')->with('edit_class', $edit_class)->with('courses', $courses)->with('teacher', $teacher)->with('teacher2', $teacher2);

        return view('admin_layout')->with('admin.class.edit_class', $manager_class);
    }

    public function update_class(Request $request, $class_id){
        $this->AuthLogin();
        $data = array();
        $data['class_name'] = $request->class_name;
        $data['coursesE_id'] = $request->courses;
        $data['teacher_id'] = $request->teacher;
        $data['teacher_id2'] = $request->teacher2;
        $data['class_desc'] = $request->class_desc;

        DB::table('tbl_class')->where('class_id', $class_id)->update($data);
        Session::put('message','Cập nhật thông tin lớp học thành công!');
        return Redirect::to('all-class');
    }

    public function delete_class($class_id){
        $this->AuthLogin();
        DB::table('tbl_class')->where('class_id', $class_id)->delete();
        Session::put('message','Xoá lớp học thành công!');
        return Redirect::to('all-class');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(2);
    
        $search_class = DB::table('tbl_class')->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->where('class_name', 'like', '%'.$keywords.'%')->orderby('class_id', 'desc')->get();

       return view('admin.class.search_class')->with('all_class', $all_class)->with('search_class', $search_class);
    }

//student class
    public function add_student_class(){
        $this->AuthLogin();
        $class = DB::table('tbl_class')->orderby('class_id','desc')->get();
        $student = DB::table('tbl_student')->orderby('student_id','desc')->get();

        return view('admin.class.add_student_class')->with('student', $student)->with('class', $class);
    }

    public function save_student_class(Request $request){
        $this->AuthLogin();  

        $class_id = $request -> class_id;
        $student_id = $request -> student_id;


        $result = DB::table('tbl_student_class')->where('class_id', $class_id)->where('student_id', $student_id) -> first();

  
        $data = array();
        $data['class_id'] = $class_id;
        $data['student_id'] = $student_id;

        if(isset($result)){
            Session::put('message','Học sinh đã có trong lớp!');
            return Redirect::to('add-student-class');
        }else{
            DB::table('tbl_student_class')->insert($data);
        Session::put('message','Thêm học sinh vào lớp thành công!');
        return Redirect::to('all-list-class');
        }

        DB::table('tbl_student_class')->insert($data);
        Session::put('message','Thêm học sinh vào lớp thành công!');
        return Redirect::to('all-list-class');
    }

    public function all_list_student_class(){
        $this->AuthLogin();

        $all_class = DB::table('tbl_student_class')
        ->join('tbl_class', 'tbl_class.class_id', '=', 'tbl_student_class.class_id')
        ->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_student_class.student_id')
        ->orderby('tbl_student_class.student_class_id','desc')->paginate(5);

        return view('admin.class.all_student_class')->with('all_class', $all_class);
    }

    public function delete_student_class($student_class_id){
        $this->AuthLogin();
        DB::table('tbl_student_class')->where('student_class_id', $student_class_id)->delete();
        Session::put('message','Xoá học sinh trong lớp thành công!');
        return Redirect::to('all-list-student-class');
    }

    public function search_student_class(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_class = DB::table('tbl_student_class')
        ->join('tbl_class', 'tbl_class.class_id', '=', 'tbl_student_class.class_id')
        ->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_student_class.student_id')
        ->orderby('tbl_student_class.student_class_id','desc')->paginate(5);
    
        $search_class = DB::table('tbl_student_class')
        ->join('tbl_class', 'tbl_class.class_id', '=', 'tbl_student_class.class_id')
        ->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_student_class.student_id')
        ->where('tbl_class.class_name', 'like', '%'.$keywords.'%')->orderby('tbl_student_class.class_id', 'desc')->get();

       return view('admin.class.search_student_class')->with('all_class', $all_class)->with('search_class', $search_class);
    }

    public function all_list_class(){
        $this->AuthLogin();



        $class = DB::table('tbl_class')->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')->get();

        $class_count = [];

        foreach ($class as $key => $value) {
            $class_id = $value->class_id;
            $class_name = $value->class_name;
            $count = DB::table('tbl_class')->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')->where('tbl_student_class.class_id', $class_id)->count('student_id');
            $class_count[$class_id]['class_name'] = $class_name;
            $class_count[$class_id]['count'] = $count;
        }

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                 $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(5);

            }elseif ($sort_by == 'az') {
                 $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->orderby('tbl_class.class_name','asc')->paginate(2)->appends(request()->query());

            }elseif ($sort_by == 'za') {
              $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->orderby('tbl_class.class_name','desc')->paginate(2)->appends(request()->query());
            }

        }else{
             $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(5);
        }


        return view('admin.class.list_class')->with('all_class', $all_class)->with('class_count', $class_count);
    }

    public function search_list_class(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->orderby('tbl_class.coursesE_id','desc')->paginate(2);
    
        $search_class = DB::table('tbl_class')
        ->join('tbl_courses','tbl_courses.coursesE_id','=','tbl_class.coursesE_id')
        ->join('tbl_teacher','tbl_teacher.teacher_id','=','tbl_class.teacher_id')
        ->join('tbl_student_class', 'tbl_student_class.class_id', '=', 'tbl_class.class_id')
        ->join('tbl_student', 'tbl_student_class.student_id', '=', 'tbl_student.student_id')
        ->where('tbl_class.class_name', 'like', '%'.$keywords.'%')->orderby('tbl_class.class_id', 'desc')->get();

       return view('admin.class.search_list_class')->with('all_class', $all_class)->with('search_class', $search_class);
    }
}
