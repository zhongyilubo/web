@extends('admin.layout.main')
@section('title')
    -User
@stop
@section('content')
    <div class="content_ch">
        <!--warp bengin-->
        <!--内容区 bengin-->
        <div class="admin_info clearfix">
            <!--right bengin-->
            <ul class="nav_pills mb10 clearfix">
                <li><a href="{{url('system/maintain/user')}}">员工</a></li>
                <li class="selected"><a href="javascript:;">登录密码</a></li>
            </ul>
            <div class="mainbox">
                <form  action="{{url('system/maintain/user/password',['id'=>$account['id']])}}" name="password-form" class="base_form" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-xs-2 t_r"><span class="red">*</span>用户名：</label>
                        <div class="col-xs-6">
                           {{$account['name'] or ''}}
                        </div>
                    </div>
                    @if($account['id'] == auth('tenant')->user()['id'])
                    <div class="form-group">
                        <label class="col-xs-2 t_r"><span class="red">*</span>旧密码：</label>
                        <div class="col-xs-6">
                            <input type="password" class="form-control" id="oldpw" placeholder="旧密码" name="data[old_password]">
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-xs-2 t_r"><span class="red">*</span>新密码：</label>
                        <div class="col-xs-6">
                            <input type="password" class="form-control" id="newpw" placeholder="新密码" name="data[password]" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 t_r"><span class="red">*</span>确认新密码：</label>
                        <div class="col-xs-6">
                            <input type="password" class="form-control" id="confpw" placeholder="确认新密码" name="data[password_confirmation]">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 t_r">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="submit" class="btn" value="提交">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--right end-->
    </div>
@stop
@section('script')
    <script>
        var __seajs_debug = 1;
        seajs.use("/admin/js/app.js", function (app) {
            app.bootstrap();
        });

    </script>
@stop