@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật lớp học
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_class as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-class/'.$edit_value->class_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên lớp học</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="class_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->class_name}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên khoá học</label>
                                    <select name="courses" class="form-control input-sm m-bot15">
                                        @foreach($courses as $key =>$courses)
                                            @if($courses->coursesE_id==$edit_value->coursesE_id)
                                            <option selected value="{{$courses->coursesE_id}}">{{$courses->coursesE_title}}</option>
                                            @else
                                            <option value="{{$courses->coursesE_id}}">{{$courses->coursesE_title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên giáo viên</label>
                                    <select name="teacher" class="form-control input-sm m-bot15">
                                        @foreach($teacher as $key =>$teacher)
                                            @if($teacher->teacher_id==$edit_value->teacher_id)
                                            <option selected value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                                            @else
                                            <option value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên giáo viên (phụ)</label>
                                    <select name="teacher2" class="form-control input-sm m-bot15">
                                        @foreach($teacher2 as $key =>$teacher2)
                                            @if($teacher2->teacher_id==$edit_value->teacher_id2)
                                            <option selected value="{{$teacher2->teacher_id}}">{{$teacher2->teacher_name}}</option>
                                            @else
                                            <option value="{{$teacher2->teacher_id}}">{{$teacher2->teacher_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lịch học</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="class_desc" id="exampleInputPassword1" placeholder="Mô tả khoá học" value=""> {{$edit_value->class_desc}}</textarea> 
                                </div>

                                <button type="submit" name="add_class" class="btn btn-info">Cập nhật thông tin lớp học</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
