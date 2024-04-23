@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách tư vấn
    </div>
    <div class="row w3-res-tb">


      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-advise')}}" method="POST">
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
            <th>Họ tên</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Khoá học</th>
            <th>Xác nhận</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_advise as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->advise_name}}</td>
            <td>{{$cate_pro->advise_phone}}</td>
            <td>{{$cate_pro->advise_email}}</td>
            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">
              <?php
                if($cate_pro->advise_status==1){
              ?>
                <a href="{{URL::to('/unactive-advise/'.$cate_pro->advise_id)}}"><span class="fa-toggle-styling fa fa-toggle-off"></sapn></a>
              <?php
                }else{
              ?>
                <a href="{{URL::to('/active-advise/'.$cate_pro->advise_id)}}"><span class="fa-toggle-styling fa fa-toggle-on"></sapn></a>
              <?php
              }
              ?>
            </span></td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>
@endsection
