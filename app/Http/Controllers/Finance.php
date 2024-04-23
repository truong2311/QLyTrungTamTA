<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

class Finance extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
  


//thu

    public function list_class(){
        $all_class = DB::table('tbl_courses')->join('tbl_class', 'tbl_class.coursesE_id', '=', 'tbl_courses.coursesE_id')
        ->orderby('tbl_courses.coursesE_id', 'desc')->paginate(5);

        return view('admin.finance.list_class')->with('all_class', $all_class);
    }

    public function add_collect(Request $request, $class_id){
    	$this->AuthLogin();

        $student = DB::table('tbl_student')->orderby('student_id','desc')->get();
  

        $all_class = DB::table('tbl_courses')->join('tbl_class', 'tbl_class.coursesE_id', '=', 'tbl_courses.coursesE_id')
        ->where('tbl_class.class_id', $class_id)->get();

/*        $tuition = $request->coursesE_tuition;
        $percent = $request->collect_promotion;

        if ($percent == 0) {
            $result = $tuition;
        } elseif ($percent == 10) {
            
            $result = $value * (1 - ($percent / 100));
        }elseif ($percent == 15) {
            
            $result = $value * (1 - ($percent / 100));
        } else{
            $result = $value * (1 - ($percent / 100));
        };
*/
    	return view('admin.finance.thu.add_collect')->with('student', $student)->with('all_class', $all_class);
    }

    public function save_collect(Request $request){
        $this->AuthLogin();
 
     	$data = array();

    	$data['coursesE_title'] = $request->coursesE_title;
    	$data['class_name'] = $request->class_name;
    	$data['coursesE_tuition'] = $request->coursesE_tuition;
        $data['collect_day'] = $request->collect_day;
    	$data['student_id'] = $request->student_id;
    	$data['collect_promotion'] = $request->collect_promotion;
        $data['collect_moneynap'] = $request->collect_moneynap;


    	DB::table('tbl_collect')->insert($data);
    	Session::put('message','Thêm khoản thu thành công!');
    	return Redirect::to('all-collect');
    }


    public function all_collect(){
    	$this->AuthLogin();

   		$all_collect = DB::table('tbl_collect')->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_collect.student_id')
        ->orderby('collect_id', 'desc')->paginate(5);

    	return view('admin.finance.thu.all_collect')->with('all_collect', $all_collect);

    }

    public function edit_collect($collect_id){
        $this->AuthLogin();

        $student = DB::table('tbl_student')->orderby('student_id','desc')->get();

        $edit_collect = DB::table('tbl_collect')->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_collect.student_id')
        ->where('collect_id', $collect_id )->get();

        return view('admin.finance.thu.edit_collect')->with('edit_collect', $edit_collect)->with('student', $student);
    }

    public function update_collect(Request $request, $collect_id){
        $this->AuthLogin();
        $data = array();

        $data['coursesE_title'] = $request->coursesE_title;
        $data['class_name'] = $request->class_name;
        $data['coursesE_tuition'] = $request->coursesE_tuition;
        $data['collect_day'] = $request->collect_day;
        $data['student_id'] = $request->student_id;
        $data['collect_promotion'] = $request->collect_promotion;
        $data['collect_moneynap'] = $request->collect_moneynap;

        DB::table('tbl_collect')->where('collect_id', $collect_id)->update($data);
        Session::put('message','Cập nhật thông tin khoản thu thành công công!');
        return Redirect::to('all-collect');
    }

/*    public function delete_collect($collect_id){
        $this->AuthLogin();

        DB::table('tbl_collect')->where('collect_id', $collect_id)->delete();
        Session::put('message','Xoá khảon thu thành công!');
        return Redirect::to('all-collect');
    }*/

    public function search_collect(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_collect = DB::table('tbl_collect')->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_collect.student_id')
        ->orderby('collect_id', 'desc')->get();
        
        $search_collect = DB::table('tbl_collect')->join('tbl_student', 'tbl_student.student_id', '=', 'tbl_collect.student_id')->where('class_name', 'like', '%'.$keywords.'%')->orderby('tbl_collect.collect_id', 'desc')->get();

       return view('admin.finance.thu.search_collect')->with('all_collect', $all_collect)->with('search_collect', $search_collect);
    }

