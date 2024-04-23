@extends('welcome')
@section('content')

    <!-- Detail Start -->
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-lg-8">
                @foreach($details_news as $key => $details_news)
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title pr-5"><span class="pr-2">Chi tiết tin tức</span></p>
                    <h1 class="mb-3">{{$details_news->new_title}}</h1>
                </div>
                <div class="mb-5" style="width: 1140px ">
                    {!!$details_news->new_content!!}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Detail End -->

    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Tin tức liên quan</span></p>
            </div>
            <div class="row pb-3">
                @foreach($related_new as $key => $related )

                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                        <img class="card-img-top mb-2" src="{{URL::to('public/upload/news/'.$related->new_image)}}" alt="">
                        <div class="card-body bg-light text-center p-4">
                            <a href="{{URL::to('chitiet_tintuc/'.$related->new_slug)}}">
                            <h4 class="">{!!$related->new_title!!}</h4></a>
                            <p>{!!$related->new_desc!!}</p>
                            <a href="{{URL::to('chitiet_tintuc/'.$related->new_slug)}}" class="btn btn-primary px-4 mx-auto my-2">Xem tin tức</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection