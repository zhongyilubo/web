<?php

namespace App\Http\Controllers\Admin\Index;


use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;

class IndexController extends InitController
{
    public function index(Request $request){
        return 'duanzhiwei';
    }
}