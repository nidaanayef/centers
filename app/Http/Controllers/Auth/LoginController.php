<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  
    //protected $redirectTo = '/admin';

    protected function authenticated(Request $request, $user) {
        
        if ($user->job == "system manager") {

            return redirect('/admin');}
        else{
            return redirect('/admin/manager');
        }
           
       
   }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
//override the function username
    public function username()
{
    return 'manager_identity';
}
// public function check()
// {
//     $user=User::where('job','=',"system manager")->select('job')->get();

//     if($user->job='system manager'){

//         $redirectTo = '/admin';  
//     }
    
//     else{
//          $redirectTo = '/admin/manager';
//     }
// }
}
