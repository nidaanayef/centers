@extends("layouts._admin")

@section("title", "ادارة المراكز")

@section("content")

<form class="row">
        <div class="col-sm-3">
            <input type="text" value='{{ request()->q }}' placeholder="ادخل كلمة البحث" name="q" autofocus class="form-control" />
        </div>
       
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>

        <div class="col-sm-3">
            <a class="btn btn-success float-right mb-3" href="{{ route('center.create') }}"><i class='fa fa-plus'></i> اضافة مركز جديد</a>
        </div>
        
</form>
    @if($items->total()>0)
        <div class="alert alert-info mb-3">يوجد {{ $items->total() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th width="20%">اسم المركز</th>
                    <th width="30%">عنوان المركز </th>
                    <th width="20%">الحد الأقصى للترشيحات </th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->center_name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->maximum_nomination }}</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">          
                        <a class="btn btn-sm btn-primary ml-2" href='{{ route("center.edit", ["id" => $item->id]) }}'><i class='fa fa-edit'></i> تعديل</a> 
                        <a class="btn btn-sm btn-danger confirm ml-2" href='{{ route("center.delete", $item->id) }}'><i class='fa fa-trash'></i> حذف</a>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    @else
        <div class="alert alert-warning mt-3">
            نأسف لا يوجد نتائج لعرضها  :(
        </div>
    @endif
@endsection

