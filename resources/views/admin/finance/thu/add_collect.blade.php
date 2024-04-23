@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm khoản thu
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>            
                            @foreach($all_class as $key => $edit_value)    
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-collect/'.$edit_value->class_id)}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khoá học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="coursesE_title" class="form-control" id="exampleInputEmail1" value="{{$edit_value->coursesE_title}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên lớp học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="class_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->class_name}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Học phí</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền kiểu số" name="coursesE_tuition" class="form-control tuition" id="exampleInputEmail1" value="{{$edit_value->coursesE_tuition}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày nạp</label>
                                    <input type="date" name="collect_day" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên học sinh</label>
                                    <select name="student_id" class="form-control input-sm m-bot15">
                                        @foreach($student as $student12)
                                        <option value="{{$student12->student_id}}">{{$student12->student_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Khuyến mãi</label>
                                    <select name="collect_promotion" class="form-control input-sm m-bot15">
                                        <option value="0">0%</option>
                                        <option value="1">10%</option>
                                        <option value="2">15%</option>
                                        <option value="3">20%</option>
                                    </select>
                                </div>                             

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền nạp</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Điền kiểu số" name="collect_moneynap" class="form-control" id="exampleInputEmail1">
                                </div>
                                
                                <button type="submit" name="add_category_courses" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>
            </div>

@endsection

