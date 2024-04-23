@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách khoản thu
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4" style="width: 70%;">
      </div>
      <div class="col-sm-3">
        <form action="{{URL::to('/search-collect')}}" method="POST">
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
            <th>Học phí</th>
            <th>Học sinh</th>
            <th>Giảm giá</th>
            <th>Cần nạp</th>
            <th>Đã nạp</th>
            <th>Còn thiếu</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
              @php
              $total = 0;
              $coursesE_tuition = 0;
              $nap = 0;
            @endphp
          @foreach($search_collect as $key => $cate_pro)

              @php
              $coursesE_tuition = intval(str_replace(',', '', $cate_pro->coursesE_tuition));
              $total += intval(str_replace(',', '', $cate_pro->coursesE_tuition));
              $nap += $cate_pro->collect_moneynap;
              @endphp
          <tr>
            <td>{{$cate_pro->class_name}}</td>
            <td>{{number_format($coursesE_tuition)}} VND</td>
            <td>{{$cate_pro->student_name}}</td>
            {{-- <td>{{$cate_pro->collect_promotion}}</td> --}}
            <td><span class="text-ellipsis">
              <?php
              if ($cate_pro->collect_promotion == 0) {
                echo '0%';

              } elseif ($cate_pro->collect_promotion == 1) {
                echo '10%';

              } elseif ($cate_pro->collect_promotion == 2) {
                echo '15%';

              } else{
                echo '20%';
              }
            ?>
              </span></td> 
            <td><span class="text-ellipsis">
              <?php
              if ($cate_pro->collect_promotion == 0) {
                echo number_format($coursesE_tuition) .' '.'VND';

              } elseif ($cate_pro->collect_promotion == 1) {
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (10 / 100))) .' '.'VND';

              } elseif ($cate_pro->collect_promotion == 2) {
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (15 / 100) )) .' '.'VND';

              } else{
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (20 / 100) )) .' '.'VND';
              }
            ?>
              </span></td> 

            <td>{{number_format($cate_pro->collect_moneynap)}} VND</td>

            <td><span class="text-ellipsis">
              <?php
              if ($cate_pro->collect_promotion == 0) {
                echo number_format($coursesE_tuition - $cate_pro->collect_moneynap) .' '.'VND';

              } elseif ($cate_pro->collect_promotion == 1) {
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (10 / 100)) - $cate_pro->collect_moneynap) .' '.'VND';

              } elseif ($cate_pro->collect_promotion == 2) {
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (15 / 100) ) - $cate_pro->collect_moneynap) .' '.'VND';

              } else{
                echo number_format($coursesE_tuition - ( $coursesE_tuition * (20 / 100) ) - $cate_pro->collect_moneynap) .' '.'VND';
              }
            ?>
              </span></td> 
            
            <td><span class="text-ellipsis">
              <?php
              if ($cate_pro->collect_promotion == 0) {
                if ($coursesE_tuition - $cate_pro->collect_moneynap > 0) {
                  echo 'Nạp thiếu';
                } else {
                  echo "Nạp đủ";
                }
              
              } elseif ($cate_pro->collect_promotion == 1) {
                if ($coursesE_tuition - ( $coursesE_tuition * (10 / 100)) - $cate_pro->collect_moneynap > 0) {
                  echo 'Nạp thiếu';
                } else {
                  echo "Nạp đủ";
                }
                
              } elseif ($cate_pro->collect_promotion == 2) {
                if ($coursesE_tuition - ( $coursesE_tuition * (15 / 100) ) - $cate_pro->collect_moneynap > 0) {
                  echo 'Nạp thiếu';
                } else {
                  echo "Nạp đủ";
                }
                
              } else{
                if ($coursesE_tuition - ( $coursesE_tuition * (20 / 100) ) - $cate_pro->collect_moneynap > 0) {
                  echo 'Nạp thiếu';
                } else {
                  echo "Nạp đủ";
                }
              }
            ?>
              </span></td> 



            <td>
              <a href="{{URL::to('/edit-collect/'.$cate_pro->collect_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
        <tr>
          <td>Tổng: {{number_format($nap)}} VND</td>
    </tr>
  </div>
</div>
@endsection

