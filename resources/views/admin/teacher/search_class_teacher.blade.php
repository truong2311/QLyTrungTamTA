@extends('teacher_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Lịch học
    </div>
    <div class="row w3-res-tb">

      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-class-teacher')}}" method="POST">
          {{csrf_field()}}
        <div class="input-group">
          <input type="text" class="input-sm form-control" name="keywords_submits" placeholder="Tìm kiếm">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" name="search_items" type="submit">Tìm kiếm</button>
          </span>
        </div>
        </form>

      </div>
    </div>
    <div class="table-responsive">
      <?php
          $message = Session::get('message');
          if($message){
          echo '<span class="text-alert">'.$message.'</span>';
          Session::put('message', null);
          }
      ?>  
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên giáo viên</th>
            <th>Khoá học</th>
            <th>Lớp học</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Giờ học</th>
            <th>Sỹ số</th>
            <th>Số buổi</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_classteacher as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->teacher_name}}</td>
            <td>{{$cate_pro->coursesE_title}}</td>
            <td>{{$cate_pro->class_name}}</td>
            <td>{{$cate_pro->coursesE_startday}}</td>
            <td>{{$cate_pro->coursesE_endday}}</td>
            <td>{{$cate_pro->coursesE_starttime}}</td>
            <td>{{$cate_pro->coursesE_seats}}</td>
            <td>{{$cate_pro->coursesE_number}}</td>
          @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
</div>
@endsection
