@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chi
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
                                <form role="form" action="{{URL::to('/save-spend')}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khoản chi</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="spend_name" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung</label>
                                    <textarea style="resize: none" row="5" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" class="form-control" name="spend_content" id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền kiểu số" name="spend_money" class="form-control tuition" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày chi</label>
                                    <input type="date" name="spend_date" class="form-control" id="exampleInputEmail1" placeholder="Ngày sinh">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" row="5" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" class="form-control" name="spend_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"> </textarea> 
                                </div>
                                
                                <button type="submit" name="add_category_courses" class="btn btn-info">Thêm</button>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection
