<?php

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysPremission;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PremissionController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.system.develop.premission.';
    }

    public function index(Request $request){

        $page = $request->page ?? 1;
        $guard = $request->guard ?? 'admin';

        $permissions = SysPremission::getModules([$guard])->mergeTree('node');
        $lists =  $permissions->forPage($page,self::PAGESIZE);
        $lists = new LengthAwarePaginator($lists,$permissions->count(),self::PAGESIZE,$page);

        return view( $this->template. __FUNCTION__,compact('lists','guard'));
    }
}