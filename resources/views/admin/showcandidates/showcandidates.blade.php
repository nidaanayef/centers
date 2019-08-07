@extends("layouts._admin")

@section("title", " قائمة المرشحين")

@section("content")
    
    <form  action="{{ route('showcandidates.candidate') }}" method = "post">
    @csrf
    
       <div class="row"> 
        <div class="col-sm-3" id="hidden_div" style="display:none;">
            <select class="form-control" id="center_id" name="center_id">
                <option value="">جميع المراكز</option>
                @foreach($centers as $center)
                    <option {{ request()->center_id ==$center->id?"selected":"" }} value="{{ $center->id }}">{{ $center->center_name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-sm-3 ">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
        <div class="col-sm-4">
            
        </div>

        <div class="col-sm-2">
            <a class=" test btn btn-success  mb-3" ><i class='fa fa-plus'></i> اسناد الوظيفة</a>
        </div>
        </div>
    
    
    @if($items->total()>0)
        <div class=" row alert alert-info mt-3">يوجد {{ $items->total() }} نتائج لعملية البحث</div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>اسم المترشح</th>
                    <th>اسم المركز </th>
                    <th>الايميل </th>
                    <th>رقم الهوية </th>
                    <th>رقم الجوال </th>
                    <th>اسناد الوظيفة</th>
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
                    <td class="text-center"><input type="checkbox" name="status[{{ $item->id }}]" 
                     @if($item->status) checked @endif ></td>
                    <td>           
                    <div class="btn-group" role="group" aria-label="Basic example">          
                        <a class="btn btn-sm btn-primary ml-2" href='{{ route("showcandidates.edit", ["id" => $item->id]) }}'><i class='fa fa-edit'></i> تعديل</a>  
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </form>
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
    <script>
$(document).ready(function(){
    $(".test").click(function(){
        $("#hidden_div").show();
        
    });
});
</script>
@endsection
