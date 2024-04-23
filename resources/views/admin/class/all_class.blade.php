@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách lớp học
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        {{csrf_field()}}
        <select class="input-sm form-control w-sm inline v-middle" name="sort" id="sort">
          <option value="{{Request::url()}}?sort_by=all">Hiển thị tất cả</option>
          <option value="{{Request::url()}}?sort_by=az">Tên từ A đến Z</option>
          <option value="{{Request::url()}}?sort_by=za">Tên từ Z đến A</option>
        </select>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-class')}}" method="POST">
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
            <th>Tên khoá học</th>
            <th>Tên giáo viên (chính)</th>
            <th>Tên giáo viên (phụ)</th>
            <th>Lịch học</th>
            <th>Ẩn/hiện</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_class as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->class_name}}</td>
            <td>{{$cate_pro->coursesE_title}}</td>
            <td>{{$cate_pro->teacher_name}}</td>
            <td>{{$cate_pro->teacher_name}}</td>
            <td>{{$cate_pro->class_desc}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($cate_pro->class_status==1){
              ?>
                <a href="{{URL::to('/unactive-class/'.$cate_pro->class_id)}}"><span class="fa-toggle-styling fa fa-toggle-off"></sapn></a>
              <?php
                }else{
              ?>
                <a href="{{URL::to('/active-class/'.$cate_pro->class_id)}}"><span class="fa-toggle-styling fa fa-toggle-on"></sapn></a>
              <?php
              }
              ?>
            </span></td>

            <td>
              <a href="{{URL::to('/edit-class/'.$cate_pro->class_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick=" return confirm('Bạn chắc muốn xoá lớp học này?')" href="{{URL::to('/delete-class/'.$cate_pro->class_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
<footer class="panel-footer">
      <div class="row">
        <div class="text-right">                
            {!!$all_class->links('pagination::bootstrap-4')!!}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
