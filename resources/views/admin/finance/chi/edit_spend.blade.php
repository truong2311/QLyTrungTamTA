@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa khoản chi
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>            
                            @foreach($edit_spend as $key => $edit_value)    
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-spend/'.$edit_value->spend_id)}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khoản thu</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="spend_name" class="form-control" id="exampleInputEmail1" value="{{$edit_value->spend_name}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" row="5" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" class="form-control" name="spend_content" id="exampleInputPassword1">{{$edit_value->spend_content}}</textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền kiểu số" name="spend_money" class="form-control tuition" id="exampleInputEmail1" value="{{$edit_value->spend_money}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày chi</label>
                                    <input type="date" name="spend_date" class="form-control" id="exampleInputEmail1" value="{{$edit_value->spend_date}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" class="form-control" name="spend_desc" id="exampleInputPassword1" value=""> {{$edit_value->spend_desc}}</textarea> 
                                </div>
                                
                                <button type="submit" name="add_category_courses" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
