@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách học sinh lớp
    </div>
    <div class="row w3-res-tb">

      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-student-class')}}" method="POST">
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
            <th>Tên lớp học</th>
            <th>Tên học sinh</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_class as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->class_name}}</td>
            <td>{{$cate_pro->student_name}}</td>

            <td>
              <a onclick=" return confirm('Bạn chắc muốn xoá lớp học này?')" href="{{URL::to('/delete-student-class/'.$cate_pro->student_class_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
