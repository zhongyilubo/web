@extends('admin.layout.main')
@section('title')
-Index
@stop
@section('content')

    <div class="content_ch">
        <!--warp bengin-->
        <!--内容区 bengin-->
        <div class="admin_info clearfix">
            <div class="nav_title">
                <ul class="nav_pills mb10 clearfix">
                    <li class="selected">导购客户</li>
                </ul>
            </div>
            <!--right bengin-->
            <div class="mainbox width-change">
                <form method="get" name="search">
                    <input name="system_tag" value="" hidden="">
                    <input name="tag" value="" hidden="">
                    <div class="Client-list-head clearfix layui-form" id="layerDemo">
                        <button type="button" data-method="fansAddTag" class="btn btn-primary label-btn">打标签</button>
                        <button type="button" data-method="fansDistribution" data-url="http://tenant.ftcy.cc/store/guide/user/allot" class="btn btn-primary label-btn">粉丝指配</button>
                        <div class="fr" style="width:75%;">
                            <div class="col-xs-2 pd010">
                                <select name="store" class="form-control" id="store" lay-filter="stores">
                                    <option value="">选择门店</option>
                                    <option value="4">M测试店</option>
                                </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="选择门店" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">选择门店</dd><dd lay-value="4" class="">M测试店</dd></dl></div>
                            </div>
                            <div class="col-xs-2 pd010" id="guide">
                                <select name="guide" class="form-control">
                                    <option value="">全部导购</option>
                                    <option value="0">未绑定粉丝</option>
                                    <option data-store="4" value="9">A</option>
                                </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="全部导购" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">全部导购</dd><dd lay-value="0" class="">未绑定粉丝</dd><dd lay-value="9" class="">A</dd></dl></div>
                            </div>
                            <div class="col-xs-2 pd010">
                                <select name="type" class="form-control">
                                    <option value="">全部粉丝</option>
                                    <option value="1">粉丝</option>
                                    <option value="0">意向客户</option>
                                </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="全部粉丝" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">全部粉丝</dd><dd lay-value="1" class="">粉丝</dd><dd lay-value="0" class="">意向客户</dd></dl></div>
                            </div>
                            <div class="col-xs-2 pd010">
                                <input type="text" name="name" class="form-control" placeholder="输入手机号/客户姓名" value="">
                            </div>
                            <div class="col-xs-1 pd010"><input type="submit" class="btn btn-default" value="搜索"></div>
                        </div>
                    </div>
                </form>
                <div class="clearfix mt20">
                    <div class="left-content-box width-change base-form-style-no fl">
                        <table class="user-table">
                            <tbody><tr>
                                <th>
                                    <div class="all-checked">
                                        <input type="checkbox" name="alluser">
                                        <i class="layui-icon layui-icon-ok"></i>
                                    </div>
                                </th>
                                <th>客户</th>
                                <th>类型</th>
                                <th>所属门店</th>
                                <th>所属导购</th>
                                <th>操作</th>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <div class="all-checked stylecheckbox">
                                        <input type="checkbox" name="fans[]" value="192">
                                        <i class="layui-icon layui-icon-ok"></i>
                                    </div>
                                </td>
                                <td>
                                    <img src="http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKWeRGOr8b1XpZ6iajfoPfiavC9xYAk1rWOfp9vMCIzvhdtHoLiaeWlDj4N0k20WjJWpCyzeqWn47KHg/132" class="img-head">
                                    <p></p>
                                    <p>真实姓名: </p>
                                    <p>手机号：</p>
                                </td>
                                <td>粉丝</td>
                                <td>M测试店</td>
                                <td>A</td>
                                <td class="To-view c-blue t_t"><a href="http://tenant.ftcy.cc/store/guide/user/create/192" class="c-blue">编辑</a></td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <div class="all-checked stylecheckbox">
                                        <input type="checkbox" name="fans[]" value="191">
                                        <i class="layui-icon layui-icon-ok"></i>
                                    </div>
                                </td>
                                <td>
                                    <img src="/admin/images/default.png" class="img-head">
                                    <p>朱希顺</p>
                                    <p>真实姓名: 朱希顺</p>
                                    <p>手机号：18611570121</p>
                                </td>
                                <td>意向客户</td>
                                <td>M测试店</td>
                                <td></td>
                                <td class="To-view c-blue t_t"><a href="http://tenant.ftcy.cc/store/guide/user/create/191" class="c-blue">编辑</a></td>
                            </tr>
                            <tr>
                            </tr>
                            </tbody></table>
                        <!-- 打标签弹窗 -->
                        <div class="seal-modal" id="addTags" hidden="">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form id="tag-form" class="base_form_add" method="post" action="http://tenant.ftcy.cc/store/guide/user/tag">
                                            <input type="hidden" name="data[store]" value="">
                                            <div class="r-5x bg-white wrapper-md dialog-border layui-form">
                                                <!--  手动标签  -->
                                            </div>
                                            <div class="layui-layer-btn layui-layer-btn-c">
                                                <button class="layui-layer-btn0 submit-add">确认</button><a class="layui-layer-btn1 js-del-tag">取消</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                        <!-- 粉丝分配弹窗 -->
                        <div class="seal-modal" id="str-distribution" hidden="">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="fans-modal">
                                            <div class="line-div"><p>迁移导购粉丝数：<b class="c-blue" id="fans_total"></b>人</p></div>
                                            <form id="allot-form" action="http://tenant.ftcy.cc/store/guide/user/allot" class="layui-form base_form" method="post">
                                                <input type="hidden" name="_token" value="ygzKLKTQlNFSzx1dsNPMN7Chp0dkGq6P65sSyTNB">
                                                <div class="form-group mb10">
                                                    <label class="col-xs-3 t_r line-div"><span class="red"></span>导购门店：</label>
                                                    <div class="col-xs-6">
                                                        <select name="data[store]" class="form-control Serial-input" lay-filter="popstores">
                                                            <option value="">请选择门店</option>
                                                            <option value="4">M测试店</option>
                                                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择门店" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">请选择门店</dd><dd lay-value="4" class="">M测试店</dd></dl></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb10">
                                                    <label class="col-xs-3 t_r line-div"><span class="red"></span>目标导购：</label>
                                                    <div class="col-xs-6" id="popguide">
                                                        <select name="data[guide]" class="form-control Serial-input">
                                                            <option value="">请选择</option>
                                                            <option data-store="4" value="9">A</option>
                                                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="" class="layui-select-tips">请选择</dd><dd lay-value="9" class="">A</dd></dl></div>
                                                    </div>
                                                </div>
                                                <div class="layui-layer-btn layui-layer-btn-c">
                                                    <button class="layui-layer-btn0  submit">确认</button><a class="layui-layer-btn1 js-del-tag">取消</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 粉丝分配弹窗 end -->
                        <!-- 分页 -->
                        <div class="paging-box">

                        </div>
                    </div>
                    <div class="right-aside fr">
                        <div class="all-users-title">
                            <h4><a href="http://tenant.ftcy.cc/store/guide/user">全部粉丝<span>（2）</span></a></h4>
                        </div>
                    </div>
                </div>

            </div>
            <!-- page end -->
            <!--right end-->
        </div>
        <!--内容区 end-->
    </div>

@stop
@section('script')
<script>
    var __seajs_debug = 0;
    seajs.use("/admin/js/app.js", function (app) {
        app.context.user = {login: 9};
        app.bootstrap();
        app.load('index/index');
    });

</script>
@stop