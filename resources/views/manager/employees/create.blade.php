@extends("layouts.‏‏_admin_manager")

@section("title", "مترشح للتوظيف جديد")

@section("content")
<form class="w-50" method="POST" action="{{ route('candidates.store') }}">
@csrf

<div class="form-group">
    <label for="employee_name">اسم المترشح</label>
    <input autofocus value="{{ old('employee_name') }}" type="text" class="form-control" id="employee_name" name="employee_name" placeholder=" اسم المترشح">   
</div>

<div class="form-group">
    <label for="employee_identity">رقم الهوية</label>
    <input  value="{{ old('employee_identity') }}" class="form-control" id="employee_identity" name="employee_identity" placeholder="رقم الهوية">
    
</div>

<div class="form-group">
    <label for="mobile">رقم الجوال</label>
    <input type="text" value="{{ old('mobile') }}" class="form-control" id="mobile" name="mobile" placeholder="رقم الجوال">
</div>

<div class="form-group">
    <label for="email">البريد الالكتروني</label>
    <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="البريد الالكتروني">
    
</div>

  <button type="submit" class="btn btn-primary">انشاء</button>
  <a class="btn btn-dark" href="{{ route('candidates.index') }}">الغاء الأمر</a>
</form>
@endsection
