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
    public static function getModules($guard = [],User $user = null)
    {
        return (new Collection(app(PermissionRegistrar::class)->getPermissions()))->sortByDesc('sorts')->whereIn('guard_name',$guard)->filter(function($item) use($user){
            if($user == null || $user->id == env('SUPER_ID',0) || $user->can($item['name'])){
                return true;
            }else{
                return false;
            }
        })->buildTree('parent_id', 'node');
    }
}