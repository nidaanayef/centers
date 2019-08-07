@extends("layouts._admin")

@section("title", "تقرير التأخر للموظفين")

@section("content")
<form class="row mb-3">

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
                    <th>تاريخ التأخر</th>
                    <th>ساعات التأخر</th>
                    <th>دقائق التأخر</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->center_name }}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->delay_hour }}</td>
                    <td>{{ $item->delay_minute }}</td>
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
