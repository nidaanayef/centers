<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Models\Center;
use App\Models\Employee;
use App\User;
use App\Http\Requests\CenterRequest;
use DB;
use Session;
class CenterController extends BaseController
{
    public function index(Request $request)
    {
        $q = $request->q;
        
        
        $items = DB::table('centers')->where('id','!=',0);
        
        if($q){
            $items->whereRaw("(center_name like ?)", ["%$q%"]);
        }        
        $items =  $items->paginate(5)->appends([
            "q" => $q
        ]);
        return view("admin.centers.index", compact("items"));
  
    }
    

    public function create()
    {
        return view("admin.centers.create");
    }

    public function store(CenterRequest $request)
    {
        Center::create($request->all());

        Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        return redirect(route("center.create"));
    }

    public function edit($id)
    {
        $item = Center::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("center.index"));
        }
        return view("admin.centers.edit", compact("item", "id"));
    }
    
    public function update(CenterRequest $request, $id)
    {
            Center::find($id)->update($request->all());
            Session::flash("msg","s: تمت عملية التعديل بنجاح");
            return redirect(route("center.index")); 
    }

    public function destroy($id)
    {
        
        $employees =Employee::where('center_id','=',$id)->where('status','=',1)->get();
        
        $manager =User::where('center_id','=',$id)->get();
//  // في حالة اراد الحذف وحتى فيه ناس للمركز       
//         if($employees->count()>0||$manager->count()>0){
//             Session::flash("msg","w: هذا المركز لديه مدير أو موظفين هل أنت متأكد من الحذف");
//             $center = Center::find($id);
//             $center->user()->delete();
//             $center->employee()->delete();
//             $center->delete();
//            return redirect(route("center.index"));

//         }

// في حالة لم يرد الحذف و فيه ناس للمركز       
        if($employees->count()>0||$manager->count()>0){
            
            Session::flash("msg","w: هذا المركز لديه مدير أو موظفين يرجى حذف الموظفين اولا");
           return redirect(route("center.index"));

        }
        
        else{

           Center::find($id)->delete();
           Session::flash("msg","w: تمت عملية الحذف بنجاح");
           return redirect(route("center.index"));
        }
        
    }
   
}