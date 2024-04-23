<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
  
use App\Http\Controllers\LoginGoogleController;

//Frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');

//về chúng tôi
Route::get('/aboutus','App\Http\Controllers\HomeController@about_us');
//pp học
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

//uploads file ảnh ckeditor
Route::post('/uploads-ckeditor','App\Http\Controllers\ManagementNews@ckeditor_image');

//Giáo viên
Route::get('/giao-vien','App\Http\Controllers\ManagementTeacher@show_teacher1');

//Đăng ký giỏ hàng
Route::get('/dang-ky','App\Http\Controllers\ManagementCart@dang_ky');
//Đăng ký giỏ hàng
Route::get('/dang-ky1','App\Http\Controllers\ManagementCart@dang_ky1');
//show
Route::get('/delete-show-online/{classonline_id}','App\Http\Controllers\ManagementCart@delete_show_online');

//Backend
Route::get('/admin','App\Http\Controllers\AdminController@index');

Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

//Route::match(['get', 'post'], '/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin');

Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

Route::get('/logout','App\Http\Controllers\AdminController@logout');

////ManagementTeacher
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

////chấm công
//thêm
Route::get('/add-chamcong','App\Http\Controllers\ManagementTeacher@add_chamcong');
//lưu
Route::post('/save-chamcong','App\Http\Controllers\ManagementTeacher@save_chamcong');
//danh sách giáo viên
Route::get('/all-chamcong','App\Http\Controllers\ManagementTeacher@all_chamcong');

//chi giáo viên
Route::get('/add-chigiaovien/{chamcong_id}','App\Http\Controllers\ManagementTeacher@add_chigiaovien');
//cập nhật chi giáo viên
Route::post('/save-chigiaovien/{chamcong_id}','App\Http\Controllers\ManagementTeacher@save_chigiaovien');



////Giáo viên đăng nhập
Route::get('/teacher','App\Http\Controllers\ManagementTeacher@teacher_index');

Route::get('/dashboard-teacher','App\Http\Controllers\ManagementTeacher@show_dashboard_teacher');

Route::post('/teacher-dashboard','App\Http\Controllers\ManagementTeacher@teacher');

Route::get('/login-teacher','App\Http\Controllers\ManagementTeacher@teacher_index');

Route::get('/logout-teacher','App\Http\Controllers\ManagementTeacher@logout_teacher');
//lịch học
Route::get('/all-classteacher','App\Http\Controllers\ManagementTeacher@all_classteacher');
//tìm kiếm lịch học
Route::post('/search-class-teacher','App\Http\Controllers\ManagementTeacher@search_class_teacher');



////Danh mục khoá học
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


////Danh mục tin tức
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


////Tin tức
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


////ManagementStudent
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

////Khoá học
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


////Lớp học
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
//tìm kiếm
Route::post('/search-class','App\Http\Controllers\ManagementClass@search');
//danh sách 
Route::get('/all-list-class','App\Http\Controllers\ManagementClass@all_list_class');
//tìm kiếm
Route::post('/search-list-class','App\Http\Controllers\ManagementClass@search_list_class');

////Thêm học sinh vào lớp học
//thêm 
Route::get('/add-student-class','App\Http\Controllers\ManagementClass@add_student_class');
//danh sách 
Route::get('/all-list-student-class','App\Http\Controllers\ManagementClass@all_list_student_class');
//xoá 
Route::get('/delete-student-class/{student_class_id}','App\Http\Controllers\ManagementClass@delete_student_class');
//lưu 
Route::post('/save-student-class','App\Http\Controllers\ManagementClass@save_student_class');
//tìm kiếm
Route::post('/search-student-class','App\Http\Controllers\ManagementClass@search_student_class');


////giỏ hàng
//lưu
Route::post('/save-cart','App\Http\Controllers\ManagementCart@save_cart');
//show
Route::get('/show-cart','App\Http\Controllers\ManagementCart@show_cart');
//show
Route::get('/all-online','App\Http\Controllers\ManagementCart@all_online');
//show
Route::get('/delete-online/{classonline_id}','App\Http\Controllers\ManagementCart@delete_online');
//ấn 
Route::get('/unactive-online/{classonline_id}','App\Http\Controllers\ManagementCart@unactive_online');
//hiển thị 
Route::get('/active-online/{classonline_id}','App\Http\Controllers\ManagementCart@active_online');
//tìm kiếm
Route::post('/search-online','App\Http\Controllers\ManagementCart@search_online');


////login google
Route::get('auth/google','App\Http\Controllers\LoginGoogleController@redirectToGoogle');
Route::get('/auth/google/callback','App\Http\Controllers\LoginGoogleController@handleGoogleCallback');
Route::get('/logoutHome','App\Http\Controllers\LoginGoogleController@logoutHome');
//Route::get('/auth/google', [LoginGoogleController::class, 'redirectToGoogle']);
//Route::get('/auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);


////thu

Route::get('/thu','App\Http\Controllers\Finance@list_class');
//thêm 
Route::get('/add-collect/{class_id}','App\Http\Controllers\Finance@add_collect');
//danh sách 
Route::get('/all-collect','App\Http\Controllers\Finance@all_collect');
//chỉnh sửa 
Route::get('/edit-collect/{collect_id}','App\Http\Controllers\Finance@edit_collect');
//xoá 
Route::get('/delete-collect/{collect_id}','App\Http\Controllers\Finance@delete_collect');
//cập nhật 
Route::post('/update-collect/{collect_id}','App\Http\Controllers\Finance@update_collect');
//lưu 
Route::post('/save-collect/{class_id}','App\Http\Controllers\Finance@save_collect');
//tìm kiếm
Route::post('/search-collect','App\Http\Controllers\Finance@search_collect');


////chi
//thêm 
Route::get('/chi','App\Http\Controllers\Finance@add_spend');
//danh sách 
Route::get('/all-spend','App\Http\Controllers\Finance@all_spend');
//chỉnh sửa 
Route::get('/edit-spend/{spend_id}','App\Http\Controllers\Finance@edit_spend');
//xoá 
Route::get('/delete-spend/{spend_id}','App\Http\Controllers\Finance@delete_spend');
//cập nhật 
Route::post('/update-spend/{spend_id}','App\Http\Controllers\Finance@update_spend');
//lưu 
Route::post('/save-spend','App\Http\Controllers\Finance@save_spend');
//tìm kiếm
Route::post('/search-spend','App\Http\Controllers\Finance@search_spend');

//thống kê
Route::get('/thongke','App\Http\Controllers\Finance@thong_ke');


////tư vấn
//lưu 
Route::post('/save-advise','App\Http\Controllers\HomeController@save_advise');
//danh sách 
Route::get('/all-advise','App\Http\Controllers\Advise@all_advise');
//ấn 
Route::get('/unactive-advise/{advise_id}','App\Http\Controllers\Advise@unactive_advise');
//hiển thị 
Route::get('/active-advise/{advise_id}','App\Http\Controllers\Advise@active_advise');
//tìm kiếm
Route::post('/search-advise','App\Http\Controllers\Advise@search');