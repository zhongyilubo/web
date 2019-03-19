<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;

class PremissionController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.product.goods.';
    }

    public function index(Request $request){
dd('dfg');
        return view( $this->template. __FUNCTION__);
    }
}