<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/3/22
 * Time: 7:00
 */

namespace App\Http\Controllers\Admin\System\Develop;

use App\Http\Controllers\Admin\InitController;
use App\Models\User;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends InitController
{
    public function __construct()
    {
        $this->template = 'admin.system.develop.user.';
    }

    /**
     * @param Request $request
     * @return mixed
     * 列表
     */
    public function index(Request $request){
        $type = $request->type ?? User::USER_TYPE_ADMIN;
        $lists = User::where('type',$type)->paginate(self::PAGESIZE);
        return view( $this->template. __FUNCTION__,compact('lists','type'));
    }

    /**
     * @param Request $request
     * @param User|null $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * 创建员工信息
     */
    public function create(Request $request, User $model = null)
    {
        $type = $request->type ?? 1;

        if($request->isMethod('get')) {

            $tenants = User::where([
                'type' => User::USER_TYPE_TENANT,
                'status' => User::USER_STATUS_OPEN,
            ])->get();

            return view($this->template.__FUNCTION__ ,compact('model','tenants','type'));
        }
        $data = $request->get('data');

        $rules = [
            'name' => 'required',
            'mobile'=>[
                'required',
                'unique:users,mobile,'.($model['id'] ?? 'NULL').',id',
                new Mobile()
            ],
        ];

        $messages = [
            'name.required' => '请输入员工姓名',
            'mobile.required'=>'请输入员工手机号码',
            'mobile.unique'=>'该手机号码已存在,请更换手机号',
        ];

        $type == User::USER_TYPE_STAFF && $rules['tenant_id'] = 'required|exists:users,id';
        $type == User::USER_TYPE_STAFF && $messages['tenant_id.required'] = '缺少租客信息' && $messages['tenant_id.exists'] = '租客信息不存在';


        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            return $this->error($validator->errors()->first());
        }

        try{

            if(!empty($model->id)) {
                $model->name = $data['name'];
                $model->mobile = $data['mobile'];
                $model->job_number = $data['job_number'];
                $model->email = $data['email'];
                $model->birthday = $data['birthday'];
                $model->gender =  $data['gender'];
                $model->status = $data['status'];
                $model->save();
            } else {
                $data['type'] = $type;
                $data['password'] = \Hash::make(env('DEFAULT_PASSWD',12345678));
                User::saveBy($data);
            }

            return $this->success('创建/编辑员工完成',url('/system/develop/user').'?type='.$type);
        }catch (\Exception $e) {
            return $this->error($e->getMessage());
        }

    }
}