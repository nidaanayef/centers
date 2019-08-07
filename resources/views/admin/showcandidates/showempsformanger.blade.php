@extends("layouts._admin")

@section("title", " تقارير بيانات الموظفين  ")

@section("content")
    
    <form class="row">
        <div class="col-sm-3 ">
            <input type="text" value='{{ request()->q }}' placeholder="ادخل كلمة البحث" name="q" autofocus class="form-control" />
        </div>
       
 
        <div class="col-sm-6 ">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
        </div>

    </form>
    @if($items->total()>0)
        <div class="alert alert-info mt-3">يوجد {{ $items->total() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>المسمى الوظيفي </th>
                    <th>رقم الهوية </th>
                    <th>رقم الجوال </th>
                   
                
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->employee_name }}</td>
                    <td>{{ $item->job}}</td>
                    <td>{{ $item->employee_identity }}</td>
                    <td>{{ $item->mobile }}</td>
                  
                   
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    @else
        <div class="alert alert-warning mt-2">
            نأسف لا يوجد نتائج لعرضها  :(
        </div>
    @endif
@endsection


@section("js")
    <script>
        $(".cassigned").click(function(){
            var id = $(this).val();//قيمة الفاليو 
            var url = "/admin/showcandidates/" + id + "/candidate";
            $.get(url, function(json){
                //console.log(json);//كل الجاسون
                //alert(json.msg);
            });
        })
    </script>
@endsection
