@extends("layouts.‏‏_admin_manager")

@section("title", "تعديل بيانات الحضور")

@section("css")
#hidden_div {
    display: none;
}
@endsection

@section("content")
<form class="w-50" method="POST" action="{{ route('attendance.update', $item->id) }}">
@csrf
@method("put")
  <div class="form-group">
    <label for="employee_name">اسم الموظف</label>
    <input disabled autofocus value="{{ $item->employee->employee_name }}" type="text" class="form-control" id="employee_name" name="employee_name">
    
</div>
               
<div class="form-group">
    <label for="employee_identity">رقم الهوية  </label>
    <input disabled value="{{ $item->employee->employee_identity }}"  class="form-control" id="employee_identity" name="employee_identity">
    
</div>

<div class="form-group">
  <label for="date">التاريخ</label>
  <input type="date"  value="{{ $item->date }}" class="form-control" id="date" name="date">   
</div>

<div class="form-group">
    <label for="attend_status">حالة الحضور</label>
    <select class="form-control" id="attend_status" name="attend_status" onchange="showDiv('hidden_div', this)">
        <option value="">اختر حالة الحضور</option>
        <option  value="1">حاضر</option>
        <option  value="2">غائب</option>
        <option  value="3">متأخر</option>
    </select>
</div>

<div id="hidden_div">
<div class="form-group">
  <label for="delay_hour">ساعات التأخر</label>
  <input value="{{ old('delay_hour') }}" class="form-control" id="delay_hour" name="delay_hour" placeholder=" ساعات التأخر">
</div>

<div class="form-group">
  <label for="delay_minute">دقائق التأخر</label>
  <input value="{{ old('delay_minute') }}" class="form-control" id="delay_minute" name="delay_minute" placeholder=" دقائق التأخر">
</div>
</div>




  <button type="submit" class="btn btn-primary">حفظ</button>
  <a class="btn btn-dark" href="{{ route('attendance.index') }}">الغاء الأمر</a>
</form>
@endsection
@section("js")
<!--begin::Page Scripts -->

<script>
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 3 ? 'block' : 'none';
}
</script>
<script>
$('.date').pickadate();
</script>
@endsection
