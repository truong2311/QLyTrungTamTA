{{-- @extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khoản thu
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        {{csrf_field()}}
        <select class="input-sm form-control w-sm inline v-middle" name="sort" id="sort">
          <option value="{{Request::url()}}?sort_by=all">Hiển thị tất cả</option>
          <option value="{{Request::url()}}?sort_by=az">Ngày tăng</option>
          <option value="{{Request::url()}}?sort_by=za">Ngày giảm</option>
          <option value="{{Request::url()}}?sort_by=az">Tên khoản thu từ A đến Z</option>
          <option value="{{Request::url()}}?sort_by=za">Tên khoản thu từ Z đến A</option>
        </select>            
      </div>
      <div class="col-sm-4">
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
            <th>Tên khoản chi</th>
            <th>Nội dung</th>
            <th>Ngày chi</th>
            <th>Số tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_spend as $key => $cate_pro)
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
<footer class="panel-footer">
      <div class="row">
        <div class="text-right">                
            {!!$all_spend->links('pagination::bootstrap-4')!!}
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection
 --}}