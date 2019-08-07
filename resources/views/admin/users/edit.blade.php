@extends("layouts._admin")

@section("title", " تعديل مدير المركز")

@section("content")
<form class="w-50" method="POST" action="{{ route('users.update', $item->id) }}">
@csrf
@method("put")
  <div class="form-group">
    <label for="name">اسم  مدير المركز</label>
    <input autofocus value="{{ $item->name }}" type="text" class="form-control" id="name" name="name">
    
</div>

@if($item->job=='system manager')
                    
@else
                    <div class="form-group">
										<label for="center_id">  اسم المركز </label>
											<select class="form-control" id="center_id" name="center_id">
                        <option value="{{ $item->center_id}}">اختر اسم المركز</option>
                        @foreach($centers as $center)
													<option {{ $item->center_id==$center->id?"selected":"" }} value="{{ $center->id }}">{{ $center->center_name }}</option>
                        @endforeach
											</select>
                  </div>
@endif


                  
<div class="form-group">
    <label for="manager_identity">رقم الهوية  </label>
    <input autofocus value="{{ $item->manager_identity }}" type="text" class="form-control" id="manager_identity" name="manager_identity">
    
</div>

<div class="form-group">
    <label for="mobile">رقم الجوال</label>
    <input autofocus value="{{ $item->mobile }}" type="text" class="form-control" id="mobile" name="mobile">
    
</div>


<div class="form-group">
    <label for="email"> الايميل</label>
    <input autofocus value="{{ $item->email }}" type="text" class="form-control" id="email" name="email" placeholder=" الايميل ">
    
</div>




  <button type="submit" class="btn btn-primary">حفظ</button>
  <a class="btn btn-dark" href="{{ route('users.index') }}">الغاء الأمر</a>
</form>
@endsection
