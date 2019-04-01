define(function (require, exports, module) {
    require('plupload');
    var e = function (e, s) {
        //实例化一个plupload上传对象
        var uploader = new plupload.Uploader({
            browse_button: 'selectfiles', //触发文件选择对话框的按钮，为那个元素id
            runtimes: 'html5,flash,silverlight,html4',//兼容的上传方式
            url: "", //后端交互处理地址
            max_retries: 3,     //允许重试次数
            chunk_size: '10mb', //分块大小
            rename: true,  //重命名
            dragdrop: false, //允许拖拽文件进行上传
            unique_names: true, //文件名称唯一性

            filters: { //过滤器
                max_file_size: '1024mb', //文件最大尺寸
                mime_types: [ //允许上传的文件类型
                    { title : "Image files", extensions : "jpg,gif,png,bmp" },
                    { title : "Zip files", extensions : "zip,rar" }
                ]
            },
            // FLASH的配置
            flash_swf_url: "../Scripts/plupload/Moxie.swf",
            // Silverligh的配置
            silverlight_xap_url: "../Scripts/plupload/Moxie.xap",
            //true:ctrl多文件上传, false 单文件上传
            multi_selection: true
        });

        //在实例对象上调用init()方法进行初始化
        uploader.init();
        
        uploader.bind('BeforeUpload',function (up, file) {
            set_upload_param(up)
        });

        //最后给"开始上传"按钮注册事件
        document.getElementById('postfiles').onclick = function(){
            uploader.start(); //调用实例对象的start()方法开始上传文件，当然你也可以在其他地方调用该方法
        }




        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        function set_upload_param(up)
        {
            var request = send_request()
console.log(request);

            up.setOption({
                'url': request['host'],
            });
        }
        function send_request()
        {
            var getData = null;
            $.ajax({
                url: '/system/base/oss',
                data: {},
                async: false,
                success: function(json){
                    getData = json;
                }
            });
            return getData;
        };
    };
    exports.bootstrap = function (s, a) {
        $(e(s, a))
    }
});