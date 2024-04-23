<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class CategoryNew extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_cate_new(){
    	$this->AuthLogin();
    	return view('admin.catenew.add_cate_new');
    }

    public function all_cate_new(){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_new = DB::table('tbl_category_new')->orderby('cate_new_id', 'desc')->paginate(5);

            }elseif ($sort_by == 'az') {
                $all_new = DB::table('tbl_category_new')->orderby('cate_new_name', 'asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_new = DB::table('tbl_category_new')->orderby('cate_new_name', 'desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_new = DB::table('tbl_category_new')->orderby('cate_new_id', 'desc')->paginate(5);
        }
    	
    	return view('admin.catenew.all_cate_new')->with('all_new', $all_new);
    }

    public function save_cate_new(Request $request){
        $this->AuthLogin();

        $cate_new_name = $request -> cate_new_name;

        $result = DB::table('tbl_category_new')->where('cate_new_name', $cate_new_name) -> first();

    	$data = array();
    	$data['cate_new_name'] = $cate_new_name;
    	$data['cate_new_slug'] = $request->cate_new_slug;
    	$data['cate_new_desc'] = $request->cate_new_desc;
    	$data['cate_new_status'] = $request->cate_new_status;

        if(isset($result)){
            Session::put('message','Danh mục đã có!');
            return Redirect::to('add-cate-new');
        }else{
            DB::table('tbl_category_new')->insert($data);
            Session::put('message','Thêm danh mục khoá học thành công!');
            return Redirect::to('all-cate-new');
        }

    	DB::table('tbl_category_new')->insert($data);
    	Session::put('message','Thêm danh mục tin tức thành công!');
    	return Redirect::to('all-cate-new');
    }

    public function unactive_cate_new($cate_new_id){
        $this->AuthLogin();
        DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->update(['cate_new_status'=>0]);
        Session::put('message','Hiển thị danh mục tin tức thành công!');
        return Redirect::to('all-cate-new');
    }

    public function active_cate_new($cate_new_id){
        $this->AuthLogin();
        DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->update(['cate_new_status'=>1]);
        Session::put('message','Ẩn danh mục tin tức thành công!');
        return Redirect::to('all-cate-new');
    }

    public function edit_cate_new($cate_new_id){
        $this->AuthLogin();
        $edit_category_new = DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->get();
        return view('admin.catenew.edit_cate_new')->with('edit_category_new', $edit_category_new);
    }

    public function update_cate_new(Request $request, $cate_new_id){
        $this->AuthLogin();
        $data = array();
        $data['cate_new_name'] = $request->cate_new_name;
        $data['cate_new_slug'] = $request->cate_new_slug;
        $data['cate_new_desc'] = $request->cate_new_desc;
        DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->update($data);
        Session::put('message','Cập nhật danh mục tin tức thành công!');
        return Redirect::to('all-cate-new');
    }

    public function delete_cate_new($cate_new_id){
        $this->AuthLogin();

        $all_new = DB::table('tbl_new') ->where('cate_new_id', $cate_new_id) ->exists();

        if($all_new){
            Session::put('message','Tin tức đang được liên kết, Xoá không thành công!');
            return Redirect::to('all-cate-new');
        }else{
            DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->delete();
            Session::put('message','Xoá danh mục tin tức thành công!');
            return Redirect::to('all-cate-new');
        }

        DB::table('tbl_category_new')->where('cate_new_id', $cate_new_id)->delete();
        Session::put('message','Xoá danh mục tin tức thành công!');
        return Redirect::to('all-cate-new');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_category = DB::table('tbl_category_new')->paginate(5);
        
        $search_category = DB::table('tbl_category_new')->where('cate_new_name', 'like', '%'.$keywords.'%')->orderby('cate_new_id', 'desc')->paginate(5);

       return view('admin.catenew.search_cate_new')->with('all_category', $all_category)->with('search_category', $search_category);
    }

}
