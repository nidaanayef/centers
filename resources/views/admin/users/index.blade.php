@extends("layouts._admin")

@section("title", "مدراء المراكز ")

@section("content")
    
    <form class="row">
        <div class="col-sm-3">
            <input type="text" value='{{ request()->q }}' placeholder="ادخل كلمة البحث" name="q" autofocus class="form-control" />
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>
        <div class="col-sm-3">
            <a class="btn btn-success float-right mb-3" href="{{ route('users.create') }}"><i class='fa fa-plus'></i>    اضافة مدير جديد</a>
        </div>
    </form>
    @if($items->count()>0)
        <div class="alert alert-info mb-3">يوجد {{ $items->count() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم مدير المركز</th>
                    <th>اسم المركز </th>
                    <th>الايميل </th>
                    <th>رقم الهوية </th>
                    <th>رقم الجوال </th>
         
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    @if($item->job=='system manager'|$item->center_id==null)
                    <td>ليس مدير لمركز</td>
                    @else
                    <td>{{ $item->center->center_name }}</td>
                    @endif
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->manager_identity }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td class="text-right">           
                        <a class="btn btn-sm btn-primary" href='{{ route("users.edit", ["id" => $item->id]) }}' title='تعديل'><i class='fa fa-edit'></i></a>
                        <a class="btn btn-sm btn-info" href='{{ route("edit_password.edit", ["id" => $item->id]) }}' title='تعديل كلمة السر'><i class='fa fa-lock'></i></a>    
                        <a class="btn btn-sm btn-danger confirm" href='{{ route("users.delete", $item->id) }}' title='حذف'><i class='fa fa-trash'></i></a>
                    </td>
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
