@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách đăng ký online
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        {{csrf_field()}}
        <select class="input-sm form-control w-sm inline v-middle" name="sort" id="sort">
          <option value="{{Request::url()}}?sort_by=all">Hiển thị tất cả</option>
          <option value="{{Request::url()}}?sort_by=roi">Học sinh đã duyệt</option>
          <option value="{{Request::url()}}?sort_by=chua">Học sinh chưa duyệt</option>
          <option value="{{Request::url()}}?sort_by=az">Tên từ A đến Z</option>
          <option value="{{Request::url()}}?sort_by=za">Tên từ Z đến A</option>
        </select>
      </div>
      <div class="col-sm-4">
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
          @foreach($all_online as $key => $cate_pro)
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
<footer class="panel-footer">
      <div class="row">
        <div class="text-right">                
            {!!$all_online->links('pagination::bootstrap-4')!!}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
