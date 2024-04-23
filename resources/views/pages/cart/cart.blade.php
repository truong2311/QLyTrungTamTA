@extends('welcome')
@section('content')

<div class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Khoá học đã đăng ký</span></p>
            </div>
            
            <?php
                             $message = Session::get('message1');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message1', null);
                            }
                            ?>
            <div class="table-responsive cart_info">
                            
                <table class="table table-condensed">
                    <thead>
                        <tr class="">
                            <td>Tên học sinh</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Lớp học</td>
                            <td>Học phí</td>
                            <td>Tình trạng</td>
                            <td>Huỷ</td>
                        </tr>
                    </thead>
                    @foreach($all_online as $key => $cate_pro)
                        <tr>
                            <td>{{$cate_pro->online_name}}</td>
                            <td>{{$cate_pro->online_phone}}</td>
                            <td>{{$cate_pro->online_email}}</td>
                            <td>{{$cate_pro->class_name}}</td>
                            <td>{{number_format($cate_pro->coursesE_tuition)}} VND</td>
                            <td><span class="text-ellipsis">
                            <?php
                                if($cate_pro->online_status==1){
                            ?>
                                Đã xác nhận
                            <?php
                            }else{
                            ?>
                                Chưa xác nhận
                            <?php
                            }
                            ?>
                            </span></td>

                        <td>
                        <a onclick=" return confirm('Bạn chắc muốn xoá học sinh này?')" href="{{URL::to('/delete-show-online/'.$cate_pro->classonline_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection