<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 21:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Gds\GdsGood;

class IndexController extends InitController
{
    public function index(){
        $conf = @file_get_contents('banner.txt');
        $banner = $conf ? json_decode($conf,true):[];

        return $this->response->array([
            'banner' => $banner,
            'hot'   => GdsGood::orderBy('sorts','desc')->take(3)->get(),
            'new'   => GdsGood::orderBy('created_at','desc')->take(6)->get(),
        ]);
    }
}