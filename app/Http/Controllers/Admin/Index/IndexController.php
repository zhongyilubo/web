<?php

namespace App\Http\Controllers\Admin\Index;


use App\Http\Controllers\Admin\InitController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexController extends InitController
{
    public function __construct()
    {

    }

    public function index(Request $request){

        $user = User::find(1);

        $user->givePermissionTo('edit articles');
        $permissions = $user->permissions;
//        $permissions = $user->getAllPermissions();
//        $roles = $user->getRoleNames();
dd($permissions);
//        $role = Role::create(['name' => 'writer']);
//        $permission = Permission::create(['name' => 'edit articles']);
//        $permission->assignRole($role);
//        dd($role,$permission);

//        dd(Route::currentRouteName());
        return view( 'admin.index.'. __FUNCTION__);
    }
}