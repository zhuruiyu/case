$(function () {
    //最下方控制栏的显示与移除
    var $footNav = $('.footer-nav');
    var $panel = $('.panel');
    function show() {
        $panel.finish().animate({
            bottom:'-20px'
        },1000);
        $footNav.finish().animate({
            bottom:'10px'
        },1000);
    }
    function hide() {
        $footNav.animate({
            bottom:'-80px'
        },1000);
        $panel.animate({
            bottom:'0px'
        },1000);
    }
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        if(scrollTop + windowHeight == scrollHeight){
            show();
        }else{
            hide();
        }
    });
    $('.footer-nav .top').on('click',function () {
        $(window).scrollTop(0);
    });
    $panel.on('mouseover',show);
    // var flag = true; //true代表控制栏隐藏
    // $panel.on('click',function () {
    //      if(flag){
    //
    //      }
    // });
    // // $footNav.on('mouseout',function () {
    // //     $footNav.animate({
    // //         bottom:'-80px'
    // //     },1000);
    // //     $panel.fadeIn(1000);
    // // });
    // // $panel.on('mouseover',function () {
    // //     $panel.hide();
    // //     $footNav.finish().animate({
    // //         bottom:'10px'
    // //     },1000);
    // // })
});
