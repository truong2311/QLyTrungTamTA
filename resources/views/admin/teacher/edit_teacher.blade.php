@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thông tin giáo viên
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_teacher as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-teacher/'.$edit_value->teacher_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên giáo viên</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$edit_value->teacher_name}}" name="teacher_name" class="form-control" id="exampleInputEmail1" placeholder="Tên giáo viên">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="teacher_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/teacher/'.$edit_value->teacher_image)}}" height="50" width="50">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Căn cước công dân</label>
                                    <input type="text" data-validation="number" value="{{$edit_value->teacher_cccd}}" name="teacher_cccd" class="form-control" id="exampleInputEmail1" placeholder="Căn cước công dân">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" data-validation="number" value="{{$edit_value->teacher_phone}}"  name="teacher_phone" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trường đại học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$edit_value->teacher_university}}" name="teacher_university" class="form-control" id="exampleInputEmail1" placeholder="Trường đại học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chứng chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" value="{{$edit_value->teacher_certificate}}" name="teacher_certificate" class="form-control" id="exampleInputEmail1" placeholder="Chứng chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$edit_value->teacher_address}}" name="teacher_address" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" data-validation="length" data-validation-length="min11" data-validation-error-msg="Điền ít nhất 11 ký tự" value="{{$edit_value->teacher_email}}" name="teacher_email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự"  value="{{$edit_value->teacher_password}}" name="teacher_password" class="form-control" id="exampleInputEmail1" placeholder="Mật khẩu">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lương</label>
                                    <input type="text" data-validation="length" data-validation-length="min7" data-validation-error-msg="Điền ít nhất 7 ký tự" value="{{$edit_value->teacher_salary}}" name="teacher_salary" class="form-control tuition" id="exampleInputEmail1" placeholder="Lương">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="teacher_desc" id="exampleInputPassword1" placeholder="Mô tả">{{$edit_value->teacher_name}}"  </textarea> 
                                </div>
                                
                                <button type="submit" name="add_teacher" class="btn btn-info">Cập nhật học sinh</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
