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
                <h3>Đăng nhập gmail đã đăng ký khoá hoc để xem thông tin</h3>            
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
                </table>

            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection