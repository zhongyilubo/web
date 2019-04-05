<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/24
 * Time: 22:21
 */

namespace App\Http\Controllers\Admin\Product\Manage;

use App\Http\Controllers\Admin\InitController;
use Illuminate\Support\Facades\Validator;
use App\Models\System\SysCategory;
use Illuminate\Http\Request;

class CategoryController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.product.manage.category.';
    }

    public function index(Request $request,SysCategory $category = null){

        $lists = SysCategory::getCategorys(SysCategory::TYPE_PRODUCT);
        return view( $this->template. __FUNCTION__,compact('lists'));
    }

    public function create(Request $request,SysCategory $model = null){

        if($request->isMethod('get')) {
            return view($this->template . __FUNCTION__, compact('model'));
        }

        $data = $request->data;

        $rules = [
            'name' => 'required|unique:sys_categories,name,'.($category['id'] ?? 'NULL').',id,',
        ];
        $messages = [
            'name.required' => '请输入分类名称',
            'name.unique' => '分类已存在',
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), null, true);
        }

        try {
            SysCategory::saveBy([
                'id' => $category['id'] ?? null,
                'name' => $data['name'],
                'parent_id' => $data['parent_id'],
                'img' => $data['img'] ?? '',
                'sorts' => $data['sorts'] ?? 0,
                'type' => SysCategory::TYPE_PRODUCT,
                'status' => SysCategory::STATUS_OK,
            ]);
            return $this->success('操作成功',url('product/manage/category'));
        }catch (\Exception $e) {
            return $this->error('操作异常，请联系开发人员'.$e->getMessage());
        }
    }
}