@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách chi giáo viên
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
            <th>Lương</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @php
              $total =0;
            @endphp
          @foreach($all as $key => $cate_pro)
              @php

              $total += intval(str_replace(',', '', $cate_pro->teacher_salary));
              @endphp
          <tr>
            <td>{{$cate_pro->teacher_name}}</td>
            <td>{{$cate_pro->teacher_salary}} VND</td>        
          </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="text-right">                
            {!!$all->links('pagination::bootstrap-4')!!}
        </div>
      </div>
    </footer>

   
    <tr>
      <td>Tổng: {{number_format($total)}} VND</td>
    </tr>

  </div>
</div>

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khoản chi khác
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
          @php
              $total1 =0;
            @endphp
          @foreach($all_spend as $key => $cate_pro)

              @php

              $total1 += intval(str_replace(',', '', $cate_pro->spend_money));
              @endphp
          <tr>
            <td>{{$cate_pro->spend_name}}</td>
            <td>{{$cate_pro->spend_content}}</td>
            <td>{{$cate_pro->spend_date}}</td>
            <td>{{number_format($cate_pro->spend_money)}} VND</td>
            <td>
              <a href="{{URL::to('/edit-spend/'.$cate_pro->spend_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn chắc muốn xoá khoản chi này?')" href="{{URL::to('/delete-spend/'.$cate_pro->spend_id)}}" class="active styling-edit" ui-toggle-class="">
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
    <tr>
      <td>Tổng: {{number_format($total1)}} VND</td>
    </tr>
  </div>
</div>
@endsection
