@extends('welcome')
@section('content')

<div class="container-fluid py-5">
        <div class="container">
        	    <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Đăng ký khoá học</span></p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 col-lg-7 mb-5 mb-lg-0">
                    <div class="card border-0">
                        <div class="card-header bg-secondary text-center p-4">
                            <h1 class="text-white m-0">Nhập thông tin</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-primary p-5">
                            <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            <form action="{{URL::to('/save-cart')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="online_name" class="form-control border-0 p-4" placeholder="Họ tên học sinh" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="online_phone" class="form-control border-0 p-4" placeholder="Số điện thoại" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="online_email" class="form-control border-0 p-4" placeholder="Địa chỉ email" required="required" />
                                </div>
                                <div class="form-group">
                                    <select name="class_id" class="custom-select border-0 px-4" style="height: 47px;">
                                        @foreach($class_info as $key =>$class)
                                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                                         @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                	<select name="coursesE_id" class="custom-select border-0 px-4" style="height: 47px;">
                                        @foreach($courses_info as $key =>$courses)
                                        <option value="{{$courses->coursesE_id}}">{{number_format($courses->coursesE_tuition)}} VND</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-secondary btn-block border-0 py-3" type="submit">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 ">
                    <p class="section-title pr-5"><span class="pr-2">Hình thức thanh toán</span></p>
                    <h3 class="mb-4">Thanh toán online</h3>
                    <ul class="list-inline m-0">
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Số tài khoản: 0893849394.</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Ngân hàng: Ngân hàng quân đội (MB bank).</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i> Nội dung chuyển tiền: Họ tên học sinh -- tên khoá học (Ví dụ: Nguyen Trong Truong - hoc nghe noi).</li>
                    </ul>
                    <h3 class="mb-4">Thanh toán trực tiếp</h3>
                    <ul class="list-inline m-0">
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Số điện thoại: 0893849394.</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Địa chỉ: Trung tâm tiếng anh LieLie, Xã Quỳnh Diễn, huyện Quỳnh Lưu, tỉnh Nghệ An</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i> Làm viện từ Thứ 2 đến Thứ 6 (từ 8h đến 11h - 14h đến 18h).</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
{{--             <h3>- Đăng ký theo hình thức chuyển khoản</h3>
				<p>+ Số tài khoản: 0893849394</p><br>
				<p>+ Ngân hàng: Ngân hàng quân đội (MB bank)</p><br>
				<p>+ Nội dung chuyển tiền: họ tên học sinh - tên khoá học (Ví dụ: Nguyen Trong Truong - hoc nghe noi)</p><br>
			
			<h3>- Đăng ký trực tiếp</h3>
				<p>+ Liên hệ số điện thoại: 0893849394</p><br>
				<p>+ Hoặc đến địa chỉ: Trung tâm tiếng anh LieLie, Xã Quỳnh Diễn, huyện Quỳnh Lưu, tỉnh Nghệ An</p><br> --}}

@endsection