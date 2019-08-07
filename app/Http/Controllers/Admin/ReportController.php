<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\Employee;
use App\Models\Attendance;
use App\User;
use App\Http\Requests\CenterRequest;
use DB;
use Session;
class ReportController extends BaseController
{
    public function reports(Request $request)
    {
    
        $center_id = $request->center_id;
        $managers = User::get();
        $employees = Employee::whereRaw("status=1")->get();
        $centers = Center::get();

        if($center_id){
            $managers = User::whereRaw("center_id=$center_id")->get();
            $employees = Employee::whereRaw("status=1 and center_id=$center_id")->get();
        } 

        return view("admin.reports.user", compact("employees","managers","centers"));
          
  
    }
    public function attendanceReports(Request $request)
    {
        $q = $request->q;
        $qq = $request->qq;
        $center_id = $request->center_id;

        $users = DB::table('employees')
            ->join('centers', 'employees.center_id', '=', 'centers.id')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select('employees.employee_name','centers.center_name','employees.employee_identity','attendances.attend','attendances.absent','attendances.late','attendances.id')
            ->get();
        
            
        if($q && $qq){
            
            $users = DB::table('employees')
            ->join('centers', 'employees.center_id', '=', 'centers.id')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select('employees.employee_name','centers.center_name','employees.employee_identity','attendances.attend','attendances.absent','attendances.late','attendances.id')
            ->whereRaw("date >= ? AND date <= ?", array($q, $qq))->get();
            
        }
        if($center_id){
            $users = DB::table('employees')
            ->join('centers', 'employees.center_id', '=', 'centers.id')
            ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->select('employees.employee_name','centers.center_name','centers.id','employees.employee_identity','attendances.attend','attendances.absent','attendances.late','attendances.id')
            ->whereRaw("centers.id =$center_id")
            ->get();
        } 
        $centers = Center::get();
        return view("admin.reports.attendance_reports", compact("users","centers")); 
  
    }

    public function absentReports(Request $request)
    {
        $center_id = $request->center_id;

        $users = DB::table('employees')
        ->join('centers', 'employees.center_id', '=', 'centers.id')
        ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        ->select('employees.employee_name','employees.employee_identity','centers.center_name','attendances.date','attendances.id')
        ->whereRaw('absent=1')
        ->get(); 
        
         if($center_id){
             $users = DB::table('employees')
             ->join('centers', 'employees.center_id', '=', 'centers.id')
             ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
             ->select('employees.employee_name','employees.employee_identity','centers.center_name','attendances.date','attendances.id')
             ->whereRaw("absent=1 and centers.id = $center_id")
             ->get();
         } 
        $centers = Center::get();
        return view("admin.reports.absent_report", compact("users","centers"));
  
    }

    public function lateReports(Request $request)
    {
        $center_id = $request->center_id;

        $users = DB::table('employees')
        ->join('centers', 'employees.center_id', '=', 'centers.id')
        ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
        ->select('employees.employee_name','employees.employee_identity','centers.center_name','attendances.date','attendances.id','attendances.delay_hour','attendances.delay_minute')
        ->whereRaw('late=1')
        ->get(); 
        
         if($center_id){
             $users = DB::table('employees')
             ->join('centers', 'employees.center_id', '=', 'centers.id')
             ->join('attendances', 'employees.id', '=', 'attendances.employee_id')
             ->select('employees.employee_name','employees.employee_identity','centers.center_name','attendances.date','attendances.id','attendances.delay_hour','attendances.delay_minute')
             ->whereRaw("late=1 and centers.id = $center_id")
             ->get();
         } 
        $centers = Center::get();
        return view("admin.reports.delay_report", compact("users","centers"));  
  
    }
}