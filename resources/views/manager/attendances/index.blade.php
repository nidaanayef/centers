@extends("layouts.‏‏_admin_manager")

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
        

        <div class="col-sm-3 ">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>
        <div class="col-sm-3">
            <a class="btn btn-success float-right mb-3" href="{{ route('attendance.create') }}"><i class='fa fa-plus'></i> ادخال بيانات حضور</a>
        </div>
    </form>
    
        
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>رقم الهوية</th>
                    <th>حاضر</th>
                    <th> غائب</th>
                    <th>متأخر</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->attends }}</td>
                    <td>{{ $item->absents }}</td>
                    <td>{{ $item->lates }}</td>
                    <td>           
                    <div class="btn-group" role="group" aria-label="Basic example">          
                        <a class="btn btn-sm btn-primary ml-2" href='{{ route("attendance.edit", ["id" => $item->id]) }}'><i class='fa fa-edit'></i> تعديل</a>  
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
@endsection
