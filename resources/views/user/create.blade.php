@extends('user.master')
@section('title','จัดการฐานข้อมูล')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12"><br />
        <h3 align="center">เพิ่มสมาชิก</h3><br />
        @if(count($errors)>0)
            <div class = "alert alert-danger">
            <ul> @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
            </div>
            @endif
            @if(\Session::has('success'))
            <div class = "alert alert-success">
            <p>{{\Session::get('success')}}</p>
            </div>
            @endif

        <form method="post" action ="{{url('user')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">ชื่อ</label>
                <input type="text" name="fname" class="form-control" placeholder="ป้อนชื่อ"/>
            </div>
            
            <div class="form-group">
                <label for="lastname">นามสกุล</label>
                <input type="text" name="lname" class="form-control" placeholder="ป้อนนามสกุล"/>
            </div>

            <div class="form-group">
                <label for="tel">เบอร์โทร</label>
                <input type="text" name="tel" class="form-control" placeholder="ป้อนเบอร์โทร"/>
            </div>

            <div class="form-group">
                <label for="email">อีเมลล์</label>
                <input type="text" name="email" class="form-control" placeholder="ป้อนอีเมลล์"/>
            </div>

            <div class="form-group">
                <label for="address">ที่อยู่</label>
                <input type="text" name="address" class="form-control" placeholder="ป้อนที่อยู่"/>
            </div>

            <label for="province">เลือกจังหวัด</label>
            <select  id="province" name="province" class="province form-control" >
                <option value="" disabled selected>--เลือกจังหวัด--</option>
                @foreach($prov as $row)
                    <option value = "{{$row->PROVINCE_NAME}}">{{$row->PROVINCE_NAME}}</option>
                    <!-- <option value = "{{$row->PROVINCE_ID}}">{{$row->PROVINCE_NAME}}</option> -->
                @endforeach
            </select>

            <label for="district">เลือกอำเภอ</label>
            <select  id="district" name="district" class="district form-control " >
                <option value="" disabled selected>--เลือกอำเภอ--</option>

            </select>

            <div class="form-group">
                <label for="code">รหัสไปรษณีย์</label>
                <input type="text" name="code" class="code form-control" placeholder="ป้อนรหัสไปรษณีย์"/>
            </div>


            <div class="container">
            <div class="row">
                <div class="col-md-auto">
                <a href = "{{route('user.index')}}" class = " btn btn-danger">ยกเลิก</a>
                </div>
                <div class="col-md-auto">
                <input type="submit" class="btn btn-primary" value="บันทึก"/>
                </div>
            </div>
            </div>
            <br><br>
            
            
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
   
   $(document).ready(function(){
       $(document).on('change','.province',function(){
           // console.log("its change"); 
           var pro_id = $(this).val();
           console.log(pro_id);
           var div = $(this).parent();
           var op = "";
           $.ajax({
               type:'get',
               url:'{!!URL::to('findDistrictName')!!}',
               data:{'id':pro_id},
               success:function(data){
                   // console.log('success');
                   // console.log(data);
                   op+='<option value="" disabled selected>--เลือกอำเภอ--</option>';
                  for(var i=0 ;i<data.length;i++){
                      op+='<option value ="'+data[i].DISTRICT_NAME+'">'+data[i].
                      DISTRICT_NAME+'</option>';
                  }
                  div.find('.district').html(" ");
                  div.find('.district').append(op);
               },
               error:function(){
                   console.log('error');
               }


           });
       });

       $(document).on('change','.district',function(){
                // console.log("its change"); 
                var id = $(this).val();
                //  console.log(id);
                var a = $(this).parent();
                var op = "";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findcode')!!}',
                    data:{'id':id},
                    dataType:'json',
                    success:function(data){
                        // console.log('success');
                        // console.log(data);
                        // console.log(data.POSTCODE);
                        a.find('.code').val(data.POSTCODE);

                    },
                    error:function(){
                        console.log('error');
                    }


                });
            });

   });
</script>
@stop