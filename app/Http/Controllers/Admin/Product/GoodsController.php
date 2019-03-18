<?php

namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GoodsController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.product.goods.';
    }

    public function index(Request $request){

//        $user->givePermissionTo('edit articles');
//        $permissions = $user->permissions;
//        $permissions = $user->getAllPermissions();
//        $roles = $user->getRoleNames();

//        $role = Role::create(['name' => 'writer']);
//        $permission = Permission::create(['name' => 'edit articles']);
//        $permission->assignRole($role);
//        dd($role,$permission);

//        dd(Route::currentRouteName());
        return view( $this->template. __FUNCTION__);
    }
}