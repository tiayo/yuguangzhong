<?php

namespace App\Http\Controllers\Manage\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo, $auth;

    public function __construct()
    {
        $this->redirectTo = route('manage');
        $this->auth = 'manager';
        $this->middleware('manage_guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('manage.auth.login');
    }

    protected function guard()
    {
        return Auth::guard($this->auth);
    }

    public function username()
    {
        return 'name';
    }
}
