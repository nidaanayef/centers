@extends("layouts._admin")

@section("title","اضافة مركز جديد")

@section("content")

<form class="w-50" method="POST" action="{{route('center.store')}}">
@csrf
                  <!--add center name-->
                  <div class="form-group">
										<label for="center_name">اسم المركز</label>
										<input autofocus value="{{ old('center_name') }}" id="center_name" class="form-control" type="text" name="center_name" placeholder="اسم المركز">
                  </div>
                  <!--add center address-->
                  <div class="form-group">
										<label for="address"> عنوان المركز</label>
										<input value="{{ old('address') }}" id="address" class="form-control" type="text" name="address" placeholder="عنوان المركز">
									</div>
                  <!--add maximum nominations-->
                  <div class="form-group">
										<label for="maximum_nomination"> الحد الأقصى للترشيحات</label>
										<input value="{{ old('maximum_nomination') }}" id="maximum_nomination" class="form-control"  name="maximum_nomination" placeholder="الحد الأقصى للترشيحات">
									</div>
								
										
												<button type="submit" class="btn btn-success">انشاء</button>
												<a class="btn btn-dark" href="{{ route('center.index') }}">الغاء الأمر</a>
										
									
							</form>

              <!--end::Form-->
             
                        

@endsection




