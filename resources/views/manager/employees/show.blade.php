@extends("layouts.‏‏_admin_manager")

@section("title", "موظفي مركز المعتمدين من النظام")

@section("content")
    
    <form class="row mb-3">
        <div class="col-sm-3">
            <input type="text" value='{{ request()->q }}' placeholder="ادخل كلمة البحث" name="q" autofocus class="form-control" />
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
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
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->center1->center_name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->mobile }}</td>
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
