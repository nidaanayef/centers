@extends("layouts._admin")

@section("title", "تقرير بيانات الموظفين")

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

@if($managers->count()>0)
<div class="alert alert-info mb-3">مدراء المراكز</div>    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>المسمى الوظيفي</th>
                    <th>رقم الهوية</th>
                    <th>رقم الجوال</th>
                </tr>
            </thead>
            <tbody>
                @foreach($managers as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    @if($item->job=='system manager')
                    <td>مدير النظام</td>
                    @else
                    <td>مدير مركز</td>
                    @endif
                    <td>{{ $item->manager_identity }}</td>
                    <td>{{ $item->mobile }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @else
        <div class="alert alert-warning">
            نأسف لا يوجد نتائج مدراء مراكز لعرضها  :(
        </div>
    @endif     

    @if($employees->count()>0)
    <div class="alert alert-info mb-3">موظفي المراكز</div>    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>المسمى الوظيفي</th>
                    <th>رقم الهوية</th>
                    <th>رقم الجوال</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>موظف</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->mobile }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @else
        <div class="alert alert-warning">
            نأسف لا يوجد نتائج موظفي مراكز لعرضها  :(
        </div>
    @endif       
@endsection
