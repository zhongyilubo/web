@extends('admin.layout.main')
@section('title')
    -User
@stop
@section('content')
    <div class="content_ch">
        <div class="admin_info clearfix">
            <ul class="nav_pills mb10 clearfix">
                <li><a href="{{url('system/maintain/user')}}">员工管理</a></li>
                <li class="selected">权限设置</li>
            </ul>
            <div class="mainbox">
                <div class="col-xs-2">
                        <span class="btn btn_white col-xs-12 mt10 mb20 dollyEdit">用户:{{$account['name']}}</span>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr class="td_center">
                                <td>权限列表</td>
                            </tr>
                            </thead>
                            <tbody class="category_type_wrap">
                            @foreach($roles as $role)
                                <tr  class="category_type tree1" >
                                    <td class="td_center">
                                            <span>
                                                <input type="checkbox" name="role"  @if($account->hasRole($role['name']))) checked @endif value="{{$role['id']}}" href="{{url('system/maintain/user/autorole',['user'=>$account['id']])}}" class="js_role" >
                                                {{$role['display_name']}}
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                <ul class="order-set tabs" style="margin-left: 18%;width: 79%">
                    <li class="tab-ord-1 @if(!request()->has('type')) basic-setup @endif" >
                        <a href="{!! url('system/maintain/user/auth',['user'=>$account['id']]) !!}"  >功能列表</a>
                    </li>
                </ul>
                <form name="profile-form" class="base_form" method="post" class="mtb20" >
                    {!! csrf_field() !!}
                    <div class="col-xs-10">
                        <div class="form-group mb10">
                            <table>
                                <tbody>
                                @foreach($modules as $module)
                                    <tr class="crole-parent">
                                        <td class="w160 ml20 fl">
                                            <label>
                                                <div class="all-checked fl pr10" style="margin-top:11px;">
                                                    <input type="checkbox" value="{!! $module['id'] !!}" data-id="{!! $module['id'] !!}">
                                                    <i class="layui-icon layui-icon-ok"></i>
                                                </div>
                                               <span>{{$module['product_name']}} - {!! $module['display_name'] or ''  !!}</span>
                                            </label>
                                        </td>
                                    </tr>
                                    @if(!$module->children->isEmpty())
                                        <tr class="crole-children">
                                            @foreach($module->children  as $child)
                                                <td class="w160 ml20 fl">
                                                    <label>
                                                        <div class="all-checked fl pr10" style="margin-top:3px;">
                                                            <input type="checkbox" value="{!! $child['name'] !!}" data-id="{!! $child['id'] !!}" data-parent="{!! $child['parent_id'] !!}" data-depend="{{$child['depend'] or 0}}"
                                                               data-key="{!! $child['name'] !!}"  name="permissions[]"  @if(in_array($child['name'],$permissions)) checked @endif>
                                                            <i class="layui-icon layui-icon-ok"></i>
                                                        </div>
                                                        {!! $child['display_name'] !!}
                                                    </label>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
                    <div class="form-group">
                        <label class="col-xs-2 t_r">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="submit" class="btn w160" value="保存功能">
                        </div>
                    </div>
              </form>
            <!--right end-->
        </div>
        <!--内容区 end-->
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