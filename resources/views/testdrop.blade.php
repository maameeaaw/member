<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </head>
    <body>
    <div class="container">
    
    <div class="form-group">
            
            <label for="province">เลือกจังหวัด</label>
            <select  id="province" name="province" class="province form-control" >
                <option value="" disabled selected>--เลือกจังหวัด--</option>
                @foreach($prov as $row)
                    <option value = "{{$row->PROVINCE_ID}}">{{$row->PROVINCE_NAME}}</option>
                @endforeach
            </select>

            <label for="district">เลือกอำเภอ</label>
            <select  id="district" name="district" class="district form-control " >
                <option value="" disabled selected>--เลือกอำเภอ--</option>

            </select>

            <div class="form-group">
            <label for="code">รหัสไปรษณีย์</label>
            <input type="text" name="code" class="code form-control " placeholder="--ป้อนรหัสไปรษณีย์--"/>
            </div>
        
        </div>

    </div>
    <script type="text/javascript">
   
        $(document).ready(function(){
            $(document).on('change','.province',function(){
                // console.log("its change"); 
                var pro_id = $(this).val();
                // console.log(id);
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
                           op+='<option value =="'+data[i].DISTRICT_ID+'">'+data[i].
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
                        console.log(data);
                        console.log(data.POSTCODE);
                        a.find('.code').val(data.POSTCODE);

                    },
                    error:function(){
                        console.log('error');
                    }


                });
            });


        });
    </script>
    </body>

    
</html>