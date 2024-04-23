@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm học sinh vào lớp
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
                                <form role="form" action="{{URL::to('/save-student-class')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên lớp học</label>
                                    <select name="class_id" class="form-control input-sm m-bot15">
                                        @foreach($class as $key =>$class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên học sinh</label>
                                    <select name="student_id" class="form-control input-sm m-bot15">
                                        @foreach($student as $key =>$student)
                                        <option value="{{$student->student_id}}">{{$student->student_name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_class" class="btn btn-info">Thêm học sinh vào lớp</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
