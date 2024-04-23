@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm khoá học
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-coursesE')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khoá học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="coursesE_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên khoá học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="coursesE_slug" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục khoá học</label>
                                    <select name="category" class="form-control input-sm m-bot15">
                                        @foreach($category as $key =>$category)
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="coursesE_image" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung khoá học</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="coursesE_content" id="abc" placeholder="Nội dung khoá học"> </textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng chỗ ngồi</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Điền kiểu số" name="coursesE_seats" class="form-control" id="exampleInputEmail1" placeholder="Số lượng chỗ ngồi">
                                </div>

{{--                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giờ vào học</label>
                                    <input type="time" name="coursesE_starttime" class="form-control" id="exampleInputEmail1" placeholder="Số lượng buổi học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giờ kết thúc</label>
                                    <input type="time" name="coursesE_endtime" class="form-control" id="exampleInputEmail1" placeholder="Số lượng buổi học">
                                </div>
 --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng buổi học</label>
                                    <input type="text" name="coursesE_number" data-validation="number" data-validation-error-msg="Điền kiểu số" class="form-control" id="exampleInputEmail1" placeholder="Số lượng buổi học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá tiền</label>
                                    <input type="text" data-validation="length" data-validation-length="min7" data-validation-error-msg="Điền kiểu số" name="coursesE_tuition" class="form-control tuition -  tối thiểu 7 ký tự" id="exampleInputEmail1" placeholder="Giá tiền khoá học">
                                </div>

{{--                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày bắt đầu học</label>
                                    <input type="date" name="coursesE_startday" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày kết thúc</label>
                                    <input type="date" name="coursesE_endday" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div> --}}

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="coursesE_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả khoá học</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="coursesE_desc" id="ckeditor1" placeholder="Mô tả khoá học"> </textarea> 
                                </div>
                                
                                <button type="submit" name="add_coursesE" class="btn btn-info">Thêm khoá học</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
