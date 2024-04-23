@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm giáo viên
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
                                <form role="form" action="{{URL::to('/save-teacher')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên giáo viên</label>
                                    <input type="text" data-validation="length" data-validation-length="min8" data-validation-error-msg="Điền ít nhất 5 ký tự" name="teacher_name" class="form-control" id="exampleInputEmail1" placeholder="Tên giáo viên">
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="teacher_image" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="teacher_dateofbirth" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Căn cước công dân</label>
                                    <input type="text" data-validation="munber" data-validation-error-msg="Điền kiểu số" name="teacher_cccd" class="form-control" id="exampleInputEmail1" placeholder="Căn cước công dân">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giới tính</label>
                                    <select name="teacher_gender" class="form-control input-sm m-bot15">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="teacher_phone" data-validation="number" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trường đại học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="teacher_university" class="form-control" id="exampleInputEmail1" placeholder="Đại học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chứng chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min2" data-validation-error-msg="Điền ít nhất 2 ký tự" name="teacher_certificate" class="form-control" id="exampleInputEmail1" placeholder="Chứng chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="teacher_address" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" data-validation="length" data-validation-length="min11" data-validation-error-msg="Điền ít nhất 11 ký tự" name="teacher_email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="teacher_password" class="form-control" id="exampleInputEmail1" placeholder="Mật khẩu">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lương</label>
                                    <input type="text" data-validation="length" data-validation-length="min7" data-validation-error-msg="Điền ít nhất 7 ký tự" name="teacher_salary" class="form-control tuition" id="exampleInputEmail1" placeholder="Lương">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày vào làm</label>
                                    <input type="date" name="teacher_startday" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                    <select name="teacher_status" class="form-control input-sm m-bot15">
                                        <option value="0">Đang làm</option>
                                        <option value="1">Nghỉ việc</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="teacher_desc" id="exampleInputPassword1" placeholder="Mô tả"> </textarea> 
                                </div>
                                                                
                                <button type="submit" name="add_teacher" class="btn btn-info">Thêm giáo viên</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
