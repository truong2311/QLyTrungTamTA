@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm học sinh
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
                                <form role="form" action="{{URL::to('/save-student')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên học sinh</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="student_name" class="form-control" id="exampleInputEmail1" placeholder="Tên học sinh">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="student_dateofbirth" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Giới tính</label>
                                    <select name="student_gender" class="form-control input-sm m-bot15">
                                        <option value="0">Nam</option>
                                        <option value="1">Nữ</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" data-validation="number" data-validation-number="min10" data-validation-error-msg="Điền kiểu số" name="student_phone" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

{{--                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Lớp</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Điền ít nhất 1 ký tự" name="student_class" class="form-control" id="exampleInputEmail1" placeholder="Lớp">
                                </div> --}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min6" data-validation-error-msg="Điền ít nhất 6 ký tự" name="student_address" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" data-validation="length" data-validation-length="min11" data-validation-error-msg="Điền ít nhất 11 ký tự" name="student_email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="student_desc" id="exampleInputPassword1" placeholder="Mô tả"> </textarea> 
                                </div>
                                                                
                                <button type="submit" name="add_student" class="btn btn-info">Thêm học sinh</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
