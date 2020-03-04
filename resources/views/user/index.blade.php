@extends('user.master')
@section('title','homepage')
@section('content')
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <br>
                <div align="center"><h1>ข้อมูลสมาชิก</h1></div>
                <br><br>
                
                <div align="right"><a href = "{{route('user.create')}}" class = " btn btn-success">เพิ่มข้อมูล</a>
                <a href = "{{route('user.search')}}" class = " btn btn-primary">ค้นหาข้อมูล</a>
                </div>
                

                
                
                <br><br>
                @if(\Session::has('success'))
                <div class = "alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p>{{\Session::get('success')}}</p>
                </div>
                @endif
                <table class = "table table-hover">
                <thead>
                <tr>
                <th>อันดับที่</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทร</th>
                <th>อีเมลล์</th>
                <th>ที่อยู่</th>
                <th>จังหวัด</th>
                <th>อำเภอ</th>
                <th>รหัสไปรษณีย์</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
                </tr>
                </thead>
                @foreach($users as $row)
                
                <tr>
                    
                    <td>{{$row['id']}}</td>
                    <td>{{$row['fname']}}</td>
                    <td>{{$row['lname']}}</td>
                    <td>{{$row['tel']}}</td>
                    <td>{{$row['email']}}</td>
                    <td>{{$row['address']}}</td>
                    <td>{{$row['province']}}</td>
                    <td>{{$row['district']}}</td>
                    <td>{{$row['code']}}</td>
                    <td><a href = "{{action('UsersController@edit',$row['id'])}}" class = " btn btn-warning">แก้ไข</a></td>
                    <td>
                     <form method="post" class = "delete_form" action ="{{action('UsersController@destroy',$row['id'])}}">
                     {{csrf_field()}}
                     <input type="hidden" name="_method" value="DELETE"/>
                     <button type = "submit" class = "btn btn-danger">ลบ</button>
                     </form>
                    </td>
                </tr>
             
                @endforeach
                </table>

            </div></div>
                
        </div>
    </div>

    <script type = "text/javascript">
    $(document).ready(function(){ 
        $('.delete_form').on('submit',function(){
        if(confirm("คุณต้องการลบข้อมูลหรือไม่ ?")){
            return true;
        }
        else{
            return false;
        }
    });
    });
    </script>
    
@endsection

