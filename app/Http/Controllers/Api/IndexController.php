<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 21:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Gds\GdsGood;
use App\Resources\Gds\GdsGood as GdsGoodRescource;

class IndexController extends InitController
{
    public function index(){
        $conf = @file_get_contents('banner.txt');
        $banner = $conf ? json_decode($conf,true):[];

        return $this->success('success',null,[
            'banner' => $banner,
            'hot' => GdsGoodRescource::collection(GdsGood::paginate()),
            'new' => new GdsGoodRescource(GdsGood::find(3)),
        ]);
    }
}