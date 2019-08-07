@extends("layouts._admin")

@section("title", "تقرير الحضور للموظفين")

@section("content")
 
    <form class="row">
        
        <div class="col-sm-3 mb-4">
            <label for="q">ادخل التاريخ من</label>
            <input type="date" value='{{ request()->q }}' placeholder="" name="q" autofocus class="form-control" />
        </div>

        <div class="col-sm-3">
            <label for="qq">ادخل التاريخ الى</label>
            <input type="date" value='{{ request()->qq }}' placeholder="" name="qq"  class="form-control" />
        </div>

        <div class="col-sm-3">
            <select class="form-control" id="center_id" name="center_id">
                <option value="">جميع المراكز</option>
                @foreach($centers as $center)
                <option {{ request()->center_id ==$center->id?"selected":"" }} value="{{ $center->id }}">{{ $center->center_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>
    </form>
    
    @if($users->count()>0)        
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>اسم المركز</th>
                    <th>رقم الهوية</th>
                    <th>حاضر</th>
                    <th> غائب</th>
                    <th>متأخر</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->center_name }}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td><input disabled type="checkbox" {{ $item->attend==1?"checked":""}} /></td>
                    <td><input disabled type="checkbox" {{ $item->absent==1?"checked":""}} /></td>
                    <td><input disabled type="checkbox" {{ $item->late==1?"checked":""}} /></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-warning">
            نأسف لا يوجد نتائج لعرضها  :(
        </div>
    @endif  
@endsection
