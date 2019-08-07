<?php

use Illuminate\Database\Seeder;
use App\Models\Link;
class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
//for system manager

        //Centers
        $link = Link::create(['title'=>'المراكز','icon'=>'flaticon-presentation','parent_id'=>0]);
        Link::create(['title'=>'اضافة مركز جديد','route_name'=>'center.create','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'ادارة المراكز','route_name'=>'center.index','icon'=>'','parent_id'=>$link->id]);
        
        
      
        //Centermanagers
        $link = Link::create(['title'=>'مدراء المراكز','icon'=>'fa fa-user','parent_id'=>0]);
        Link::create(['title'=>'اضافة مدير جديد','route_name'=>'users.create','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'ادارة المدراء','route_name'=>'users.index','icon'=>'','parent_id'=>$link->id]);
        
        

        //Candidates waiting for distribution
       $link = Link::create(['title'=>'مترشحين في انتظار التوزيع','icon'=>'flaticon-users-1','parent_id'=>0]);
       Link::create(['title'=>'ادارة المترشحين في انتظار التوزيع','route_name'=>'showcandidates.showcandidates','icon'=>'','parent_id'=>$link->id]);

      
        
      //Centers employees
      $link = Link::create(['title'=>'موظفي المراكز','icon'=>'flaticon-users','parent_id'=>0]);
      Link::create(['title'=>'ادارة موظفي المراكز','route_name'=>'showcandidates.showemployees','icon'=>'','parent_id'=>$link->id]); 


        //Centers reports
        $link = Link::create(['title'=>'تقارير المراكز','icon'=>'flaticon-clipboard','parent_id'=>0]);
        Link::create(['title'=>'تقرير بيانات الموظفين بالمركز','route_name'=>'reprts.index','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقرير احصائية الغياب و التأخر','route_name'=>'attendance_reprts.index','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقرير احصائية الغياب','route_name'=>'absent_reprts.index','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقرير احصائية التأخر','route_name'=>'late_reprts.index','icon'=>'','parent_id'=>$link->id]);

//for center manager

           //candidates
        $link = Link::create(['title'=>'ترشيح الموظفين','icon'=>'flaticon-user-add','parent_id'=>0]);
        Link::create(['title'=>'اضافة مترشح جديد','route_name'=>'candidates.create','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'ادارة المترشحين','route_name'=>'candidates.index','icon'=>'','parent_id'=>$link->id]);
        


        //employees 
        $link = Link::create(['title'=>'موظفي المركز','icon'=>'flaticon-users','parent_id'=>0]);
        Link::create(['title'=>'عرض موظفي المركز المعتمدين','route_name'=>'employees.show','icon'=>'','parent_id'=>$link->id]);

         //attendances
        $link = Link::create(['title'=>'حضور الموظفين','icon'=>'flaticon-users-1','parent_id'=>0]);
        Link::create(['title'=>'ادخال بيانات حضور الموظفين','route_name'=>'attendance.create','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقريرالحضور و الغياب و التأخر','route_name'=>'attendance.index','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقرير الغياب','route_name'=>'attendance.absentShow','icon'=>'','parent_id'=>$link->id]);
        Link::create(['title'=>'تقرير التأخر','route_name'=>'attendance.lateShow','icon'=>'','parent_id'=>$link->id]);



       
        
        
        


    }
}
