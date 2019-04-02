@extends('admin.layout.alert')
@section('title')
    -Index
@stop
@section('content')
    <link rel="stylesheet" href="/admin/css/upload.css">
    <div class="content">
        <div class="content-bd">
            <div class="content-bd-warp">
                <div class="img-con">
                    <div class="img-container">
                        <div class="img-container-toolbar">
                            <div class="toolbar-left">
                                <button id="toupload" class="el-blue">
                                    <i class="iconfont icon-wenjian"></i>
                                    <span>点击上传</span>
                                </button>
                                <button type="button" class="btn-default">
                                    <span>新建文件夹</span>
                                </button>
                            </div>
                            <div class="toolbar-search">
                                <input type="text" placeholder="按文件夹/图片名称搜索">
                                <i class="iconfont icon-sousuo_sousuo"></i>
                            </div>
                        </div>
                        <div class="img-row-layout" flex="dir:top">
                            <div class="img-row" id="parent_dir" data-parent="0">

                                <div class="folder-item-box" data-id="145">
                                    <div>
                                        <i class="icon-wenjianjia1 iconfont"></i>
                                        <p>阿萨德啊</p>
                                    </div>
                                </div>

                                <div class="img-item-box">
                                    <img src="/storage/admin/1/2019/03/26/1553568396_5c99928c9e0d5.jpg">
                                    <p>图层3.jpg</p>
                                    <i class="iconfont img-mark icon-fuxuankuang1"></i>
                                </div>

                            </div>

                            <div id="scroll-add-more">
                                <div class="preloader">下拉加载更多！</div>
                            </div>
                            <div id="infinite-scroll-preloader">
                                <div class="preloader">玩命加载中！
                                </div>
                            </div>
                            <div id="scroll-add-end">
                                <div class="preloader">这回真没有了！</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="upload-img-con">
                    <div class="img_up_load">
                        <div class="local-img-con">
                            <label>本地资源:</label>
                            <div id="ossfile" class="local-img-box">
                                你的浏览器不支持flash,Silverlight或者HTML5！
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-ft">
                    <button class="el-blue btn-primary">保存</button>
                    <button class="el-cancel btn-default">取消</button>
                </div>

                <div id="container" class="content-fl">
                    <button id="selectfiles" class="el-blue btn-primary" hidden>选择文件</button>
                    <button id="postfiles" class="el-blue btn-primary">开始上传</button>
                    <button class="btn-default" id="backtoface">返回</button>
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
            app.load('system/base/alert/oss');
            app.load('core/oss');
        });

    </script>
@stop