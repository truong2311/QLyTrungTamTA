@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục tin tức
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_category_new as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-cate-new/'.$edit_value->cate_new_id)}}" method="post">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" value="{{$edit_value->cate_new_name}}" name="cate_new_name" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->cate_new_slug}}" name="cate_new_slug"  class="form-control" id="convert_slug" placeholder="Slug">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="cate_new_desc" id="exampleInputPassword1">{{$edit_value->cate_new_desc}}</textarea> 
                                </div>
                                
                                <button type="submit" name="update_cate_new" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
