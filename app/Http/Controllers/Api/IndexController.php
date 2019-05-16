<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 21:36
 */

namespace App\Http\Controllers\Api;


use App\Models\Gds\GdsGood;
use App\Models\Gds\GdsSku;
use App\Models\Ord\OrdOrder;
use App\Models\User\UserCallback;
use App\Models\User\UserMessage;
use App\Models\User\UserShare;
use App\Services\PayService;
use Illuminate\Http\Request;
use App\Models\System\SysCategory;
use App\Models\User\UserIntegralLog;
use App\Resources\Gds\GdsGood as GdsGoodRescource;
use App\Resources\Gds\GdsSku as GdsSkuRescource;
use App\Resources\System\SysCategory as SysCategoryRescource;
use App\Resources\User as UserResource;
use Illuminate\Support\Facades\Validator;
use App\Resources\User\UserMessage as UserMessageRescource;

class IndexController extends InitController
{
    public function __construct(PayService $payService)
    {
        $this->payService = $payService;
    }

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

    /**
     * tel
     */
    public function tel(){
        $conf = @file_get_contents('tel.txt');
        $model = $conf ? json_decode($conf,true):[];
        return $this->success('success',null,$model);
    }

    /**
     * buy 购买详情
     */
    public function buy(Request $request){
        $user = \Auth::user();
        $cid = $request->cid ?? 0;
        $data = GdsGood::whereHas('order',function ($query) use ($user){
            $query->where('user_id',$user->id);
        });
        $cid && $data = $data->where('category_id',$cid);
        return $this->success('success',null,GdsGoodRescource::collection($data->get()));
    }

    /**
     * 积分规则
     */
    public function rule(){
        $conf = @file_get_contents('score.txt');
        $model = $conf ? json_decode($conf,true):[];
        return $this->success('success',null,$model);
    }

    /**
     * 清除缓存
     */
    public function clearcatch(){
        sleep(2);
        return $this->success('清除成功');
    }

    /**
     * 消息通知
     */
    public function message(){
        $user = \Auth::user();
        return $this->success('success',null,[
            'type' => $user->job_number == 1 ? 1:0
        ]);
    }

    public function changemessage(Request $request){
        $user = \Auth::user();

        if(!isset($request->type)){
            return $this->error('缺少状态参数');
        }
        $user->job_number = $request->type ?? 0;
        $user->save();
        return $this->success('success');
    }

    public function question(Request $request){

        $data = [
            'content' => $request->content,
            'mobile' => $request->mobile,
            'name' => $request->name,
        ];

        $rules = [
            'content' => 'required',
            'mobile' => 'required',
            'name' => 'required',
        ];
        $messages = [
            'name.required' => '请输入姓名',
            'content.required' => '请输入问题',
            'mobile.required' => '请输入联系方式',
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return $this->error($validator->errors()->first(), null, true);
        }
        $user = \Auth::user();

        UserCallback::saveBy([
            'user_id' => $user->id ?? 0,
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'content' => $data['content'],
        ]);

        return $this->success('提交成功');
    }

    public function mlists(){
        $user = \Auth::user();
        return UserMessageRescource::collection($user->message);
    }

    public function dmessage(Request $request,UserMessage $model = null){
        return new UserMessageRescource($model);
    }

    /**
     * 商品列表
     */
    public function goods(Request $request){
        $cid = $request->cid ?? 0;
        $data = GdsGood::where('id','>',0);
        $cid && $data = $data->where('category_id',$cid);
        return $this->success('success',null,GdsGoodRescource::collection($data->get()));
    }

    public function detail(GdsGood $model = null){
        $model->number++;
        $model->save();
        return $this->success('success',null,new GdsGoodRescource($model));

    }

    public function detailsku(GdsSku $model = null){
        $model->number++;
        $model->save();
        return $this->success('success',null,new GdsSkuRescource($model));
    }

    /**
     * 是否购买/分享
     */
    public function isbuyed(GdsGood $model = null){
        $user = \Auth::user();
        //分享海报
        $conf = @file_get_contents('poster.txt');
        $poster = $conf ? json_decode($conf,true):[];
        //是否支付
        $buys = OrdOrder::where('user_id',$user['id'])->whereHas('items',function ($query)use($model){
            $query->where('spu_id',$model['id']);
        })->get();

        $ispay = ($model->pay == 1 || !$buys->isEmpty())?1:0;

        //是否分享
        $isshare = UserShare::where([
            'user_id' => $user->id ?? 0,
            'spu_id' => $model->id ?? 0,
        ])->first()? 1 :0;
        //逻辑处理

        return $this->success('success',null,[
            'cover' => $poster,
            'ispay' => $ispay,
            'isshare' => $isshare,
        ]);
    }

    public function share(GdsGood $model = null){
        $user = \Auth::user();
        UserShare::firstOrCreate([
            'user_id' => $user->id ?? 0,
            'spu_id' => $model->id ?? 0,
        ]);
        return $this->success('success',null,$user);
    }

    public function pay(GdsGood $model = null){

        if($model->pay == 2){//weixin
            return $this->weixin($model);
        }else if($model->pay == 3){//jifen
            return $this->jifen($model);
        }else{
            return $this->error('免费视频不用支付');
        }
    }

    protected function weixin(GdsGood $model){
        $user = \Auth::user();

        return $this->payService->pay([
            'openid' => $user->openid
        ]);
    }

    protected function jifen(GdsGood $model){
        $user = \Auth::user();
        $buyIntegral = $model->price;
        $hasIntegral = $user->integral ?? 0;
        if($buyIntegral > $hasIntegral){
            return $this->error('积分不足');
        }
    }

    public function callback(Request $request){
        $options = file_get_contents('php://input');
        $options = (array)simplexml_load_string($options, 'SimpleXMLElement', LIBXML_NOCDATA);
        info($options);
        echo 'success';
    }
}