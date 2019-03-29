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
}