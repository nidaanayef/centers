<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Notifications\TemplateEmail;
use App\User;
use Session;
use Notifiable;

class TemplateEmailController extends BaseController
{
    
   

    function index($id)
    {
        $item = User::find($id);
        if(!$item){
            Session::flash("msg", "e: الرجاء التأكد من الرابط");
            return redirect(route("users.index"));
        }
        
        return view("admin.users.edit_password", compact("item", "id"));
     
    }


    function send(Request $request, $id)
    {
       
        $data = array(
            'name'      =>  $request->name,
            'password'      =>  $request->password,
           
        );

        $user = User::find($id);
        //$email=$request->email;
        $user->password =$request->password;
        $user->notify(new TemplateEmail($user));
        $user->save();
         Session::flash("msg","s:  تمت عملية التعديل بنجاح وارسال بريد الكتروني بالكلمة الجديدة");
        return redirect(route("users.index"));
        

     

    }

    
}

?>