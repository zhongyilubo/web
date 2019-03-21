@extends('tenant.layout.main')
@section('title')-员工管理@stop
@section('content')
    <div class="content_ch">
        <div class="admin_info clearfix">
            <ul class="nav_pills mb10 clearfix">
                <li class="selected"><a href="{{url('system/maintain/user')}}">员工管理</a></li>
                <a class="btn btn_r" href="{{url('system/maintain/user/create')}}">+ 创建员工</a>
            </ul>
            <div class="mainbox">
                <!--tab 切换1 bengin-->
                <div class="form-horizontal">
                    <!--table 列表 bengin-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="8%">用户名</th>
                                <th width="5%">
                                    <select id="js_status">
                                        <option  value="{{url('system/maintain/user')}}" @if(!request()->has('status')) selected @endif>状态</option>
                                        <option  value="{{url('system/maintain/user')}}?status=0" @if(request('status') === '0') selected @endif>停止</option>
                                        <option  value="{{url('system/maintain/user')}}?status=1"  @if(request('status') == '1') selected @endif>正常</option>
                                    </select>
                                </th>
                                <th width=5%">类型</th>
                                <th width=5%">登录</th>
                                <th width="15%">部门</th>
                                <th width="15%">权限组</th>
                                <th width="10%">移动电话</th>
                                <th width="20%">邮箱</th>
                                <th width="10%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($lists))
                                @foreach($lists as $lv)
                                    <tr>
                                        <td>{{$lv['name'] or  ''}}</td>
                                        <td>
                                            <select class="js_status" href="{{url('system/maintain/user/upstatus',['type'=>'status','id'=>$lv['id']])}}" @if($lv['type'] & 2) disabled="" @endif>
                                                <option  @if($lv['status'] === 0) selected @endif value="0">停止</option>
                                                <option  @if($lv['status'] === 1) selected @endif  value="1">正常</option>
                                            </select>
                                        </td>
                                        <td>{{$lv['type'] & 2 ? '租客':'员工'}}</td>
                                        <td> {{!empty($lv['password']) ? '是':'否'}}</td>
                                        <td>{{$lv->group->name or '----'}}</td>
                                        <td>
                                            @if($lv['type'] & $tenant)所有权限 @endif
                                            @if($lv['type'] & $staff)
                                                {{$lv->roles->implode('display_name',',')}}
                                            @endif
                                        </td>
                                        <td>{{$lv['mobile'] or  ''}}</td>
                                        <td>{{$lv['email'] or  ''}}</td>
                                        <td>
                                            <a href="{!! url('system/maintain/user/create',['user'=>$lv['id']]) !!}">编辑</a>
                                            <a href="{{url('system/maintain/user/password',['user'=>$lv['id']])}}">密码</a>
                                            @if($lv['type'] & 4)
                                                <a href="{!! url('system/maintain/user/auth',['user'=>$lv['id']]) !!}">权限</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if($lists->isEmpty())
                                <tr>
                                    <td colspan="9">暂时没有任何数据！</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!--table 列表 end-->
                    <!--分页 bengin-->
                @if(!$lists->isEmpty())
                    {!! $lists->render('vendor/pagination/admin') !!}
                @endif
                <!--分页 end-->
                </div>
                <!--tab 切换1 end-->
            </div>
            <!--right end-->
        </div>
        <!--内容区 end-->
    </div>
@stop
@section('script')
    <script>
        var __seajs_debug = 0;
        seajs.use("/admin/bundles/app.js", function (app) {
            app.context.user = {login: {!! auth('tenant')->user()->getAuthIdentifier()!!}};
            app.bootstrap();
            app.load('core/auto');
        });
    </script>
@stop