@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Trả lương giáo viên
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($chamcong as $key => $cate_pro)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-chigiaovien/'.$cate_pro->chamcong_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên giáo viên</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$cate_pro->teacher_name}}" name="teacher_name" class="form-control" id="exampleInputEmail1" placeholder="Tên giáo viên">
                                </div>                                

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lương</label>
                                    <input type="text" value="{{number_format($cate_pro->teacher_salary + $cate_pro->teacher_number * $cate_pro->teacher_price)}}" name="teacher_salary" class="form-control tuition" id="exampleInputEmail1" placeholder="Lương">
                                </div>
                                
                                <button type="submit" name="add_teacher" class="btn btn-info">Xác nhận</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
