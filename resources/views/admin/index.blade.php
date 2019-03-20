@extends('admin.layout.main')
@section('title')
    -Index
@stop
@section('content')
    <div class="content_ch" style="width: calc(100% - 111px);margin-left: 101px;">
        <!--欢迎页 开始-->
        <div class="form-group form-welcome-wrap clearfix">
            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 商家管理</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p>入驻商家</p>
                        <b>0</b>
                    </a>
                    <a href="" target="_blank">
                        <p>商家用户</p>
                        <b>0</b>
                    </a>
                    <a href="" target="_blank">
                        <p>入驻门店</p>
                        <b>0</b>
                    </a>
                    <a href="" target="_blank">
                        <p>商家会员</p>
                        <b>0</b>
                    </a>
                </div>
            </div>
            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 待办事项</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p class="text-danger">0</p>
                        <p>待审品牌</p>
                    </a>
                    <a href="" target="_blank">
                        <p class="text-danger"></p>
                        <p>待审商家</p>
                    </a>
                    <a href="" target="_blank">
                        <p class="text-danger"></p>
                        <p>待审门店</p>
                    </a>
                </div>
            </div>
            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 运营管理</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p>友情链接</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>站点管理</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>厨卫百科</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>厨卫新闻</p>
                        <b></b>
                    </a>
                </div>
            </div>
            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 待办事项</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p class="text-danger"></p>
                        <p>发公告</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p class="text-danger"></p>
                        <p>撰写百科</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p class="text-danger"></p>
                        <p>撰写新闻</p>
                        <b></b>
                    </a>
                </div>
            </div>

            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 注册会员</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p>今日新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>昨日新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>本月新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>总数</p>
                        <b></b>
                    </a>
                </div>
            </div>
            <div class="welcome-wrap" style="width:60%">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 微信会员</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p>今日新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>昨日新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>本月新增</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>总数</p>
                        <b></b>
                    </a>
                </div>
            </div>
            <div class="welcome-wrap">
                <div class="welcome-head">
                    <p><i class="iconfont"></i> 订单管理</p>
                </div>
                <div class="welcome-account welcome-member just-center">
                    <a href="" target="_blank">
                        <p>今日订单</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>昨日订单</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>本月订单</p>
                        <b></b>
                    </a>
                    <a href="" target="_blank">
                        <p>总订单</p>
                        <b></b>
                    </a>

                </div>
            </div>

        </div>
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