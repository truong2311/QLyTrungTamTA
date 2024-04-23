@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách lớp học
    </div>
    <div class="row w3-res-tb">

      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-online')}}" method="POST">
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
            <th>Tên học sinh</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Lớp học</th>
            <th>Học phí</th>
            <th>Đã duyệt/Chưa duyệt</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_online as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->online_name}}</td>
            <td>{{$cate_pro->online_phone}}</td>
            <td>{{$cate_pro->online_email}}</td>
            <td>{{$cate_pro->class_name}}</td>
            <td>{{number_format($cate_pro->coursesE_tuition)}} VND</td>
            <td><span class="text-ellipsis">
              <?php
                if($cate_pro->online_status==1){
              ?>
                <a href="{{URL::to('/unactive-online/'.$cate_pro->classonline_id)}}"><span class="fa-toggle-styling fa fa-toggle-off"></sapn></a>
              <?php
                }else{
              ?>
                <a href="{{URL::to('/active-online/'.$cate_pro->classonline_id)}}"><span class="fa-toggle-styling fa fa-toggle-on"></sapn></a>
              <?php
              }
              ?>
            </span></td>

            <td>
              <a onclick=" return confirm('Bạn chắc muốn xoá học sinh này?')" href="{{URL::to('/delete-online/'.$cate_pro->classonline_id)}}" class="active styling-edit" ui-toggle-class="">
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
