@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chốt công giáo viên
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
                                <form role="form" action="{{URL::to('/save-chamcong')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên giáo viên</label>
                                    <select name="teacher_id" class="form-control input-sm m-bot15">
                                        @foreach($teacher as $key =>$teacher)
                                        <option value="{{$teacher->teacher_id}}">{{$teacher->teacher_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày chốt công</label>
                                    <input type="date" name="teacher_chamcong" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng ca</label>
                                    <input type="number" data-validation="munber" data-validation-error-msg="Điền kiểu số" name="teacher_number" class="form-control" id="exampleInputEmail1" placeholder="Căn cước công dân">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá tiền/ca</label>
                                    <input type="text" data-validation="munber" data-validation-error-msg="Điền kiểu số" name="teacher_price" class="form-control" id="exampleInputEmail1" placeholder="Căn cước công dân">
                                </div>
                                                                
                                <button type="submit" name="add_teacher" class="btn btn-info">Chốt công</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
