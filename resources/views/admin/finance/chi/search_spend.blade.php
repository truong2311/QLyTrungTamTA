@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khoản chi
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-spend')}}" method="POST">
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
            <th>Tên khoản thu</th>
            <th>Nội dung</th>
            <th>Ngày thu</th>
            <th>Số tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($search_spend as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->spend_name}}</td>
            <td>{{$cate_pro->spend_content}}</td>
            <td>{{$cate_pro->spend_date}}</td>
            <td>{{number_format($cate_pro->spend_money)}} VND</td>
            <td>
              <a href="{{URL::to('/edit-spend/'.$cate_pro->spend_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn chắc muốn xoá học sinh này?')" href="{{URL::to('/delete-spend/'.$cate_pro->spend_id)}}" class="active styling-edit" ui-toggle-class="">
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
