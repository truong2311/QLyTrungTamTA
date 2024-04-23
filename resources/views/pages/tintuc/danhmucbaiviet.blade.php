@extends('welcome')
@section('content')
    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Tin tức mới</span></p>
                <h1 class="mb-4">{{$cate_new_name->cate_new_name}}</h1>
            </div>
            <div class="row pb-3">
            	@foreach($new_by_id as $key => $new_by_id )
                
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm mb-2">
                    	
                        <img class="card-img-top mb-2" src="{{URL::to('public/upload/news/'.$new_by_id->new_image)}}" alt="">
                        <div class="card-body bg-light text-center p-4">
                        	<a href="{{URL::to('chitiet_tintuc/'.$new_by_id->new_slug)}}">
                            <h4 class="">{!!$new_by_id->new_title!!}</h4></a>
                            <p>{!!$new_by_id->new_desc!!}</p>
                            <a href="{{URL::to('chitiet_tintuc/'.$new_by_id->new_slug)}}" class="btn btn-primary px-4 mx-auto my-2">Xem tin</a>
                        </div>
                    
                    </div>
                </div>

                @endforeach



            </div>
        </div>
    </div>
    <!-- Blog End -->

@endsection