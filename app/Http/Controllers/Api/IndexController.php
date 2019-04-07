<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 21:36
 */

namespace App\Http\Controllers\Api;


class IndexController extends InitController
{
    public function index(){
        return ['sdfsd' => 1234];
    }
}