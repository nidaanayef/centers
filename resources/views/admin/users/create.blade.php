@extends("layouts._admin")

@section("title", "مدير مركز جديد")

@section("content")
<form class="w-50" method="POST" action="{{ route('users.store') }}">
@csrf
  <div class="form-group">
    <label for="name">اسم مدير المركز</label>
    <input autofocus value="{{ old('name') }}" type="text" class="form-control" id="name" name="name" placeholder=" اسم مدير المركز">
    
</div>
 <div class="form-group">
										<label for="center_id"> اسم المركز</label>
											<select class="form-control"  id="center_id" name="center_id">
												<option value="">اختار اسم المركز</option>
                        @foreach($centers as $center)
													<option {{ old("center_id")==$center->id?"selected":"" }} value="{{ $center->id }}">{{ $center->center_name }}</option>
                        @endforeach
											</select>
                  </div>


<div class="form-group ">
												<label class=" col-form-label">رقم الهوية</label>
										
													<div class="m-input-icon m-input-icon--right">
														<input value="{{ old('manager_identity') }}" id="manager_identity" class="form-control"  name="manager_identity" type="text" class="form-control m-input" placeholder=" رقم الهوية">
										
													</div>
										
												</div>

                        <div class="form-group">
    <label for="mobile">رقم الجوال</label>
    <input type="mobile" value="{{ old('mobile') }}" class="form-control" id="mobile" name="mobile" placeholder="رقم الجوال">
    
</div>

<div class="form-group">
    <label for="email">البريد الالكتروني</label>
    <input autofocus type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="البريد الالكتروني">
    
</div>
<div class="form-group">
    <label for="password">كلمة المرور</label>
    <input autofocus type="password" class="form-control" id="password" name="password" placeholder="كلمة المرور">
    
</div>
  <button type="submit" class="btn btn-primary">انشاء</button>
  <a class="btn btn-dark" href="{{ route('users.index') }}">الغاء الأمر</a>
</form>
@endsection
