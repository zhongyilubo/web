define(function(require, exports, module) {
    var layuiCss = require('layui.css');
    var layuiJS = require('layui');
    layui.use(['form', 'layedit', 'laydate','layer'], function () {
        var form = layui.form;
        form.render();
    });
    var t = function(e,i) {
        $('.crole-parent input').change(function() {
            $(this).parents('.crole-parent').next('.crole-children').find('input').prop('checked', this.checked);
        })
        $('.crole-children input').change(function() {
            var l = $(this).data('depend'),
                n = this.checked;
            $(this).parents('.crole-children').find('input').each(function(i, v) {
                if ($(v).data('id') == l) {
                    $(v).prop('checked', n);
                }
            })
            if ($(this).parents('.crole-children').find('input:checked').length > 0) {
                $(this).parents('.crole-children').prev('.crole-parent').find('input').prop('checked', true);
            } else {
                $(this).parents('.crole-children').prev('.crole-parent').find('input').prop('checked', false);
            }
        })
    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});