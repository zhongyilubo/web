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
            list_loading = false,page = 1,$('#parent_dir').html(''),is_over = false;
            load_more_msg();
        });
        $('.content-ft .el-cancel').click('click', function() {
            parent.layer.close(index); //执行关闭
        });

        $(document).on('click','.folder-item-box',function () {
            window.location.href = '/system/alert/oss?parent='+$(this).data('id')
        })

        //添加文件夹
        $('#mkdir').on('click', function() {
            $('.add-new-file input').val('');
            layer.open({
                id: 'new-fil',
                skin: 'img-space-layer',
                title: '设置文件夹名称',
                type: 1,
                area: ['400px', '200px'], //宽高
                content: $('#add-new-file'),
                btn: ['确定', '取消'],
                btn1: function() {
                    fileName = $('#add-new-file input').val();
                    if (fileName.length == 0) {
                        message.error('文件夹名称不能为空！');
                        return false
                    } else if (fileName.length > 20) {
                        message.error('文件夹名称超出限制！');
                        return false
                    } else {
                        $.ajax({
                            url: '/system/alert/oss/mkdir',
                            type: 'POST',
                            data: {
                                viewname:fileName,
                                parent:$('#parent_dir').data('parent')
                            },
                            async: false,
                            dataType:'json',
                            success: function(data){
                                if(data.status){
                                    message.success('添加成功');
                                    window.location.href = '/system/alert/oss?parent='+$('#parent_dir').data('parent')
                                }else{
                                    message.success('添加失败');
                                }
                            }
                        });
                    };
                }
            })
        });

        function showdoing(index) {
            $('.doing_1,.doing_2,.doing_3').hide();
            $('.doing_'+index).show();
        }

        var list_loading = false,page = 1,is_over = false;

        $('#autobrowse').scroll(function () {
            if (!list_loading){
                load_more_msg();
            }
        });
        load_more_msg();
        function load_more_msg() {
            if(is_over){
                return false;
            }
            if(($('#parent_dir').height() - $('#autobrowse').height()) <= $('#autobrowse').scrollTop()){
                list_loading = true,showdoing(2);
                $.ajax({
                    url: '/system/alert/oss/file/'+$('#parent_dir').data('parent')+'?page='+page,
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        showdoing(1)
                        if(data.data.length <= 0){
                            showdoing(3)
                            return is_over = true;
                        }

                        var str = '';
                        for(var i in data.data){
                            if(data.data[i].type == 1){
                                str += '<div class="folder-item-box" data-id="'+data.data[i].id+'">\
                                    <div>\
                                    <i class="icon-wenjianjia1 iconfont"></i>\
                                    <p>'+data.data[i].title+'</p>\
                                    </div>\
                                    </div>';
                            }else if(data.data[i].type == 2){
                                if (/image\//.test(data.data[i].mime_type)){
                                    str += '<div class="img-item-box">\
                                    <img src="'+data.data[i].host+data.data[i].path+'">\
                                    <p>'+data.data[i].title+'</p>\
                                    <i class="iconfont img-mark icon-fuxuankuang1"></i>\
                                    </div>';
                                }else if(/video\//.test(data.data[i].mime_type)){
                                    str += '<div class="img-item-box">\
                                    <img src="'+data.data[i].host+data.data[i].path+'?x-oss-process=video/snapshot,t_0">\
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
        }

    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});