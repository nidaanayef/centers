@extends("layouts.‏‏_admin_manager")

@section("title", "تقرير التأخر للموظفين")

@section("content")
@if($users->count()>0)    
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
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
