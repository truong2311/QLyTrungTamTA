<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LieLie</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{asset('public/frontend/image/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="{{asset('public/frontend/lib/flaticon/font/flaticon.css')}}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('public/frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="{{URL::to('trang-chu')}}" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary">LieLie</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="{{URL::to('/trang-chu')}}" class="nav-item nav-link active">Trang chủ</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Tin tức</a>
                        <div class="dropdown-menu rounded-0 m-0">

                            @foreach($cate_new as $key => $cate_new)
                            <a href="{{URL::to('/danhmuc_tintuc/'.$cate_new->cate_new_slug)}}" class="dropdown-item">{{$cate_new->cate_new_name}}</a>

                            @endforeach
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Giới thiệu</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="{{URL::to('aboutus')}}" class="dropdown-item">Về chúng tôi</a>
                            <a href="{{URL::to('learn')}}" class="dropdown-item">Phương pháp học</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Các khoá học</a>
                        <div class="dropdown-menu rounded-0 m-0">

                            @foreach($category as $key => $cate)
                            <a href="{{URL::to('/danhmuc_khoahoc/'.$cate->category_slug)}}" class="dropdown-item">{{$cate->category_name}}</a>

                            @endforeach
                        </div>
                    </div>
                    <a href="{{URL::to('giao-vien')}}" class="nav-item nav-link">Giáo viên</a>

                    <a href="{{URL::to('contact')}}" class="nav-item nav-link">Liên hệ</a>

                    <a href="{{URL::to('dang-ky')}}" class="nav-item nav-link">Đăng ký</a>


                </div>

                <div class="nav-item dropdown">
                        <a href="#" class="btn btn-primary px-4" data-toggle="dropdown">
                            Tài khoản: @if(Auth::user()) {{Auth::user()->name}} @endif</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            @if(!Auth::user())
                                <a href="{{ url::to('auth/google') }}" class="dropdown-item">Đăng nhập</a>
                            @else
                                <a href="{{URL::to('logoutHome')}}" class="dropdown-item">Đăng Xuất</a>
                            @endif
                        </div>
                </div>

                
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    @yield('content')
   


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0" style="font-size: 40px; line-height: 40px;">
                    
                    <span class="text-white">LieLie</span>
                </a>
                <p>Kiến thức chắt lọc, tập trung học những gì học viên cần, không học tất cả những gì tiếng Anh có.</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Liên hệ</h3>
                <div class="d-flex">
                    <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Địa chỉ</h5>
                        <p>Trung tâm tiếng anh LieLie, Xã Quỳnh Diễn, huyện Quỳnh Lưu, tỉnh Nghệ An</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"
                    ></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>lieliequynhdien@gmail.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Số điện thoại</h5>
                        <p>+012 345 67890</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Liên kết</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="{{URL::to('/trang-chu')}}"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                    <a class="text-white mb-2" href="{{URL::to('aboutus')}}"><i class="fa fa-angle-right mr-2"></i>Giới thiệu</a>
                    <a class="text-white mb-2" href="{{URL::to('giao-vien')}}"><i class="fa fa-angle-right mr-2"></i>Giáo viên</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h3 class="text-primary mb-4">Tư vấn</h3>
                 <?php
                             $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                            ?>
                            <form action="{{URL::to('/save-advise')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="advise_name" class="form-control border-0 p-4" placeholder="Họ tên" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="text" name="advise_phone" class="form-control border-0 p-4" placeholder="Số điện thoại" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" name="advise_email" class="form-control border-0 p-4" placeholder="Địa chỉ email" required="required" />
                                </div>
                                <div class="form-group">
                                    <select name="category_id" class="custom-select border-0 px-4" style="height: 47px;">
                                        @foreach($category as $key =>$category2)
                                        <option value="{{$category2->category_id}}">{{$category2->category_name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-block border-0 py-3" type="submit">Gửi</button>
                                </div>
                            </form>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('public/frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('public/frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/frontend/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('public/frontend/lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('public/frontend/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('public/frontend/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('public/frontend/js/main.js')}}"></script>

    {{-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="DAshv45n"></script> --}}
</body>

</html>