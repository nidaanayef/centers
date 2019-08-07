<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("login");
});

Route::get('/home', function () {
    return redirect('login');
});



Route::group(array('prefix' => 'admin'), function()
{
    Route::get("/","Admin\HomeController@index");
    Route::get("/manager","Admin\HomeController@indexManager");
    

    //system manager(اسناد و الغاء اسناد الموظفين) 
    Route::get("showcandidates/showcandidates", "Admin\CandidateController@showcandidates")->name("showcandidates.showcandidates");
    Route::get("showcandidates/showemployees", "Admin\CandidateController@showemployees")->name("showcandidates.showemployees");
    //update candidate for system manager
    Route::get("showcandidates/{id}/editcandidates", "Admin\CandidateController@editCandidate")->name("showcandidates.edit");
    Route::put("showcandidates/editcandidates/{id}", "Admin\CandidateController@updateCandidate")->name("showcandidates.update");
    //multiple update status and center_id for candidate
    Route::post("showcandidates/candidate", "Admin\CandidateController@candidate")->name("showcandidates.candidate");
    //multiple update status and old_center_id for employee
    Route::get("showcandidates/{id}/candidate", "Admin\CandidateController@employee")->name("showcandidates.employee");
    //update employee for system manager
    Route::get("showemployees/{id}/editemployee", "Admin\CandidateController@editEmployee")->name("showemployees.edit");
    Route::put("showemployees/editemployee/{id}", "Admin\CandidateController@updateEmployee")->name("showemployees.update");
    
    
    Route::get("center/{id}/delete", "Admin\CenterController@destroy")->name("center.delete");
    Route::resource("center","Admin\CenterController");

    
    Route::get("users/{id}/delete", "Admin\UserController@destroy")->name("users.delete");

    //for update password
    Route::get('users/{id}/editpassword', 'Admin\TemplateEmailController@index')->name('edit_password.edit');
    Route::put('users/editpassword/{id}', 'Admin\TemplateEmailController@send')->name('edit_password.update');
    
    
    Route::get("employees/candidates", "Admin\EmployeeController@candidates")->name("candidates.index");
    Route::get("employees", "Admin\EmployeeController@employees")->name("employees.index");

    //for system manager (reports)
    Route::get("employees_reports", "Admin\ReportController@reports")->name("reprts.index");
    Route::get("attendance_reprts", "Admin\ReportController@attendanceReports")->name("attendance_reprts.index");
    Route::get("absent_reprts", "Admin\ReportController@absentReports")->name("absent_reprts.index");
    Route::get("late_reprts", "Admin\ReportController@lateReports")->name("late_reprts.index");

    //for manager(candidates)
    Route::get("candidates/{id}/delete", "Admin\EmployeeController@destroy")->name("candidates.delete");
    Route::resource("candidates","Admin\EmployeeController");

    //for manager(employees)
    Route::get("employees/show", "Admin\EmployeeController@employees")->name("employees.show");

    //for manager(attendance)
    Route::get("attendance/late_show", "Admin\AttendanceController@lateShow")->name("attendance.lateShow");
    Route::get("attendance/absent_show", "Admin\AttendanceController@absentShow")->name("attendance.absentShow");
    Route::post("attendance/attend_show", "Admin\AttendanceController@attendShow")->name("attendance.attendShow");
    Route::resource("attendance","Admin\AttendanceController");

    
    Route::resource("users","Admin\UserController");
});
Auth::routes();



