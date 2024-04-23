@extends('welcome')
@section('content')

    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Khoá học</span></p>

                {{-- @foreach($category_name as $key => $categoryy) --}}
                <h1 class="mb-4">{{$category_name->category_name}}</h1>
                {{-- @endforeach --}}

            </div>
            
            <div class="row">
                @foreach($category_by_id as $key => $courses )
                
                <div class="col-lg-4 mb-5">
                    
                    <div class="card border-0 bg-light shadow-sm pb-2">
                        <a href="{{URL::to('chitiet_khoahoc/'.$courses->coursesE_slug)}}">
                        <img class="card-img-top mb-2" src="{{URL::to('public/upload/courses/'.$courses->coursesE_image)}}" alt="">
                        <div class="card-body text-center">

                            <h4 class="card-title">{{$courses->coursesE_title}}</h4>
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
{{--                             <div class="row border-bottom">
                                <div class="col-6 py-1 text-right border-right"><strong>Giờ học</strong></div>
                                <div class="col-66 py-1">{{$courses->coursesE_starttime}} - {{$courses->coursesE_endtime}}</div>
                            </div> --}}
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

@endsection