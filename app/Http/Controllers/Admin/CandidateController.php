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

class CandidateController extends  BaseController
{
    public function showcandidates(Request $request)
    {

        $items=Employee::where('status',0);
             
        $items =  $items->orderBy('id','desc')->paginate(5);
        $centers=Center::get();
        return view("admin.showcandidates.showcandidates", compact("items", "centers"));

  
    }

    public function candidate(Request $request)
    {
        $center_id=$request->center_id;
        
        $items=Employee::where('status',0)->get();
        // $candidate=Employee::where('status',0)->where('center_id','=',$center_id)
        //     ->get();

       $employee=Employee::where('status',1)->where('center_id','=',$center_id)
            ->get();

        $maximum_nomination=Center::select('maximum_nomination')->where('id','=',$center_id)->first();
        $center_name=Center::select('center_name')->where('id','=',$center_id)->first();
        $data = $request->status;
        if($data==null||$center_id==null){
             Session::flash("msg","w:تحتاج الى تحديد المركز المراد الاسناد اليه بالاضافة الى اختيار أحد المترشحين للاسناد ");
             return redirect(route("showcandidates.showcandidates"));
        }else{
        $count = count($data);
        //dd($count);
        if(($count+$employee->count())<=$maximum_nomination->maximum_nomination)
        {
            foreach($items as $item) {
                $item->status = $request->has('status.' . $item->id);
                $item->center_id = $request->center_id;
                $item->save();
            }
        Session::flash("msg","s: تمت عملية الاسناد بنجاح");
        return redirect(route("showcandidates.showcandidates"));
     }else{
        Session::flash("msg","w:تجاوزت الحد الأقصى لترشيحات مركز {$center_name->center_name} ={$maximum_nomination->maximum_nomination}");
        return redirect(route("showcandidates.showcandidates"));
      }
    }}

    public function employee($id)
    {
        $employee = Employee::find($id);
        $employee->status= !$employee->status;
        $employee->center_id=null;
        $employee->save();
        return response()->json(["status" => 1, "msg" => "Updated successfully"]);
    
    }

    public function showemployees(Request $request)
    {
        $center_id = $request->center_id;

        $items=Employee::where('status',1)->where('center_id','!=',null);
              
        if($center_id){
            $items->where("center_id", $center_id);
        }        
        $items =  $items->orderBy('id','desc')->paginate(5)->appends([
            "center_id" => $center_id
        ]);
        $centers=Center::get();
        return view("admin.showcandidates.showemployees", compact("items","centers"));
    }

    //update candidate data
    public function editCandidate($id)
    {
        $item = Employee::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("showcandidates.showcandidates"));
        }
        return view("admin.showcandidates.editcandidate", compact("item", "id"));
    }

    public function updateCandidate(Request $request, $id)
    {
        $employee_identity=$request->employee_identity;
        $mobile=$request->mobile;
        $email=$request->email;

    $users=User::where('manager_identity','=',$employee_identity)->orWhere('mobile','=',$mobile)
           ->orWhere('email','=',$email)->get();

           if($users->count()>0){
            Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
            return redirect(route("showcandidates.edit",$id));  
           }else{
        try {
            Employee::find($id)->update($request->all());
            Session::flash("msg","s: تمت عملية التعديل بنجاح");
            return redirect(route("showcandidates.showcandidates")); 
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                Session::flash("msg","e: يوجد رقم هوية أو جوال أو ايميل سابق");
                return redirect(route("showcandidates.edit",$id));
            }
        } } 
        
        
    }

    //update emploee data
    public function editEmployee($id)
    {
        $item = Employee::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("showcandidates.showemployees"));
        }
        return view("admin.showcandidates.editemployee", compact("item", "id"));
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee_identity=$request->employee_identity;
        $mobile=$request->mobile;
        $email=$request->email;

    $users=User::where('manager_identity','=',$employee_identity)->orWhere('mobile','=',$mobile)
           ->orWhere('email','=',$email)->get();

           if($users->count()>0){
            Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
            return redirect(route("showemployees.edit",$id));  
           }else{
        try {
            Employee::find($id)->update($request->all());
            Session::flash("msg","s: تمت عملية التعديل بنجاح");
            return redirect(route("showcandidates.showemployees"));
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                Session::flash("msg","e: يوجد رقم هوية أو جوال أو ايميل سابق");
                return redirect(route("showemployees.edit",$id));
            }
        }  }
         
        
    }
    
    

    

   


  
}
