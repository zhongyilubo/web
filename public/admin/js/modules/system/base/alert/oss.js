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



        //滚动加载
        var nScrollHight = 0; //滚动距离总长(注意不是滚动条的长度)
        var nScrollTop = 0; //滚动到的当前位置
        var imgRowLayout = $(".img-row-layout");
        var imgRow = $(".img-row");
        var addMore = $('#scroll-add-more');
        var adding = $('#infinite-scroll-preloader');
        var addEnd = $('#scroll-add-end');
        //滚动加载事件
        startScroll();

        function startScroll() {
            var page = 2;
            var loading = false;
            var nDivHight = imgRowLayout.height();
            addMore.hide();
            adding.hide();
            addEnd.hide();
            showAddMore();
            imgRowLayout.scroll(function() {
                nScrollHight = $(this)[0].scrollHeight;
                nScrollTop = $(this)[0].scrollTop;
                if (nScrollHight - nScrollTop <= nDivHight) {
                    // 正在加载或已加载全部，则退出
                    if (loading) return;
                    loading = true;
                    addMore.hide();
                    adding.show();
                    //请求数据
                    getBox()
                }
            });
            //获取加载内容并加载
            function getBox() {
                var url = '/base/api/upload?page='
                if (activeItemId) {
                    url = '/base/api/upload/' + activeItemId + '?page='
                }
                $.get(url + page, function(html) {
                    imgRow.append(html);
                    //加载完毕后，正在加载提示消失
                    adding.hide();
                    //页码累加
                    page++;
                    showAddMore()
                });
            }
            //提示下拉加载
            function showAddMore() {
                //根据个数判断当前状态，是否加载完毕
                if (imgRow.children('div').length === (page - 1) * 20) {
                    //提示可继续加载
                    addMore.show();
                    loading = false;
                } else {
                    if (page > 2) {
                        //所有内容加载完毕，提示无内容
                        addEnd.show()
                    }
                    loading = true;
                }
            }
        }
    };

    exports.bootstrap = function(e, i) {
        $(t(e, i))
    }

});