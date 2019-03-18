<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends InitController
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
    protected $redirectTo = '/';

    /**
     * @return mixed
     * 登录页面
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * @return string
     * 验证字段
     */
    public function username()
    {
        return 'mobile';
    }

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     * 验证信息
     */
    protected function authenticated(Request $request, $user)
    {

    }

    /**
     * @return mixed
     *
     * 设置对应登录的gurad
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}