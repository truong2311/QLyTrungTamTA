@extends('welcome')
@section('content')


    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Giáo viên tại trung tâm</span></p>
            </div>
            <div class="row">
                @foreach($teacher as $key => $teacherr )
                <div class="col-md-6 col-lg-3 text-center team mb-5">
                    <div class="position-relative overflow-hidden mb-4" style="border-radius: 100%;">
                        <img class="img-fluidd w-101" src="{{URL::to('public/upload/teacher/'.$teacherr->teacher_image)}}" alt="" >
                    </div>
                    <h4>{{$teacherr->teacher_name}}</h4>
                    <i>Tốt nghiệp: {{$teacherr->teacher_university}}</i> <br>
                    <i>Chứng chỉ: {{$teacherr->teacher_certificate}}</i> <br>
                    <i>Ngày vào làm: {{$teacherr->teacher_startday}}</i> <br>
                    <i>Địa chỉ: {{$teacherr->teacher_address}}</i> <br>
                    <i>Email: {{$teacherr->teacher_email}}</i>
                </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection