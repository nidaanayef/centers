<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Center;
use App\Models\Attendance;
use App\User;
use App\Http\Requests\AttendanceRequest;
use Session;
use DB;
use Auth;
use Carbon\Carbon;
class AttendanceController extends BaseController
{
    public function index(Request $request)
    {
        $q = $request->q;
        $qq = $request->qq;

        /*$users = DB::table('employees')
            ->join('centers', 'employees.center_id', '=', 'centers.id')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select('employees.employee_name','employees.employee_identity','attendances.attend','attendances.absent','attendances.late','attendances.id')
            ->get();
        
            
        if($q && $qq){
            
            $users = DB::table('employees')
            ->join('centers', 'employees.center_id', '=', 'centers.id')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select('employees.employee_name','employees.employee_identity','attendances.attend','attendances.absent','attendances.late','attendances.id')
            ->whereRaw("date >= ? AND date <= ?", array($q, $qq))->get();
            
        } */
        if(!$q){
            $q = '2018-01-01';
        }      
        if(!$qq){
            $qq = date('Y-m-d');
        }
        $users = DB::table('employees')->selectRaw("employees.*,
        (select count(*) from attendances where employee_id=employees.id and date between '$q' and '$qq' and attend=1)as attends
        ,(select count(*) from attendances where employee_id=employees.id and date between '$q' and '$qq' and absent=1)as absents
        ,(select count(*) from attendances where employee_id=employees.id and date between '$q' and '$qq' and late=1)as lates"
        )->get();
        //return $users;
        return view("manager.attendances.index", compact("users"));
  
    }
    

    public function create()
    {
        
        $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();

        
        $items =Employee::whereNotIn('id',Attendance::select('employee_id'))
        ->where('center_id', '=',$center_id->center_id)
        ->where('status', '=',1)
        ->get();

      //  dd($items);
        
        return view("manager.attendances.create",compact("items"));
       
    }

    public function store(AttendanceRequest $request)
    {
        
        $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();

        $date= (date('Y-m-d', strtotime($request->date))); //Carbon::parse($request->date)->format('Y-m-d'); 
        $attend_status=$request->attend_status;
        $delay_hour=$request->delay_hour;
        $delay_minute=$request->delay_minute;
        $employee_id=$request->employee_id;
        $count = count($employee_id);
        //dd($request->all());

    if(count($attend_status) > count($delay_hour))
        $count = count($delay_hour);
    elseif(count($delay_hour) > count($employee_id)) 
        $count = count($employee_id);
    elseif(count($employee_id) > count($delay_minute)) 
        $count = count($delay_minute);
    else $count = count($attend_status);
    
     $insertData = array();

    for($i = 0; $i < $count; $i++){
        if($attend_status[$i]==1){
            $data = array(
                'employee_id'=>$employee_id[$i],
                    'attend'=>1,
                    'date'=>$date,
            );
    
            $insertData[] = $data;

        }

        if($attend_status[$i]==2){
            $data = array(
                'employee_id'=>$employee_id[$i],
                'absent'=>1,
                    'date'=>$date,
            );
    
            $insertData[] = $data;

        }

        if($attend_status[$i]==3){
            $data = array(
                'employee_id'=>$employee_id[$i],
                  'late'=>1,
                    'date'=>$date,
                    'delay_hour'=>$delay_hour[$i],
                    'delay_minute'=>$delay_minute[$i],
            );
    
            $insertData[] = $data;

        }
       
    }

    //var_dump($insertData);
    Attendance::insert($insertData);
    Session::flash("msg","s: تمت عملية الاضافة بنجاح");
    return redirect(route("attendance.create")); 
        
    }
    
    
    public function attendShow(Request $request){
        
        $date = (date('Y-m-d', strtotime($request->date)));
         
         $center_id=User::select('center_id')->where(function ($query) {
            $query->where('id',Auth::user()->id);})->first();

        
        $items = Employee::whereIn('id',Attendance::select('employee_id')
                ->where(function ($query)  use ($date) {
                    $query->where('date','=', $date)
                    ->where('absent','=', 0)
                    ->where('attend','=', 0)
                    ->where('late','=', 0);
                }))
        ->where('center_id', '=',$center_id->center_id)
        ->where('status', '=',1)
        ->get();
        
        
        if(count($items) == 0){
             $items =Employee::whereIn('id',Attendance::select('employee_id')
            ->where(function ($query) {
            $query->where('date','!=',date('Y-m-d', strtotime(Carbon::now())));}))
            ->where('center_id', '=',$center_id->center_id)
            ->where('status', '=',1)
            ->get();
        }

      //  dd($items);
      
      return view("manager.attendances.create",compact("items", "date"));
        
     //   return redirect()->back()->withInput($request->all())->with(compact("items"));
        
    }

    public function edit($id)
    {
        $item = Attendance::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("attendance.index"));
        }
        return view("manager.attendances.edit", compact("item", "id"));
    }
    
    public function update(Request $request, $id)
    {
        

        
        $date=(date('Y-m-d', strtotime($request->date)));
        $attend_status=$request->attend_status;
        $delay_hour=$request->delay_hour;
        $delay_minute=$request->delay_minute;

        

       if($attend_status==1){

        $attendance =Attendance::find($id);
        $attendance->attend = 1;
        $attendance->absent= 0;
        $attendance->late= 0;
        $attendance->date = $date;
        $attendance->save();
       
        Session::flash("msg","s: تمت عملية التعديل بنجاح");
        return redirect(route("attendance.index"));
           }

       if($attend_status==2){
        $attendance =Attendance::find($id);
        $attendance->attend = 0;
        $attendance->absent= 1;
        $attendance->late= 0;
        $attendance->date = $date;
        $attendance->save();
       
        Session::flash("msg","s: تمت عملية التعديل بنجاح");
        return redirect(route("attendance.index"));
    }
    if($attend_status==3){
        $attendance =Attendance::find($id);
        $attendance->attend = 0;
        $attendance->absent= 0;
        $attendance->late= 1;
        $attendance->date = $date;
        $attendance->delay_hour=$delay_hour;
        $attendance->delay_minute=$delay_minute;
        $attendance->save();
       
        Session::flash("msg","s: تمت عملية التعديل بنجاح");
        return redirect(route("attendance.index")); 
    }
    }

    public function absentShow()
    {
       
        $users = DB::table('employees')
        ->join('centers', 'employees.center_id', '=', 'centers.id')
        ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        ->select('employees.employee_name','employees.employee_identity','attendances.date','attendances.id')
        ->whereRaw('absent=1')
        ->get();  
        
        return view("manager.attendances.absent_show", compact("users"));
  
    }

    public function lateShow()
    {
       
        $users = DB::table('employees')
        ->join('centers', 'employees.center_id', '=', 'centers.id')
        ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        ->select('employees.employee_name','employees.employee_identity','attendances.date','attendances.id','attendances.delay_hour','attendances.delay_minute')
        ->whereRaw('late=1')
        ->get(); 
        //dd($users->count());
        return view("manager.attendances.delay_report", compact("users"));
       
  
    }
}