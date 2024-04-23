<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
  
use App\Http\Controllers\LoginGoogleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');

Route::get('/aboutus','App\Http\Controllers\HomeController@about_us');
Route::get('/learn','App\Http\Controllers\HomeController@learn');

//liên hệ
Route::get('/contact','App\Http\Controllers\HomeController@lien_he');


//Danh mục khoá học trang chủ
Route::get('/danhmuc_khoahoc/{coursesE_slug}','App\Http\Controllers\CategoryCourses@show_category_home');

//Danh mục tin tức trang chủ 
Route::get('/danhmuc_tintuc/{new_slug}','App\Http\Controllers\ManagementNews@show_category_new_home');

//Chi tiết khoá học
Route::get('/chitiet_khoahoc/{coursesE_slug}','App\Http\Controllers\ManagementCourses@details_courses');

//Chi tiết tin tức
Route::get('/chitiet_tintuc/{new_slug}','App\Http\Controllers\ManagementNews@details_news');


Route::post('/uploads-ckeditor','App\Http\Controllers\ManagementNews@ckeditor_image');

//Giáo viên
Route::get('/giao-vien','App\Http\Controllers\ManagementTeacher@show_teacher1');

//Backend
Route::get('/admin','App\Http\Controllers\AdminController@index');

Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

//Route::match(['get', 'post'], '/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin');

Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

Route::get('/logout','App\Http\Controllers\AdminController@logout');

//ManagementTeacher
//thêm giáo viên
Route::get('/add-teacher','App\Http\Controllers\ManagementTeacher@add_teacher');
//danh sách giáo viên
Route::get('/all-teacher','App\Http\Controllers\ManagementTeacher@all_teacher');
//lưu giáo viên
Route::post('/save-teacher','App\Http\Controllers\ManagementTeacher@save_teacher');
//nghỉ
Route::get('/unactive-teacher/{teacher_id}','App\Http\Controllers\ManagementTeacher@unactive_teacher');
//làm
Route::get('/active-teacher/{teacher_id}','App\Http\Controllers\ManagementTeacher@active_teacher');
//cập nhật giáo viên
Route::post('/update-teacher/{teacher_id}','App\Http\Controllers\ManagementTeacher@update_teacher');
//chỉnh sửa
Route::get('/edit-teacher/{teacher_id}','App\Http\Controllers\ManagementTeacher@edit_teacher');
//xoá
Route::get('/delete-teacher/{teacher_id}','App\Http\Controllers\ManagementTeacher@delete_teacher');
//tìm kiếm
Route::post('/search-teacher','App\Http\Controllers\ManagementTeacher@search');
//in
//xoá
Route::get('/print-teacher','App\Http\Controllers\ManagementTeacher@print_teacher');



//Danh mục khoá học
//thêm danh mục
Route::get('/add-courses','App\Http\Controllers\CategoryCourses@add_courses');
//danh sách danh mục
Route::get('/all-courses','App\Http\Controllers\CategoryCourses@all_courses');
//chỉnh sửa danh mục
Route::get('/edit-courses/{category_courses_id}','App\Http\Controllers\CategoryCourses@edit_category_courses');
//xoá danh mục
Route::get('/delete-courses/{category_courses_id}','App\Http\Controllers\CategoryCourses@delete_category_courses');
//cập nhật danh mục
Route::post('/update-category-courses/{category_courses_id}','App\Http\Controllers\CategoryCourses@update_category_courses');
//lưu danh mục
Route::post('/save-category-courses','App\Http\Controllers\CategoryCourses@save_courses');
//ấn danh mục
Route::get('/unactive-category-courses/{category_courses_id}','App\Http\Controllers\CategoryCourses@unactive_category_courses');
//hiển thị danh mục
Route::get('/active-category-courses/{category_courses_id}','App\Http\Controllers\CategoryCourses@active_category_courses');
//tìm kiếm
Route::post('/search-cate','App\Http\Controllers\CategoryCourses@search');


//Danh mục tin tức
//thêm danh mục
Route::get('/add-cate-new','App\Http\Controllers\CategoryNew@add_cate_new');
//danh sách danh mục
Route::get('/all-cate-new','App\Http\Controllers\CategoryNew@all_cate_new');
//chỉnh sửa danh mục
Route::get('/edit-cate-new/{cate_new_id}','App\Http\Controllers\CategoryNew@edit_cate_new');
//xoá danh mục
Route::get('/delete-cate-new/{cate_new_id}','App\Http\Controllers\CategoryNew@delete_cate_new');
//cập nhật danh mục
Route::post('/update-cate-new/{cate_new_id}','App\Http\Controllers\CategoryNew@update_cate_new');
//lưu danh mục
Route::post('/save-cate-new','App\Http\Controllers\CategoryNew@save_cate_new');
//ấn danh mục
Route::get('/unactive-cate-new/{cate_new_id}','App\Http\Controllers\CategoryNew@unactive_cate_new');
//hiển thị danh mục
Route::get('/active-cate-new/{cate_new_id}','App\Http\Controllers\CategoryNew@active_cate_new');
//tìm kiếm
Route::post('/search-cate-new','App\Http\Controllers\CategoryNew@search');


