@extends('welcome')
@section('content')
 <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
        <div class="row align-items-center px-3">
            <div class="col-lg-6 text-center text-lg-left">
                <h4 class="text-white mb-4 mt-5 mt-lg-0">Trung tâm Anh ngữ LieLie</h4>
                <h1 class="display-3 font-weight-bold text-white">Phương pháp dạy học mới phù hợp</h1>
                <p class="text-white mb-4">Tính chắt lọc kiến thức thể hiện ở 4 điểm nổi bật: Học những gì học viên cần, không học tất cả những gì tiếng Anh có + Khoá đào tạo tinh gọn, lộ trình cá nhân hóa cho từng học viên + Công cụ giảng dạy Slide hiện đại, giáo trình chuyên sâu, thiết kế riêng biệt theo level + Giảng viên chuyên môn giỏi, truyền thụ kiến thức dễ hiểu, dễ nhớ.</p></div>
            <div class="col-lg-6 text-center text-lg-right">
                <img class="img-fluid mt-5" src="public/frontend/image/about-1.jpg" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
{{--     <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="public/frontend/image/about-1.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">Learn About Us</span></p>
                    <h1 class="mb-4">Best School For Your Kids</h1>
                    <p>Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                        ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
                        dolor</p>
                    <div class="row pt-2 pb-4">
                        <div class="col-6 col-md-4">
                            <img class="img-fluid rounded" src="public/frontend/image/about-2.jpg" alt="">
                        </div>
                        <div class="col-6 col-md-8">
                            <ul class="list-inline m-0">
                                <li class="py-2 border-top border-bottom"><i class="fa fa-check text-primary mr-3"></i>Labore eos amet dolor amet diam</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check text-primary mr-3"></i>Etsea et sit dolor amet ipsum</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check text-primary mr-3"></i>Diam dolor diam elitripsum vero.</li>
                            </ul>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary mt-2 py-2 px-4">Learn More</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- About End -->


    <!-- Class Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Khoá học nổi bật</span></p>
                <h1 class="mb-4">Lớp học</h1>
            </div>
            
            <div class="row">
                @foreach($all_coursesE as $key => $courses )
                <div class="col-lg-4 mb-5">
                    <a href="{{URL::to('chitiet_khoahoc/'.$courses->coursesE_slug)}}">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <img class="card-img-top mb-2" src="{{URL::to('public/upload/courses/'.$courses->coursesE_image)}}" alt="">
                        <div class="card-body text-center">
                            <h4 class="card-title">{!!$courses->coursesE_title!!}</h4>
                            <p class="card-text">{!!$courses->coursesE_content!!}</p>
                        </div>
                    </a>
                        <div class="card-footer bg-transparent py-4 px-5">
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Loại</strong></div>
                                <div class="col-66 py-1">{{$courses->category_name}}</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Số lượng</strong></div>
                                <div class="col-66 py-1">{{$courses->coursesE_seats}} chỗ ngồi</div>
                            </div>
                            <div class="row">
                                <div class="col-6 py-1 text-right border-right"><strong>Học phí</strong></div>
                                <div class="col-66 py-1">{{number_format($courses->coursesE_tuition)}} VND</div>
                            </div>
                        </div>
                        <a href="{{URL::to('chitiet_khoahoc/'.$courses->coursesE_slug)}}" class="btn btn-primary px-4 mx-auto mb-4">Đăng ký</a>
                    </div>
                  
                </div>  
                @endforeach      
            </div>
             
        </div>
    </div>
    <!-- Class End -->


    <!-- Registration Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <p class="section-title pr-5"><span class="pr-2">Tư vấn</span></p>
                    <h1 class="mb-4">Tư vấn khoá học</h1>
                    <p></p>
                    <ul class="list-inline m-0">
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Khoá học phù hợp.</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Phản hồi nhanh.</li>
                        <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Giáo viên chất lượng.</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-header bg-secondary text-center p-4">
                            <h1 class="text-white m-0">Tư vấn</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-primary p-5">
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
                                    <button class="btn btn-secondary btn-block border-0 py-3" type="submit">Gửi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->


    <!-- Team Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Giáo viên tại trung tâm</span></p>
                <h1 class="mb-4">Một số giáo viên</h1>
            </div>
            <div class="row">
                @foreach($teacher as $key => $teacher )
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluidd w-101" src="{{URL::to('public/upload/teacher/'.$teacher->teacher_image)}}" alt="" >
                    </div>
                    <h4>{{$teacher->teacher_name}}</h4>
                    <i>Tốt nghiệp: {{$teacher->teacher_university}}</i> <br>
                    <i>Chứng chỉ: {{$teacher->teacher_certificate}}</i>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Team End -->


{{--     <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container p-0">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Nhận xét</span></p>
                <h1 class="mb-4">Nhận xét của phụ huynh</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="public/frontend/image/testimonial-1.jpg" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Parent Name</h5>
                            <i>Profession</i>
                        </div>
                    </div>
                </div> --}}
{{--                 <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="public/frontend/image/testimonial-2.jpg" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Parent Name</h5>
                            <i>Profession</i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="public/frontend/image/testimonial-3.jpg" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Parent Name</h5>
                            <i>Profession</i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="public/frontend/image/testimonial-4.jpg" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Parent Name</h5>
                            <i>Profession</i>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

@endsection