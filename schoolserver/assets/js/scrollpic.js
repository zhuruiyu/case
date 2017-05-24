/**
 * Created by dell on 2017/2/9.
 */
/*like*/
/*首页轮播图和选项卡*/
$(function () {
    //轮播图
    var iNow=0;
    var timer=null;
    $(" #list li").on("click",function () {
        var index=$(this).index();
        iNow=index;
        $(this).addClass("selected").siblings().removeClass("selected");
        $(" #pic").animate({
            left:-index*680
        },500);
    });
    run();
    function run() {
        timer=setInterval(function () {
            iNow++;
            if(iNow==$(" #list li").length){
                iNow=0;
            }
            $(" #list li").eq(iNow).addClass("selected").siblings().removeClass("selected");
            $(" #pic").animate({
                left:-iNow*680
            },1000);
        },3000);
    }
    $("#mask").on("mouseout",function () {
        run();
    });
    $("#mask").on("mouseover",function () {
        clearInterval(timer);
    });

    //选项卡
    $("#circlrlist li").hover(function () {
       $("span",this).css("display","block");
        },function () {
        $("span",this).css("display","none");
    });


});