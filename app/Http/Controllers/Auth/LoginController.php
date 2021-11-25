<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user)
    {
      
          if($user->hasRole('Customer') && $user->status == 0)
          {
              
            $this->guard()->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect()->route('login')->withMessage("Your account is currently inactive");
          }
          else
          {
            if($user->hasRole('Admin')   || $user->hasRole('Site Employee') || $user->hasRole('Sales Member')) {
                return redirect('admin');
            }
            elseif($user->hasRole('Driver'))
            {
              return redirect('admin/driver');
            }
            elseif($user->hasRole('Warehouse'))
            {
              return redirect('admin/masterPicklist');
            }
            else
            {
                return redirect('home');
            }
          }
      
      
    }
}
