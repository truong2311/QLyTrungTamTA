<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class ManagementStudent extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

	public function add_student(){
        $this->AuthLogin();
		return view('admin.student.add_student');

	}

	public function all_student(){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_student = DB::table('tbl_student')->orderby('student_id', 'desc')->paginate(6);

            }elseif ($sort_by == 'az') {
                $all_student = DB::table('tbl_student')->orderby('student_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_student = DB::table('tbl_student')->orderby('student_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_student = DB::table('tbl_student')->orderby('student_id', 'desc')->paginate(6);        
        }

    	return view('admin.student.all_student')->with('all_student', $all_student);
    }

	public function save_student(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['student_name'] = $request->student_name;
    	$data['student_dateofbirth'] = $request->student_dateofbirth;
    	$data['student_gender'] = $request->student_gender;
    	$data['student_phone'] = $request->student_phone;
    	$data['student_address'] = $request->student_address;
    	$data['student_email'] = $request->student_email;
    	$data['student_desc'] = $request->student_desc;

    	DB::table('tbl_student')->insert($data);
    	Session::put('message','Thêm học sinh thành công!');
    	return Redirect::to('all-student');
    }

    public function edit_student($student_id){
        $this->AuthLogin();
        $edit_student = DB::table('tbl_student')->where('student_id', $student_id)->get();
        return view('admin.student.edit_student')->with('edit_student', $edit_student);
    }

    public function update_student(Request $request, $student_id){
        $this->AuthLogin();
        $data = array();
        $data['student_name'] = $request->student_name;
    	$data['student_phone'] = $request->student_phone;
    	$data['student_address'] = $request->student_address;
        $data['student_email'] = $request->student_email;
    	$data['student_desc'] = $request->student_desc;

        DB::table('tbl_student')->where('student_id', $student_id)->update($data);
        Session::put('message','Cập nhật thông tin học sinh thành công!');
        return Redirect::to('all-student');
    }

    public function delete_student($student_id){
        $this->AuthLogin();

        $delete = DB::table('tbl_student_class')->where('student_id', $student_id)->exists();


        if($delete){
            Session::put('message','Học sinh đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-student');
        }else{
            DB::table('tbl_student')->where('student_id', $student_id)->delete();
        Session::put('message','Xoá học sinh thành công!');
        return Redirect::to('all-student');
        }

        DB::table('tbl_student')->where('student_id', $student_id)->delete();
        Session::put('message','Xoá học sinh thành công!');
        return Redirect::to('all-student');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_student = DB::table('tbl_student')->get();

        $search_student = DB::table('tbl_student')->where('student_name', 'like', '%'.$keywords.'%')->orderby('student_id', 'desc')->get();
        return view('admin.student.search_student')->with('all_student', $all_student)->with('search_student', $search_student);
    }

}