@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật khoá học
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_coursesE as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-coursesE/'.$edit_value->coursesE_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khoá học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="coursesE_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" value="{{$edit_value->coursesE_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="coursesE_slug" class="form-control" id="convert_slug" placeholder="Slug" value="{{$edit_value->coursesE_slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục khoá học</label>
                                    <select name="category" class="form-control input-sm m-bot15">
                                        @foreach($category as $key =>$category)
                                            @if($category->category_id==$edit_value->category_id)
                                            <option selected value="{{$category->category_id}}">{{$category->category_name}}</option>
                                            @else
                                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="coursesE_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/courses/'.$edit_value->coursesE_image)}}" height="50" width="50">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung khoá học</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="coursesE_content" id="exampleInputPassword1">{{$edit_value->coursesE_title}}</textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng chỗ ngồi</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Điền kiểu số" name="coursesE_seats" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_seats}}">
                                </div>

{{--                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng buổi học</label>
                                    <input type="time" name="coursesE_starttime" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_starttime}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng buổi học</label>
                                    <input type="time" name="coursesE_endtime" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_endtime}}">
                                </div>
 --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng buổi học</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Điền kiểu số" name="coursesE_number" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_number}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá tiền</label>
                                    <input type="text" name="coursesE_tuition" data-validation="length" data-validation-length="min7" data-validation-error-msg="Điền kiểu số - tối thiểu 7 ký tự" class="form-control tuition" id="exampleInputEmail1" value="{{$edit_value->coursesE_tuition}}">
                                </div>

{{--                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày bắt đầu học</label>
                                    <input type="date" name="coursesE_startday" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_startday}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày kết thúc</label>
                                    <input type="date" name="coursesE_endday" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_endday}}">
                                </div>
                                 --}}
                                <button type="submit" name="category_courses" class="btn btn-info">Cập nhật thông tin khoá học</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
