@extends("layouts._admin")

@section("title","تعديل بيانات المركز ")

@section("content")

<form class="w-50" method="POST" action="{{route('center.update',$item->id)}}">
@csrf
@method("put")

                  <!--update center name-->
                  <div class="form-group">
										<label for="center_name">اسم المركز</label>
										<input autofocus value="{{ $item->center_name }}" id="center_name" class="form-control" type="text" name="center_name" placeholder="اسم المركز">
                  </div>
                   <!--update center address-->
                  <div class="form-group">
										<label for="address">عنوان المركز</label>
										<input  value="{{ $item->address }}" id="address" class="form-control" type="text" name="address" placeholder="عنوان المركز">
                  </div>
							
                 <!--update center name-->
                 <div class="form-group">
										<label for="maximum_nomination">الحد الأقصى للترشيحات</label>
										<input  value="{{ $item->maximum_nomination }}" id="maximum_nomination" class="form-control"  name="maximum_nomination" placeholder="الحد الأقصى للترشيحات">
                  </div>
								
										
												<button type="submit" class="btn btn-success">حفظ</button>
												<a class="btn btn-dark" href="{{ route('center.index') }}">الغاء الأمر</a>
										
									
							</form>

              <!--end::Form-->
             
                        

@endsection