//Tin tức
//thêm tin tức
Route::get('/add-news','App\Http\Controllers\ManagementNews@add_news');
//danh sách danh mục
Route::get('/all-news','App\Http\Controllers\ManagementNews@all_news');
//chỉnh sửa danh mục
Route::get('/edit-news/{new_id}','App\Http\Controllers\ManagementNews@edit_news');
//xoá danh mục
Route::get('/delete-news/{new_id}','App\Http\Controllers\ManagementNews@delete_news');
//cập nhật danh mục
Route::post('/update-news/{new_id}','App\Http\Controllers\ManagementNews@update_news');
//lưu danh mục
Route::post('/save-news','App\Http\Controllers\ManagementNews@save_news');
//ấn danh mục
Route::get('/unactive-news/{new_id}','App\Http\Controllers\ManagementNews@unactive_news');
//hiển thị danh mục
Route::get('/active-news/{new_id}','App\Http\Controllers\ManagementNews@active_news');
//tìm kiếm
Route::post('/search-new','App\Http\Controllers\ManagementNews@search');


//ManagementStudent
//thêm học sinh
Route::get('/add-student','App\Http\Controllers\ManagementStudent@add_student');
//danh sách học sinh
Route::get('/all-student','App\Http\Controllers\ManagementStudent@all_student');
//lưu 
Route::post('/save-student','App\Http\Controllers\ManagementStudent@save_student');
//nghỉ
Route::get('/unactive-student/{student_id}','App\Http\Controllers\ManagementStudent@unactive_student');
//làm
Route::get('/active-student/{student_id}','App\Http\Controllers\ManagementStudent@active_student');
//cập nhật 
Route::post('/update-student/{student_id}','App\Http\Controllers\ManagementStudent@update_student');
//chỉnh sửa
Route::get('/edit-student/{student_id}','App\Http\Controllers\ManagementStudent@edit_student');
//xoá
Route::get('/delete-student/{student_id}','App\Http\Controllers\ManagementStudent@delete_student');
//tìm kiếm
Route::post('/search-student','App\Http\Controllers\ManagementStudent@search');

//Khoá học
//thêm 
Route::get('/add-coursesE','App\Http\Controllers\ManagementCourses@add_coursesE');
//danh sách 
Route::get('/all-coursesE','App\Http\Controllers\ManagementCourses@all_coursesE');
//chỉnh sửa 
Route::get('/edit-coursesE/{coursesE_id}','App\Http\Controllers\ManagementCourses@edit_coursesE');
//xoá 
Route::get('/delete-coursesE/{coursesE_id}','App\Http\Controllers\ManagementCourses@delete_coursesE');
//cập nhật 
Route::post('/update-coursesE/{oursesE_id}','App\Http\Controllers\ManagementCourses@update_coursesE');
//lưu 
Route::post('/save-coursesE','App\Http\Controllers\ManagementCourses@save_coursesE');
//ấn 
Route::get('/unactive-coursesE/{coursesE_id}','App\Http\Controllers\ManagementCourses@unactive_coursesE');
//hiển thị 
Route::get('/active-coursesE/{coursesE_id}','App\Http\Controllers\ManagementCourses@active_coursesE');
//tìm kiếm
Route::post('/search','App\Http\Controllers\ManagementCourses@search');


//Lớp học
//thêm 
Route::get('/add-class','App\Http\Controllers\ManagementClass@add_class');
//danh sách 
Route::get('/all-class','App\Http\Controllers\ManagementClass@all_class');
//chỉnh sửa 
Route::get('/edit-class/{class_id}','App\Http\Controllers\ManagementClass@edit_class');
//xoá 
Route::get('/delete-class/{class_id}','App\Http\Controllers\ManagementClass@delete_class');
//cập nhật 
Route::post('/update-class/{class_id}','App\Http\Controllers\ManagementClass@update_class');
//lưu 
Route::post('/save-class','App\Http\Controllers\ManagementClass@save_class');
//ấn 
Route::get('/unactive-class/{class_id}','App\Http\Controllers\ManagementClass@unactive_class');
//hiển thị 
Route::get('/active-class/{class_id}','App\Http\Controllers\ManagementClass@active_class');

//giỏ hàng
Route::post('/save-cart','App\Http\Controllers\ManagementCart@save_cart');

//login google

Route::get('auth/google','App\Http\Controllers\LoginGoogleController@redirectToGoogle');
Route::get('/auth/google/callback','App\Http\Controllers\LoginGoogleController@handleGoogleCallback');
Route::get('/logoutHome','App\Http\Controllers\LoginGoogleController@logoutHome');*/