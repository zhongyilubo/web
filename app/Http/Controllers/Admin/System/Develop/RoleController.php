<?php

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysPermission;
use App\Models\System\SysRole;
use Illuminate\Http\Request;

class RoleController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.system.develop.role.';
    }

    /**
     * @param Request $request
     * @return mixed
     * 列表
     */
    public function index(Request $request){
        $guard = $request->guard ?? config('permission.guard.admin');
        $lists = SysRole::where('guard_name',$guard)->paginate(self::PAGESIZE);
        return view( $this->template. __FUNCTION__,compact('lists','guard'));
    }

    /**
     * @param Request $request
     * @param Role|null $role
     *
     * 创建/编辑权限
     */
    public function create(Request $request,SysRole $model = null)
    {
        $guard = $request->guard ?? config('permission.guard.admin');

        if($request->isMethod('get')) {
            $modules = SysPermission::getModules($guard);
            return view($this->template.__FUNCTION__ ,compact('model','modules','permissions'));
        }

        $permissions = $request->get('permissions');
        $data = $request->get('data');
        $data['guard_name'] = 'tenant';
        try {
            $except =  $model->id ?? 'NULL';
            $rules = [
                'display_name' => 'required',
                'name' => 'required|allow_letter|unique:' . config('permission.table_names.roles').  ',name,' . $except . ',id'
            ];
            $messages = [
                'display_name.required' => '权限显示名称不能为空',
                'name.required' => '权限名称不能为空',
                'name.allow_letter' => '权限名称仅以字母开头,破折号和下划线组合',
                'name.unique' => '权限名称已存在',
            ];
            $validator = Validator::make($data, $rules,$messages);
            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }
            DB::beginTransaction();
            if(!empty($role->id)) {
                $role->display_name = $data['display_name'];
                $role->name = $data['name'];
                $role->tenant_id = $user['tenant_id'];
                $role->save();
            } else {
                $role = Role::create($data);
            }

            if(!empty($permissions)){
                $role->syncPermissions($permissions);
            }
            DB::commit();
            return $this->success('创建角色权限完成',url('system/maintain/role'));
        }catch (\Exception $e) {
            DB::rollback();
            return $this->error('创建角色权限异常'.$e->getMessage());
        }
    }
}