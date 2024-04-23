@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Tạo lớp học
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
                                <form role="form" action="{{URL::to('/save-class')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên lớp học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="class_name" class="form-control" id="exampleInputEmail1" placeholder="Tên lớp học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên khoá học</label>
                                    <select name="coursesE_id" class="form-control input-sm m-bot15">
                                        @foreach($courses as $key =>$courses)
                                        <option value="{{$courses->coursesE_id}}">{{$courses->coursesE_title}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên giáo viên</label>
                                    <select name="teacher_id" class="form-control input-sm m-bot15">
                                        @foreach($teacher as $key =>$teacher)
                                        <option value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên giáo viên (Phụ nếu có)</label>
                                    <select name="teacher_id2" class="form-control input-sm m-bot15">
                                        @foreach($teacher2 as $key =>$teacher2)
                                        <option value="0">Không</option>
                                        <option value="{{$teacher2->teacher_id}}">{{$teacher2->teacher_name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="class_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiển thị</option>
                                        <option value="1">Ẩn</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lịch học</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="class_desc" id="exampleInputPassword1" placeholder="Mô tả khoá học"> </textarea> 
                                </div>
                                
                                <button type="submit" name="add_class" class="btn btn-info">Tạo lớp học</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
