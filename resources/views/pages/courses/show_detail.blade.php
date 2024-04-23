@extends('welcome')
@section('content')

@foreach($detail_coursesE as $key => $detail_courses)
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="{{URL::to('/public/upload/courses/'.$detail_courses->coursesE_image)}}" alt="">
                </div>

                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">Chi tiết khoá học</span></p>
                    <h1 class="mb-4">{{$detail_courses->coursesE_title}}</h1>

                    <div class="row border-bottom">
                        <div class="col-67 py-1 text-right border-right"><strong>Nội dung</strong></div>
                        <div class="col-68 py-1">{!!$detail_courses->coursesE_content!!}</div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-67 py-1 text-right border-right"><strong>Số lượng</strong></div>
                        <div class="col-68 py-1">{{$detail_courses->coursesE_seats}} chỗ ngồi</div>
                    </div>

{{--                     <div class="row border-bottom">
                        <div class="col-67 py-1 text-right border-right"><strong>Giờ học</strong></div>
                        <div class="col-68 py-1">{{$detail_courses->coursesE_starttime}} - {{$detail_courses->coursesE_endtime}}</div>
                    </div> --}}

                    <div class="row border-bottom">
                        <div class="col-67 py-1 text-right border-right"><strong>Số buổi học</strong></div>
                        <div class="col-68 py-1">{{$detail_courses->coursesE_number}} Buổi</div>
                    </div>

                    <div class="row border-bottom">
                        <div class="col-67 py-1 text-right border-right"><strong>Học phí</strong></div>
                        <div class="col-68 py-1">{{number_format($detail_courses->coursesE_tuition)}} VND</div>
                    </div>

{{--                     <div class="row">
                        <div class="col-67 py-1 text-right border-right"><strong>Ngày học</strong></div>
                        <div class="col-68 py-1">Từ {!!$detail_courses->coursesE_startday!!} đến ngày {{$detail_courses->coursesE_endday}}</div>
                    </div> --}}

                    <form action="{{URL::to('/show-cart')}}"s>
                        {{csrf_field()}}
                        <input type="hidden" name="coursesid_hidden" value="{{$detail_courses->coursesE_id}}">
                        <button hre type="submit" class="btn btn-primary mt-2 py-2 px-4">Đăng ký</button>
                   </form>

                
                            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Lớp học</span></p>
            </div>

                <div class="table-responsive cart_info">
                            
                <table class="table table-condensed">
                    <thead>
                        <tr class="">
                            <td>Tên lớp học</td>
                            <td>Giáo viên dạy</td>
                            <td>Thời gian học</td>
                        </tr>
                    </thead>
                    @foreach($class_name as $key => $value)
                        <tr>
                            <td>{{$value->class_name}}</td>
                            <td>{{$value->teacher_name}}</td>
                            <td>{{$value->class_desc}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
                </div>
                <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0" nonce="B67EtJEF"></script>

<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-order-by="reverse_time " data-width="100%" data-numposts="5"></div>
          
            </div>
        </div>
    </div>

@endforeach


        <div class="container-fluid py-5">
        <div class="container p-0">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Khoá học liên quan</span></p>
            </div>
           
            
            <div class="owl-carousel testimonial-carousel">             

@foreach($related_coursesE as $key => $lienquan)

                <div class="testimonial-item px-3">
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <a href="{{URL::to('chitiet_khoahoc/'.$lienquan->coursesE_slug)}}">
                        <img class="card-img-top mb-2" src="{{URL::to('public/upload/courses/'.$lienquan->coursesE_image)}}" alt="">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{$lienquan->coursesE_title}}</h4>
                            <p class="card-text">{!!$lienquan->coursesE_content!!}</p>
                        </div>
                    </a>
                        <div class="card-footer bg-transparent py-4 px-5">
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Loại</strong></div>
                                <div class="col-66 py-1">{{$lienquan->category_name}}</div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Số lượng</strong></div>
                                <div class="col-66 py-1">{{$lienquan->coursesE_seats}} chỗ ngồi</div>
                            </div>
{{--                             <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Giờ học</strong></div>
                                <div class="col-66 py-1">{{$lienquan->coursesE_starttime}} - {{$lienquan->coursesE_endtime}}</div>
                            </div> --}}
                            <div class="row">
                                <div class="col-6 py-1 text-right border-right"><strong>Học phí</strong></div>
                                <div class="col-66 py-1">{{number_format($lienquan->coursesE_tuition)}} VND</div>
                            </div>
                        </div>
                        <a href="{{URL::to('chitiet_khoahoc/'.$lienquan->coursesE_slug)}}" class="btn btn-primary px-4 mx-auto mb-4">Đăng ký</a>
                    </div>
                </div>
                
@endforeach
            </div>


        </div>
    </div>

@endsection