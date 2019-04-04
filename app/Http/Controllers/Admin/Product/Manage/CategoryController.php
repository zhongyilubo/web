<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/24
 * Time: 22:21
 */

namespace App\Http\Controllers\Admin\Product\Manage;

use App\Http\Controllers\Admin\InitController;
use App\Models\System\SysCategory;
use Illuminate\Http\Request;

class CategoryController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.product.manage.category.';
    }

    public function index(Request $request){

        $lists = SysCategory::getCategorys(SysCategory::TYPE_PRODUCT);
        return view( $this->template. __FUNCTION__,compact('lists'));
    }

    public function create(Request $request,SysCategory $model = null){

        if($request->isMethod('get')) {
            return view($this->template . __FUNCTION__, compact('model'));
        }

        $data = $request->data;

        $rules = [
            'name' => 'required|unique:sys_permissions,name,'.($permission['id'] ?? 'NULL').',id,',
            'display_name' => 'required',
        ];
        $messages = [
            'name.required' => '请输入权限名称',
            'name.unique' => '节点已存在',
            'display_name.required' => '请输入权限显示',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), null, true);
        }

        try {
            if(!empty($permission->id)) {
                $permission->name = $data['name'];
                $permission->display_name = $data['display_name'];
                $permission->parent_id = $data['parent_id'];
                $permission->icon_class = $data['icon_class'];
                $permission->status = $data['status'];
                $permission->is_menu =  $data['is_menu'];
                $permission->sorts = $data['sorts'];
                $permission->save();
            } else {
                $data['guard_name'] = $guard;
                SysPermission::create($data);
            }
            return $this->success('创建模块完成',url('system/develop/permission').'?guard=' . $guard);
        }catch (\Exception $e) {
            return $this->error('创建模块异常，请联系开发人员'.$e->getMessage());
        }
    }
}