@extends('admin_layout')
@section('admin_content')
<head>

    <style type="text/css">
        table, th, td{
            border:1px solid #868585;
        }
        table{
            border-collapse:collapse;
            width:100%;
        }
        th, td{
            text-align:center;
            padding:10px;
        }
        table tr:nth-child(odd){
            background-color:#eee;
        }
        table tr:nth-child(even){
            background-color:white;
        }
        table tr:nth-child(1){
            background-color:skyblue;
        }
    </style>
</head>
<body>
    <table>
    	<h1 style="text-align: center;">Thống kê</h1><br>
        <tr>
            <th>Giáo viên</th>
            <th>Học sinh</th>
            <th>Khoá học</th>
            <th>Lớp học</th>
            <th>Học sinh đã đăng ký</th>
            <th>Yêu cầu tư vấn</th>
        </tr>
        <tr>
            <td>{{$teacher}}</td>
            <td>{{$student}}</td>
            <td>{{$courses}}</td>
            <td>{{$class}}</td>
            <td>{{$all_student}}</td>
            <td>{{$advise}}</td>
        </tr>
    </table><br><br>

        <table>
    	<h1 style="text-align: center;">Thống kê lợi nhuận</h1><br>
        <tr>
            <th>Thu</th>
            <th>Chi</th>
            <th>Lợi nhuận</th>

        </tr>
        <tr>
            <td>{{number_format($nap)}} VND</td>
            <td>{{number_format($all_chi)}} VND</td>
            <td>{{number_format($total)}} VND</td>
        </tr>
    </table>
</body>
@endsection
