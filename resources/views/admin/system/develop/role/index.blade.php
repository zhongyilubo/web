@extends('admin.layout.main')
@section('title')
    -Premission
@stop
@section('content')

    <div class="content_ch">

        <!--warp bengin-->
        <!--内容区 bengin-->
        <div class="admin_info clearfix">
            <!--right bengin-->
            <ul class="nav_pills mb10 clearfix">
                <li @if(!request('guard') || request('guard') == 'admin') class="selected" @endif><a href="{{url('system/develop/role')}}">系统角色</a></li>
                <li @if(request('guard') == 'tenant') class="selected"@endif><a href="{{url('system/develop/role')}}?guard=tenant">租客角色</a></li>
                <a class="btn btn_r" href="{!! url('system/develop/role/create') !!}?guard={{$guard}}">新增角色</a>
            </ul>
            <div class="mainbox">
                <!--tab 切换1 bengin-->
                <div class="form-horizontal t_g_list mt10 clearfix">
                    <!--table 列表 bengin-->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="20%">显示名称</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($lists as $lv)
                                <tr>
                                    <td>asd</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">暂时没有任何数据！</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if(!$lists->isEmpty())
                        {!! $lists->appends(request()->all())->render('admin.layout.page') !!}
                    @endif
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
        var __seajs_debug = 1;
        seajs.use("/admin/js/app.js", function (app) {
            app.bootstrap();
        });

    </script>
@stop