<?php

namespace App\Http\Controllers\Admin\Product\Manage;


use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;

class GoodsController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.product.manage.goods.';
    }

    public function index(Request $request){

        return view( $this->template. __FUNCTION__);
    }
}