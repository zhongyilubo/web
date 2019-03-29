/**
 * Created by Administrator on 2018/3/14/014.
 */
/**
 * Created by py on 2017/6/12.
 */
define(function (require, exports, module) {
    var e = function (e, s) {
        $('.image-upload-add').on('click',function () {
            //保证盒子的唯一性
            localStorage.upImg=$(this).data('class');
            //获取上传图片的目录位置
            localStorage.upFile = $(this).data('file');
            //上传图片name
            localStorage.upName = $(this).data('name');
            //上传数量
            localStorage.upNum = $(this).data('num');
            message.img();
        });
    };
    exports.bootstrap = function (s, a) {
        $(e(s, a))
    }
});
