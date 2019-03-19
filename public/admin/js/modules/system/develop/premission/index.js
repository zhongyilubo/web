define(function(require, exports, module) {
    var layuiCss = require('layui.css');
    var layuiJS = require('layui');
    layui.use(['form', 'layedit', 'laydate','layer'], function () {
        var form = layui.form;
        form.render();
    });
    var t = function(e,i) {

    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});