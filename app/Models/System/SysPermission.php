<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/29/029
 * Time: 12:16
 */

namespace App\Models\System;

use App\Models\Collection;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class SysPermission extends Permission
{

    protected  $appends = ['link'];


    /**
     * @param int $gurad
     * @return Collection
     *
     * 获取所有模块
     */
    public static function getModules($guard,User $user = null,$menu = false,$status = false)
    {
        dd(app(PermissionRegistrar::class)->getPermissions());
        $collection = (new Collection(app(PermissionRegistrar::class)->getPermissions()))->sortByDesc('sorts')->where('guard_name',$guard);

        $menu && $collection = $collection->where('is_menu',$menu);
        $status && $collection = $collection->where('status',$status);

        return $collection->filter(function($item) use($user,$guard){
            if($user == null || $user->id == config('app.super_id') || $user->hasPermissionTo($item['name'],$guard)){
                return true;
            }else{
                return false;
            }
        })->buildTree('parent_id', 'node');
    }
}