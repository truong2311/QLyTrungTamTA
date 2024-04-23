@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thông tin học sinh
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_student as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-student/'.$edit_value->student_id)}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên học sinh</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$edit_value->student_name}}" name="student_name" class="form-control" id="exampleInputEmail1" placeholder="Tên học sinh">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" data-validation="number" data-validation-number="min10" data-validation-error-msg="Điền kiểu số"  value="{{$edit_value->student_phone}}"  name="student_phone" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" data-validation="length" data-validation-length="min6" data-validation-error-msg="Điền ít nhất 6 ký tự" value="{{$edit_value->student_address}}" name="student_address" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" data-validation="length" data-validation-length="min11" data-validation-error-msg="Điền ít nhất 11 ký tự" value="{{$edit_value->student_email}}" name="student_email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="student_desc" id="exampleInputPassword1" placeholder="Mô tả">{{$edit_value->student_name}}"  </textarea> 
                                </div>
                                
                                <button type="submit" name="add_student" class="btn btn-info">Cập nhật học sinh</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
