<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Center;
use App\User;
use App\Http\Requests\EmployeeRequest;
use Session;
use DB;
use Auth;
class EmployeeController extends BaseController
{
    public function index(Request $request)
    {
        $q = $request->q;

        $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();
           
            $items=Employee::where('status',0)->where('old_center_id','=',$center_id->center_id);
            
        if($q){
            $items->whereRaw("(employee_name like ?)", ["%$q%"]);
        }        
        $items =  $items->paginate(5)->appends([
            "q" => $q
        ]);
        
        return view("manager.employees.index", compact("items"));
  
    }
    

    public function create()
    {
        return view("manager.employees.create");
    }

    public function store(EmployeeRequest $request)
    {
        
        $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();

            $employee_name=$request->employee_name;
            $employee_identity=$request->employee_identity;
            $mobile=$request->mobile;
            $email=$request->email;

            $items=Employee::where('status',0)->where('old_center_id','=',$center_id->center_id)
            ->get();
    
            $maximum_nomination=Center::select('maximum_nomination')->where('id','=',$center_id->center_id)->first();

            $users=User::where('manager_identity','=',$employee_identity)->orWhere('mobile','=',$mobile)
               ->orWhere('email','=',$email)->get();

               if($users->count()>0){
                Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
                return redirect(route("candidates.create"));  
               }else{
             
            if($items->count()<=$maximum_nomination->maximum_nomination)
            {
                DB::table('employees')->insert([
                    'employee_name'=>$employee_name,
                    'employee_identity'=>$employee_identity,
                    'mobile'=>$mobile,
                    'email'=>$email,
                    'old_center_id'=>$center_id->center_id,
                    'center_id'=>null,
                    ]); 
                    Session::flash("msg","s: تمت عملية الاضافة بنجاح");
                    return redirect(route("candidates.create"));
         }else{
            Session::flash("msg","w:تجاوزت الحد الأقصى لترشيحات المركز");
            return redirect(route("candidates.index"));
        }
          }
     
    }

    public function edit($id)
    {
        $item = Employee::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("candidates.index"));
        }
        return view("manager.employees.edit", compact("item", "id"));
    }
    
    public function update(EmployeeRequest $request, $id)
    {
        $employee_identity=$request->employee_identity;
            $mobile=$request->mobile;
            $email=$request->email;

        $users=User::where('manager_identity','=',$employee_identity)->orWhere('mobile','=',$mobile)
               ->orWhere('email','=',$email)->get();

               if($users->count()>0){
                Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
                return redirect(route("candidates.edit",$id));  
               }else{
            Employee::find($id)->update($request->all());
            Session::flash("msg","s: تمت عملية التعديل بنجاح");
            return redirect(route("candidates.index"));
        } 
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();
        Session::flash("msg","w: تمت عملية الحذف بنجاح");
        return redirect(route("candidates.index"));
    }
   

    public function employees(Request $request)
    {
        $q = $request->q;

        $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();
           
            $items=Employee::where('status',1)->where('center_id','=',$center_id->center_id);
            
        if($q){
            $items->whereRaw("(employee_name like ?)", ["%$q%"]);
        }        
        $items =  $items->paginate(5)->appends([
            "q" => $q
        ]);
        
        return view("manager.employees.show", compact("items"));
  
    }
}