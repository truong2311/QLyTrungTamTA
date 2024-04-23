@extends('admin_layout')
@section('admin_content')
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tin tức
                        </header>
                        
                        <div class="panel-body">
                             <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            @foreach($edit_news as $key => $edit_value)                
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-news/'.$edit_value->new_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục tin tức</label>
                                    <select name="cate_new_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_new as $key =>$cate)
                                            @if($cate->cate_new_id==$edit_value->cate_new_id)
                                            <option selected value="{{$cate->cate_new_id}}">{{$cate->cate_new_name}}</option>
                                            @else
                                            <option value="{{$cate->cate_new_id}}">{{$cate->cate_new_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tin tức</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Điền ít nhất 5 ký tự" name="new_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục" value="{{$edit_value->new_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="new_slug" class="form-control" id="convert_slug" placeholder="Slug" value="{{$edit_value->new_slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả tin tức</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="new_desc" id="abc" placeholder="Nội dung khoá học">{{$edit_value->new_desc}} </textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung tin tức</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="new_content" id="ckeditor1" placeholder="Nội dung khoá học">{{$edit_value->new_content}} </textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Meta từ khoá</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="new_meta_desc" id="exampleInputEmail1" placeholder="Nội dung khoá học"> {{$edit_value->new_meta_desc}}</textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Meta nội dung</label>
                                    <textarea style="resize: none" row="5" class="form-control" name="new_meta_keywords" id="exampleInputEmail1" placeholder="Nội dung khoá học">{{$edit_value->new_meta_keywords}} </textarea> 
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="new_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/news/'.$edit_value->new_image)}}" height="50" width="50">
                                </div>
                                
                                <button type="submit" name="category_courses" class="btn btn-info">Cập nhật tin tức</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>
            </div>
@endsection