//chi

    public function add_spend(){
    	$this->AuthLogin();
    	return view('admin.finance.chi.add_spend');
    }

    public function save_spend(Request $request){
        $this->AuthLogin();

        $spend_money = filter_var($request->spend_money, FILTER_SANITIZE_NUMBER_INT);

 
     	$data = array();
    	$data['spend_name'] = $request->spend_name;
    	$data['spend_content'] = $request->spend_content;
    	$data['spend_date'] = $request->spend_date;
    	$data['spend_money'] = $spend_money;
    	$data['spend_desc'] = $request->spend_desc;

    	DB::table('tbl_spend')->insert($data);
    	Session::put('message','Thêm khoản chi thành công!');
    	return Redirect::to('all-spend');
    }

    public function all_spend(){
    	$this->AuthLogin();

        $all = DB::table('tbl_chigiaovien')->orderby('chigiaovien_id', 'desc')->paginate(3);

        $all_spend = DB::table('tbl_spend')->orderby('spend_id', 'desc')->paginate(3);

    	return view('admin.chi.all_chigiaovien')->with('all', $all)->with('all_spend', $all_spend);

    }

    public function edit_spend($spend_id){
        $this->AuthLogin();
        $edit_spend = DB::table('tbl_spend')->where('spend_id', $spend_id)->get();
        return view('admin.finance.chi.edit_spend')->with('edit_spend', $edit_spend);
    }

    public function update_spend(Request $request, $spend_id){
        $this->AuthLogin();
        $data = array();

        $spend_money = filter_var($request->spend_money, FILTER_SANITIZE_NUMBER_INT);


    	$data['spend_name'] = $request->spend_name;
    	$data['spend_content'] = $request->spend_content;
    	$data['spend_date'] = $request->spend_date;
    	$data['spend_money'] = $spend_money;
    	$data['spend_desc'] = $request->spend_desc;


        DB::table('tbl_spend')->where('spend_id', $spend_id)->update($data);
        Session::put('message','Cập nhật thông tin khoản chi thành công!');
        return Redirect::to('all-spend');
    }

    public function delete_spend($spend_id){
        $this->AuthLogin();

        DB::table('tbl_spend')->where('spend_id', $spend_id)->delete();
        Session::put('message','Xoá khoản chi thành công!');
        return Redirect::to('all-spend');
    }

    public function search_spend(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

    	$all_spend = DB::table('tbl_spend')->orderby('spend_id', 'desc')->get();
        
        $search_spend = DB::table('tbl_spend')->where('spend_name', 'like', '%'.$keywords.'%')->orderby('tbl_spend.spend_id', 'desc')->get();

       return view('admin.finance.chi.search_spend')->with('all_spend', $all_spend)->with('search_spend', $search_spend);
    }

//thống kê
    public function thong_ke(Request $request){
        $this->AuthLogin();

        $teacher = DB::table('tbl_teacher')->count();
        $student = DB::table('tbl_student')->count();
        $courses = DB::table('tbl_courses')->count();
        $class = DB::table('tbl_class')->count();
        $studentonline = DB::table('tbl_classonline')->count();
        $collect = DB::table('tbl_collect')->count();

        $all_student = $studentonline + $collect;

        $advise = DB::table('tbl_advise')->count();

        //thu
        $nap = 0;
        $all_collect = DB::table('tbl_collect')->get();
        foreach ($all_collect as $key => $value) {
            $collect_moneynap = intval(str_replace(',', '', $value->collect_moneynap));
            $nap += $collect_moneynap;
        }


        //chi phí khác
        $chi = 0;
        $all_spend = DB::table('tbl_spend')->get();
        foreach ($all_spend as $key => $value) {
            $spend_money = intval(str_replace(',', '', $value->spend_money));
            $chi += $spend_money;
        }

        //chi giáo viên
        $chigv = 0;
        $all_chiGV = DB::table('tbl_chigiaovien')->get();
        foreach ($all_chiGV as $key => $value) {
            $salary = intval(str_replace(',', '', $value->teacher_salary));
            $chigv += $salary;
        }

        $a = intval(str_replace(',', '', $chi));
        $b = intval(str_replace(',', '', $chigv));

        $all_chi = $a + $b;

        //lợi nhuận

        $total = $nap - $all_chi;


        return view('admin.finance.thongke')->with('teacher', $teacher)->with('student', $student)->with('class', $class)->with('courses', $courses)->with('all_student', $all_student)->with('advise', $advise)->with('nap', $nap)->with('all_chi', $all_chi)->with('total', $total);
    }
}

