define(function(require, exports, module) {
    require('chosen');
    require('layer');

    var t = function(e,i) {
        var index = parent.layer.getFrameIndex(window.name); //获取当前窗体索引

        $('#toupload').click(function () {
            $('.content-bd-warp').animate({
                left:'-100%'
            },300);
        });
        $('#backtoface').click(function () {
            $('.content-bd-warp').animate({
                left:'0'
            },300);
        });
        $('.content-ft .el-cancel').click('click', function() {
            parent.layer.close(index); //执行关闭
        });

        var list_loading = false,page = 1;

        $('#autobrowse').scroll(function () {
            if (!list_loading){
                load_more_msg();
            }
        });
        load_more_msg()
        function load_more_msg() {

            if(($('#parent_dir').height() - $('#autobrowse').height()) <= $('#autobrowse').scrollTop()){
                list_loading = true;
                $.ajax({
                    url: '/system/alert/oss/file?page='+page,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {

                        if(data.data.length <= 0){
                            return $('#autobrowse').unbind('scroll')
                        }

                        var str = '';
                        for(var i in data.data){
                            if(data.data[i].type == 1){
                                str += '<div class="folder-item-box" data-id="145">\
                                    <div>\
                                    <i class="icon-wenjianjia1 iconfont"></i>\
                                    <p>'+data.data[i].title+'</p>\
                                    </div>\
                                    </div>';
                            }else if(data.data[i].type == 2){
                                if (/image\//.test(data.data[i].mime_type)){
                                    str += '<div class="img-item-box">\
                                    <img src="/admin/images/default.png">\
                                    <p>'+data.data[i].title+'</p>\
                                    <i class="iconfont img-mark icon-fuxuankuang1"></i>\
                                    </div>';
                                }else if(/video\//.test(data.data[i].mime_type)){
                                    str += '<div class="img-item-box">\
                                    <img src="/admin/images/default.png">\
                                    <p>'+data.data[i].title+'</p>\
                                    <i class="iconfont img-mark icon-fuxuankuang1"></i>\
                                    </div>';
                                }else{
                                    str += '<div class="img-item-box">\
                                    <img src="/admin/images/default.png">\
                                    <p>'+data.data[i].title+'</p>\
                                    <i class="iconfont img-mark icon-fuxuankuang1"></i>\
                                    </div>';
                                }
                            }
                        }

                        $('#parent_dir').append(str);


                        list_loading = false;
                        page++;
                        if(($('#parent_dir').height() - $('#autobrowse').height()) <= $('#autobrowse').scrollTop()){
                            load_more_msg();
                        }
                    }
                });
            }
            console.log($('#parent_dir').height() + ' - ' + $('#autobrowse').scrollTop() + ' - ' + $('#autobrowse').height());
        }

    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});