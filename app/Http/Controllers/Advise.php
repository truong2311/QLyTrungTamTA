<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

class Advise extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function all_advise(Request $request){
        $this->AuthLogin();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'all'){
                $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->orderby('tbl_advise.advise_id','desc')->paginate(5);

            }elseif($sort_by == 'roi'){
                $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->where('tbl_advise.advise_status', '0')->orderby('tbl_advise.advise_id','asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'chua') {
                $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->where('tbl_advise.advise_status', '1')->orderby('tbl_advise.advise_id','desc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'az') {
                $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->orderby('tbl_advise.advise_name','asc')->paginate(5)->appends(request()->query());

            }elseif ($sort_by == 'za') {
                $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->orderby('tbl_advise.advise_name','desc')->paginate(5)->appends(request()->query());
            }

        }else{
            $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->orderby('tbl_advise.advise_id','desc')->paginate(5);

        }

        return view('admin.advise.all_advise')->with('all_advise', $all_advise);

    }

    public function unactive_advise($advise_id){
        $this->AuthLogin();
        DB::table('tbl_advise')->where('advise_id', $advise_id)->update(['advise_status'=>0]);
        Session::put('message','Yêu cầu chưa được tư vấn!');
        return Redirect::to('all-advise');
    }

    public function active_advise($advise_id){
        $this->AuthLogin();
        DB::table('tbl_advise')->where('advise_id', $advise_id)->update(['advise_status'=>1]);
        Session::put('message','Yêu cầu đã được tư vấn!');
        return Redirect::to('all-advise');
    }

    public function search(Request $request){
        $this->AuthLogin();

        $keywords = $request->keywords_submits;

        $all_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->orderby('tbl_advise.advise_id','desc')->get();
        
        $search_advise = DB::table('tbl_advise')->join('tbl_category_coueses','tbl_category_coueses.category_id','=','tbl_advise.category_id')->where('advise_name', 'like', '%'.$keywords.'%')->orderby('tbl_advise.advise_id', 'desc')->get();

       return view('admin.advise.search')->with('all_advise', $all_advise)->with('search_advise', $search_advise);
    }
}
