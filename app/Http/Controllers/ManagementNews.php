<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
//session_start();

class ManagementNews extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_news(){
        $this->AuthLogin();
    	$cate_new = DB::table('tbl_category_new')->orderby('cate_new_id','desc')->get();
    	return view('admin.new.add_news')->with('cate_new', $cate_new);
    }

    public function all_news(){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_id','desc')->paginate(3);

            }elseif ($sort_by == 'az') {
                        $all_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_title','asc')->paginate(3)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                        $all_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_title','desc')->paginate(3)->appends(request()->query());
            }

        }else{
            $all_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_id','desc')->paginate(3);
        }
    	return view('admin.new.all_news')->with('all_new', $all_new);
    }

    public function save_news(Request $request){
        $this->AuthLogin();    
     	$data = array();
    	$data['cate_new_id'] = $request->cate_new_id;
    	$data['new_title'] = $request->new_title;
    	$data['new_slug'] = $request->new_slug;
    	$data['new_desc'] = $request->new_desc;
    	$data['new_content'] = $request->new_content;
    	$data['new_meta_desc'] = $request->new_meta_desc;
    	$data['new_meta_keywords'] = $request->new_meta_keywords;
    	$data['new_status'] = $request->new_status;

    	$get_image = $request->file('new_image');
    	if($get_image){
        	$get_name_image = $get_image->getClientOriginalName();
        	$name_image = current(explode('.', $get_name_image));
        	$new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        	$get_image->move('public/upload/news', $new_image);
        	$data['new_image'] = $new_image;
        	DB::table('tbl_new')->insert($data);
        	Session::put('message','Thêm tin tức thành công!');
        	return Redirect::to('all-news');
    	} 
    	$data['new_image'] = '';
    	DB::table('tbl_new')->insert($data);
    	Session::put('message','Thêm tin tức thành công!');
    	return Redirect::to('all-news');
    }

    public function unactive_news($new_id){
        $this->AuthLogin();
        DB::table('tbl_new')->where('new_id', $new_id)->update(['new_status'=>0]);
        Session::put('message','Hiển thị tin tức thành công!');
        return Redirect::to('all-news');
    }

    public function active_news($new_id){
        $this->AuthLogin();
        DB::table('tbl_new')->where('new_id', $new_id)->update(['new_status'=>1]);
        Session::put('message','Ẩn tin tức thành công!');
        return Redirect::to('all-news');
    }

    public function edit_news($new_id){
        $this->AuthLogin();
        $cate_new = DB::table('tbl_category_new')->orderby('cate_new_id','desc')->get();

        $edit_news = DB::table('tbl_new')->where('new_id', $new_id)->get();
        return view('admin.new.edit_news')->with('edit_news', $edit_news)->with('cate_new', $cate_new);
    }

    public function update_news(Request $request, $new_id){
        $this->AuthLogin();
        $data = array();
        $data['cate_new_id'] = $request->cate_new_id;
    	$data['new_title'] = $request->new_title;
    	$data['new_slug'] = $request->new_slug;
    	$data['new_desc'] = $request->new_desc;
    	$data['new_content'] = $request->new_content;
    	$data['new_meta_desc'] = $request->new_meta_desc;
    	$data['new_meta_keywords'] = $request->new_meta_keywords;

    	$get_image = $request->file('new_image');
    	if($get_image){
        	$get_name_image = $get_image->getClientOriginalName();
        	$name_image = current(explode('.', $get_name_image));
        	$new_image = $name_image.rand(0,99). '.' .$get_image->getClientOriginalExtension();
        	$get_image->move('public/upload/news', $new_image);
        	$data['new_image'] = $new_image;
        	DB::table('tbl_new')->insert($data);
        	Session::put('message','Thêm tin tức thành công!');
        	return Redirect::to('all-news');
    	} 
        DB::table('tbl_new')->where('new_id', $new_id)->update($data);
        Session::put('message','Cập nhật tin tức thành công!');
        return Redirect::to('all-news');
    }

    public function delete_news($new_id){
        $this->AuthLogin();

        $image = DB::table('tbl_new')->orderby('new_id','desc')->first();

        $new_image = $image->new_image;
        unlink('public/upload/news/'.$new_image);

        DB::table('tbl_new')->where('new_id', $new_id)->delete();
        Session::put('message','Xoá tin tức thành công!');
        return Redirect::to('all-news');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_id','desc')->get();
        
        $search_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->orderby('tbl_new.new_id','desc')->where('new_title', 'like', '%'.$keywords.'%')->get();

       return view('admin.new.search_new')->with('all_new', $all_new)->with('search_new', $search_new);
    }

    //fontend
    public function show_category_new_home($new_slug){

        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();
        
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $cate = DB::table('tbl_category_new')->where('cate_new_slug', $new_slug)->take(1)->get();

        foreach ($cate as $key => $ca) {
            $cate_id = $ca->cate_new_id;
        }

        $new_by_id = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->where('tbl_category_new.cate_new_id', $cate_id)->where('tbl_new.new_status', '0')->get();

        $cate_new_name = DB::table('tbl_category_new')->where('tbl_category_new.cate_new_slug', $new_slug)->first();

        return view('pages.tintuc.danhmucbaiviet')->with('category', $category)->with('cate_new', $cate_new)->with('new_by_id', $new_by_id)->with('cate_new_name', $cate_new_name);
    }

    public function details_news($new_slug){
        $cate_new = DB::table('tbl_category_new')->where('cate_new_status', '0')->orderby('cate_new_id','desc')->get();
        
        $category = DB::table('tbl_category_coueses')->where('category_status', '0')->orderby('category_id','desc')->get();

        $details_news = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->where('tbl_new.new_slug', $new_slug)->where('tbl_new.new_status', '0')->take(1)->get();

        foreach ($details_news as $key => $details) {
            $cate_id = $details->cate_new_id;
            $cate_new_id = $details->cate_new_id;
        }

        
        $related_new = DB::table('tbl_new')->join('tbl_category_new','tbl_category_new.cate_new_id','=','tbl_new.cate_new_id')->where('tbl_category_new.cate_new_id', $cate_new_id)->where('new_status', '0')->whereNotIn('new_slug', [$new_slug])->take(5)->get();
        
        return view('pages.tintuc.show_detail_new')->with('category', $category)->with('cate_new', $cate_new)->with('details_news', $details_news)->with('related_new', $related_new);
    }

    public function ckeditor_image(Request $request){
        if($request->hasFile('upload')){

            $originName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move('public/upload/ckeditor', $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/upload/ckeditor'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

}
