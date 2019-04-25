<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 21:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Gds\GdsGood;
use App\Models\System\SysCategory;
use App\Models\User\UserIntegralLog;
use App\Resources\Gds\GdsGood as GdsGoodRescource;
use App\Resources\System\SysCategory as SysCategoryRescource;
use App\Resources\User as UserResource;

class IndexController extends InitController
{
    public function index(){
        $conf = @file_get_contents('banner.txt');
        $banner = $conf ? json_decode($conf,true):[];

        return $this->success('success',null,[
            'banner' => $banner,
            'hot' => GdsGoodRescource::collection(GdsGood::whereHas('skus')->orderBy('sorts','DESC')->take(2)->get()),
            'new' => GdsGoodRescource::collection(GdsGood::whereHas('skus')->orderBy('id','DESC')->take(4)->get()),
        ]);
    }

    public function category(){
        $category = SysCategory::where('status',1)->where('parent_id',0)->get();

        return SysCategoryRescource::collection($category);
    }

    /**
     * 我的积分
     */
    public function integral(){
        $user = \Auth::user();

        $logs = UserIntegralLog::where('user_id',$user->id)->where('status',1)->orderBy('id','DESC')->get();
        return $this->success('success',null,[
            'user' => new UserResource($user),
            'lists' => UserResource\UserIntegralLog::collection($logs),
        ]);
    }

    /**
     * 删除积分记录
     */
    public function integralDelete(UserIntegralLog $model = null){
        if(!$model){
            return $this->error('no exist');
        }
        $model->status = 0;
        $model->save();
        return $this->success('success');
    }
}