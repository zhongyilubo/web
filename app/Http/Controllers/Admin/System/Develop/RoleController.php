<?php

namespace App\Http\Controllers\Admin\System\Develop;


use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysRole;
use Illuminate\Http\Request;

class RoleController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.system.develop.role.';
    }

    public function index(Request $request){

        $guard = $request->guard ?? 'admin';
        $lists = SysRole::where('guard_name',$guard)->paginate(self::PAGESIZE);
        return view( $this->template. __FUNCTION__,compact('lists','guard'));
    }
}