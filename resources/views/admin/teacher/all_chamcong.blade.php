@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách
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
        <form action="{{URL::to('/search-teacher')}}" method="POST">
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
            <th>Tiền hỗ trợ</th>
            <th>Số công</th>
            <th>Đơn giá</th>
            <th>Lương</th>
            <th>Trả lương</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($chamcong as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->teacher_name}}</td>
            <td>{{number_format($cate_pro->teacher_salary)}} VND</td>
            <td>{{$cate_pro->teacher_number}} Ca</td>
            <td>{{number_format($cate_pro->teacher_price)}} VND</td>
            <td>{{number_format($cate_pro->teacher_salary + $cate_pro->teacher_number * $cate_pro->teacher_price)}} VND</td>

            
            <td>
              <a href="{{URL::to('/add-chigiaovien/'.$cate_pro->chamcong_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </td>            
          </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
  </div>
</div>
@endsection
