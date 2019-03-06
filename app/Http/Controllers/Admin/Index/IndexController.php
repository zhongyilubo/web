<?php

namespace App\Http\Controllers\Admin\Index;


use App\Http\Controllers\Admin\InitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends InitController
{
    public function __construct()
    {

    }

    public function index(Request $request){

//        dd(Route::currentRouteName());
        return view( 'admin.index.'. __FUNCTION__);
    }
}