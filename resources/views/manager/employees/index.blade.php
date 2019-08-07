@extends("layouts.‏‏_admin_manager")

@section("title", "مترشحي المركز")

@section("content")
    
    <form class="row">
        <div class="col-sm-3">
            <input type="text" value='{{ request()->q }}' placeholder="ادخل كلمة البحث" name="q" autofocus class="form-control" />
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>
        <div class="col-sm-3">
            <a class="btn btn-success float-right mb-3" href="{{ route('candidates.create') }}"><i class='fa fa-plus'></i> اضافة مترشح جديد</a>
        </div>
    </form>
    @if($items->total()>0)
        <div class="alert alert-info mb-3">يوجد {{ $items->total() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم المترشح</th>
                    <th>اسم المركز </th>
                    <th>الايميل </th>
                    <th>رقم الهوية </th>
                    <th>رقم الجوال </th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->center->center_name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td>           
                    <div class="btn-group" role="group" aria-label="Basic example">          
                        <a class="btn btn-sm btn-primary ml-2" href='{{ route("candidates.edit", ["id" => $item->id]) }}'><i class='fa fa-edit'></i> تعديل</a>  
                        <a class="btn btn-sm btn-danger confirm ml-2" href='{{ route("candidates.delete", $item->id) }}'><i class='fa fa-trash'></i> حذف</a>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    @else
        <div class="alert alert-warning">
            نأسف لا يوجد نتائج لعرضها  :(
        </div>
    @endif
@endsection
