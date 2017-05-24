//二手市场的js 翟佳羽
$(function () {
    //调整隐藏table的高度
    var i=0;
    $('#nav-list .nav-more').each(function () {
        var top = i*(35);
        $(this).css('top',top+'px');
        i++;
    });
    //控制导航列表的显示
    $('#nav-list li').mouseover(function () {
        $(this).addClass('hover');
        $(this).find('.nav-more').show();
    }).mouseout(function () {
        $(this).removeClass('hover');
        $(this).find('.nav-more').hide();
    });

});
$(function () {
    //轮播图
    var iNow = 0;
    $('.left-btn').on('click',function () {
         iNow--;
         if(iNow<0){
             iNow = 3;
         }
         changeImg(iNow);
    });
    $('.right-btn').on('click',function () {
        iNow++;
        if(iNow>3){
            iNow=0;
        }
        changeImg(iNow);
    });
    var $aLi = $('.control-list li');
    var index = 0;
    $aLi.each(function () {
        this.index = index;
       $(this).on('click',function () {
           iNow = this.index;
           changeImg(this.index);
       });
        index++;
    });
    var timer = setInterval(function () {
        $('.right-btn').trigger('click');
    },3000);
    $('#carousel').on({
        mouseover:function () {
            $('.control-btn').finish().fadeIn(800);
            clearInterval(timer);
        },
        mouseout:function () {
            $('.control-btn').finish().fadeOut(800);
            timer = setInterval(function () {
                $('.right-btn').trigger('click');
            },3000)
        }
    });
    function changeImg(index) {
        $aLi.each(function () {
            $(this).removeClass('selected');
        });
        $aLi.eq(index).addClass('selected');
        var left = $('.content li').eq(0).width()*index;
        $('.content').animate({left:-left});
    }
});
    //实现在输入时进行相关提示
    $(function () {
           $searchTip = $('#search .search-tips');
           $('#search .search').on({
               'keyup':function () {
                   $searchTip.hide();
                   $searchTip.empty();
                   var keyword = $(this).val();
                   $.post('oldMarket/Goods/good_search_tip',{keyword:keyword},function (data) {
                       if(data.length != 2){
                           var rs = JSON.parse(data);
                           for(var i=0;i<rs.length;i++){
                               var $Li = $("<li>"+rs[i].gtitle+"</li>");
                               $Li.on({
                                   'mouseover':function () {
                                       $(this).css('background','#0000ff');
                                   },
                                   'click':function () {
                                       $('#search .search').val($(this).html());
                                   },
                                   'mouseout':function () {
                                       $(this).css('background','transparent')
                                   }
                               });
                               $searchTip.append($Li);
                           }
                           $searchTip.show();
                       }else{
                           $searchTip.hide();
                       }
                   })
               },
               'focus':function () {
                   if($searchTip.find('li').length==0){
                       $searchTip.hide();
                   }else{
                       $searchTip.show();
                   }

               },
               'blur':function () {
                   setTimeout(function () {
                       $searchTip.hide();
                   },100);
               }
           })
       });

