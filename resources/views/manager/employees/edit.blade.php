@extends("layouts.‏‏_admin_manager")

@section("title", "تعديل بيانات المترشح")

@section("content")
<form class="w-50" method="POST" action="{{ route('candidates.update', $item->id) }}">
@csrf
@method("put")
  <div class="form-group">
    <label for="employee_name">اسم المترشح</label>
    <input autofocus value="{{ $item->employee_name }}" type="text" class="form-control" id="employee_name" name="employee_name">
    
</div>
               
<div class="form-group">
    <label for="employee_identity">رقم الهوية  </label>
    <input  value="{{ $item->employee_identity }}"  class="form-control" id="employee_identity" name="employee_identity">
    
</div>

<div class="form-group">
    <label for="mobile">رقم الجوال</label>
    <input  value="{{ $item->mobile }}" type="text" class="form-control" id="mobile" name="mobile">  
</div>


<div class="form-group">
    <label for="email"> الايميل</label>
    <input  value="{{ $item->email }}" type="text" class="form-control" id="email" name="email">   
</div>




  <button type="submit" class="btn btn-primary">حفظ</button>
  <a class="btn btn-dark" href="{{ route('candidates.index') }}">الغاء الأمر</a>
</form>
@endsection
