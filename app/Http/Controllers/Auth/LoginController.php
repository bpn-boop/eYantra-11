<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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

    //  protected $redirectTo;
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd(auth()->check());
        // if(auth()->user()->role == 'admin') {
        //     $this->redirectTo = RouteServiceProvider::HOME;
        //  }else{
        //     $this->redirectTo = '/';
        //  }
        $this->middleware('guest')->except('logout');
    }

        /**
     * Handle post-login redirection.
     *
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            // Redirect admins to their dashboard
            return redirect(RouteServiceProvider::HOME);
        }
        return redirect('/');
    }
}
