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

        //加载
        // $.ajax({
        //     url: '/system/base/oss',
        //     data: {},
        //     async: false,
        //     dataType:'json',
        //     success: function(json){
        //         getData = json;
        //     }
        // });
    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});