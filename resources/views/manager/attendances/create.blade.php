@extends("layouts.‏‏_admin_manager")

@section("title", "ادخال بيانات الحضور")

@section("content")

<form name="show_form"  id="show_form"  method="POST" action="{{ route('attendance.attendShow') }}">
    @csrf
    <div class="row"> 
        <div class="form-group col-3">
          <label for="date">التاريخ</label>
          <input type="date"  value="{{ old('date') }}" class="form-control" name="date" placeholder="">  
        
        </div>
        <div class=" col-2">
            <button type="submit" name="show_btn" class="btn btn-primary">عرض</button>
        </div>  
    
</form>



<form  name="attendance_form" id="attendance_form" method="POST" action="{{ route('attendance.store') }}">
@csrf


    <div class=" col-10">
    </div>
    <div class=" col-2">
        <button type="submit" name="add_btn" id="add_btn" style= "float:left" class="btn btn-success">اضافة</button>
    </div>      
</div>

@if($items->count()>0)
        <div class=" row alert alert-info mt-3">يوجد {{ $items->count() }} نتائج لعملية البحث</div>
        
        <input type="hidden" name="date"  value=""> 
         
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>حالة الحضور </th>
                    <th>وقت التأخر</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <input type="hidden" name="employee_id[]" id="employee_id" value="{{$item->id}}"> 
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td> 
                        <select class="form-control attend_status" id="attend_status" name="attend_status[]">
                            <option value="">اختر حالة الحضور</option>
                            <option  value="1">حاضر</option>
                            <option  value="2">غائب</option>
                            <option  value="3">متأخر</option>
                        </select>
                    </td>
                    <td>
                       <select class="form-control delay_hour"  style="display:none;" id="delay_hour" name="delay_hour[]">
                            <option value="">اختر ساعات التأخر</option>
                          @for($i=1;$i<=8;$i++)
                             <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                    </td>
                   <td>
                       <select class="form-control delay_minute" style="display:none;" id="delay_minute" name="delay_minute[]">
                            <option value="">اختر دقائق التأخر</option>
                          @for($i=1;$i<=60;$i++)
                             <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                   </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
</form>
    @else
        <div class="alert alert-warning mt-2">
            نأسف لا يوجد نتائج لعرضها  :(
        </div>
    @endif
    
@endsection

@section("js")
<script>

$(document).ready(function(){
    
    $('.attend_status').on('change', function() {
        
        if ( $(this).val() == '3'){
              
            $(this).parent().siblings().find(".delay_hour").show();
            $(this).parent().siblings().find(".delay_minute").show();
        }else{
            $(this).parent().siblings().find(".delay_hour").hide();
            $(this).parent().siblings().find(".delay_minute").hide();
        }
    });
    
    $(document).on("click", "#add_btn", function(e){
        e.preventDefault();
        var date = $("#show_form input[name='date'] ").val();
        $("input:hidden[name='date'] ").val(date);
        
        var empty = 0;
        var count = 0;
        $(".attend_status").each(function(){
            count++;
           if ($(this).val() == "") {
               empty++;
           } 
        });
        
        if( ( empty == 0 ) || ( empty< count ) ){
            
             $("#attendance_form").submit();
        }else{
            console.log("empty");
            $(".alert .alert-danger ul").append("<li> حالة الحضور مطلوبة </li>");
            $(".alert .alert-danger").show();
        }
        
      //  console.log(date);
      //  console.log( $("input:hidden[name='date']").val() );
        
        
    });
});

</script>



<script>
$('.date').pickadate();
</script>


@endsection
