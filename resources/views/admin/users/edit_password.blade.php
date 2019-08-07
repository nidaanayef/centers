@extends("layouts._admin")

@section("title", " تعديل كلمة مرور مدير المركز")

@section("content")
<form class="w-50" method="POST" action="{{ route('edit_password.update', $item->id) }}">
@csrf
@method("put")
  <div class="form-group">
    <label for="name">اسم  مدير المركز</label>
    <input disabled autofocus value="{{ $item->name }}" type="text" class="form-control" id="name" name="name">
    
</div>

                  
<div class="form-group">
    <label for="email"> الايميل</label>
    <input  type="text" class="form-control" id="email" name="email" placeholder=" الايميل ">
    
</div>

<div class="form-group">
    <label for="password">كلمة السر الجديدة</label>
    <input  value="{{ $item->password }}" type="password" class="form-control" id="password" name="password" placeholder=" كلمة السر الجديدة ">
    
</div>




  <button type="submit" class="btn btn-primary">حفظ</button> 
  <a class="btn btn-dark" href="{{ route('users.index') }}">الغاء الأمر</a>
</form>
@endsection