<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Models\Center;
use App\Models\Employee;
use App\Http\Requests\UserRequest;
use App\Notifications\TemplateEmail;
use DB;
use Notifiable;
use Session;
class UserController extends BaseController
{
    public function index(Request $request)
    {
        $q = $request->q;
        

        //$items = DB::table('users')->all();
        $items=User::all();
        
        if($q){
            $items=User::whereRaw("(name like ?)", ["%$q%"]);
        }        
        return view("admin.users.index", compact("items"));
    }
    

    public function create()
    {
        $centers =Center::whereNotIn('id',User::select('center_id')
        ->where(function ($query) {
        $query->where('center_id','!=',0);}))->where('id','!=',0)
        ->get();

          return view("admin.users.create",compact("centers"));   
    }

    public function store(UserRequest $request)
    {
        $manager_identity=$request->manager_identity;
            $mobile=$request->mobile;
            $email=$request->email;
            $request['password'] = bcrypt($request->password);

        $employees=Employee::where('employee_identity','=',$manager_identity)->orWhere('mobile','=',$mobile)
               ->orWhere('email','=',$email)->get();
        if($employees->count()>0){
            Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
            return redirect(route("users.create")); 
        }
         else{
        User::create($request->all());
        Session::flash("msg","s: تمت عملية الاضافة بنجاح");
        return redirect(route("users.create")); 
    }
    }

    public function edit($id)
    {
        $centers =Center::whereNotIn('id',User::select('center_id')
        ->where(function ($query) {
        $query->where('center_id','!=',0);}))->where('id','!=',0)
        ->get();
        
        $item = User::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("users.index"));
        }
        return view("admin.users.edit", compact("item", "id","centers"));
    }

    public function update(Request $request, $id)
    {
        $manager_identity=$request->manager_identity;
            $mobile=$request->mobile;
            $email=$request->email;

        $employees=Employee::where('employee_identity','=',$manager_identity)->orWhere('mobile','=',$mobile)
               ->orWhere('email','=',$email)->get();
        if($employees->count()>0){
            Session::flash("msg","w: هناك رقم هوية أو جوال أو ايميل سابق");
            return redirect(route("users.edit")); 
        }
         else{
            try {
                User::find($id)->update($request->all());
                Session::flash("msg","s: تمت عملية التعديل بنجاح");
                return redirect(route("users.index"));
            } catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == '1062'){
                    Session::flash("msg","e: يوجد رقم هوية أو جوال أو ايميل سابق");
                    return redirect(route("showemployees.edit", $id));
                }
            } 
            } 
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Session::flash("msg","w: تمت عملية الحذف بنجاح");
        return redirect(route("users.index"));
    }

    public function show()
    {
        return redirect(route("users.index"));
    }


}
