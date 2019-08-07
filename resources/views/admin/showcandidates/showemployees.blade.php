@extends("layouts._admin")

@section("title", " قائمة الموظفين")

@section("content")
    
    <form class="row">
        
        <div class="col-sm-3">
            <select class="form-control" id="center_id" name="center_id">
                <option value="">جميع المراكز</option>
                @foreach($centers as $center)
                    <option {{ request()->center_id ==$center->id?"selected":"" }} value="{{ $center->id }}">{{ $center->center_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-sm-3 ">
            <button type="submit" class="btn btn-primary"><i class='fa fa-search'></i> بحث</button>
            
        </div>
        
        
           <div class="col-sm-4 ">
            
        </div>



        <div class="col-sm-2">
            <a class="btn btn-danger float-right mb-3" href="{{ route('showcandidates.showemployees') }}"> الغاء اسناد الوظيفة</a>
        </div>
    </form>
    @if($items->count()>0)
        <div class="alert alert-info mt-3">يوجد {{ $items->count() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم الموظف</th>
                    <th>اسم المركز </th>
                    <th>الايميل </th>
                    <th>رقم الهوية </th>
                    <th>رقم الجوال </th>
                    <th> الغاء اسناد الوظيفة</th>
                    <th width="15%"></th>
                
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
                    <td><input type="checkbox" class='cassigned' value='{{ $item->id }}' {{ $item->status?"checked":""}} /></td>
                    <td>           
                    <div class="btn-group" role="group" aria-label="Basic example">          
                        <a class="btn btn-sm btn-primary ml-2" href='{{ route("showemployees.edit", ["id" => $item->id]) }}'><i class='fa fa-edit'></i> تعديل</a>  
                    </div>
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>

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