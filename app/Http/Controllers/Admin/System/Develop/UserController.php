<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/22
 * Time: 7:00
 */

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.system.develop.member.';
    }

    /**
     * @param Request $request
     * @return mixed
     * 列表
     */
    public function index(Request $request){
        $guard = $request->guard ?? config('permission.guard.admin');
        $lists = User::where('guard_name',$guard)->paginate(self::PAGESIZE);
        return view( $this->template. __FUNCTION__,compact('lists','guard'));
    }
}