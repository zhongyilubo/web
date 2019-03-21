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
            if($(this).is(':checked')){//向上
                upselect($(this),$(this).data('key'));
            }else{//向下
                downtake($(this),$(this).data('key'));
            }
            if ($(this).parents('.crole-children').find('input:checked').length > 0) {
                $(this).parents('.crole-children').prev('.crole-parent').find('input').prop('checked', true);
            } else {
                $(this).parents('.crole-children').prev('.crole-parent').find('input').prop('checked', false);
            }
        });

        function upselect(_this,name) {
            var str = decodeURI(name.substring(0, name.lastIndexOf("\.")));
            _this.parents('.crole-children').find('input[data-key="'+str+'"]').prop('checked', true);
        }

        function downtake(_this,name) {
            _this.parents('.crole-children').find('input[data-key^="'+name+'"]').prop('checked', false);
        }
    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});