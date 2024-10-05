<?php namespace Digitlimit\Adminpanel\Http\Controllers;


use Digitlimit\Adminpanel\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth', ['except'=>['getLogin','postLogin']]);
    }


    public function postLogin(AuthLoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if($this->auth->attempt($credentials, $request->has('remember'))){
            return redirect()->intended(route('adminpanel.dashboard.index'));
        }

        return redirect(null, 401)->route('adminpanel.auth.getLogin')->with('adminpanel_form',[
            'icon' => 'fa fa-times-circle',
            'status' => 'error',
            'message' => 'Invalid Username/Email or Password'
        ]);
    }

    public function getLogin()
    {
        return view('adminpanel::login');
    }


    public function getLogout()
    {
        $this->auth->logout();
        return redirect()->route('adminpanel.auth.getLogin');
    }

    public function socialCallback($provider)
    {

    }
}