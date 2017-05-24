//使图片包含在div中
window.onload = function () {
    $('.good-img img').each(function () {
//                console.log($(this).width());
        if($(this).width()>$(this).height()){
            $(this).width($(this).parent().width());
            $(this).css({
                top:'50%',
                marginTop:(-$(this).height()/2)+'px'
            });
        }else{
            $(this).height($(this).parent().height());
            $(this).css({
                left:'50%',
                marginLeft:(-$(this).width()/2)+'px'
            });
        }

    })
};

//使图片有轮播效果
$(function () {
    $('.good-img img').eq(0).show().siblings().hide();
    var index = 0;
    var $imgs = $('.good-img img');
    $('.good-img').on({
        'mouseover':function () {
            if($imgs.length>1){
                $(this).find('span').finish().fadeIn();

            }
        },
        'mouseout':function () {
            $(this).find('span').finish().fadeOut();
        }
    });
//            $('.good-img').on('mouseover',function () {
//                alert('a');
//            })
    function show_img(index) {
        $imgs.eq(index).fadeIn().siblings('img').hide();
    }
    $('.good-img .right-btn').on('click',function () {
        index++;
        if(index==$imgs.length){
            index = 0
        }
        show_img(index);
    });
    $('.good-img .left-btn').on('click',function () {
        index--;
        if(index<0){
            index = $imgs.length-1;
        }
        show_img(index);
    });
    //显示或隐藏发送
    var $form = $('.sen-msg');
    $('#contact').on('click',function () {
        $form.animate({
            right:"20px"
        },1000);
    });
    $form.find('span').on('click',function () {
        $form.animate({
            right:'-500px'
        },1000);
    });
    $('.sen-msg .content').on('keyup',function () {
        if($(this).val().trim()!=''){
            $('.sen-msg .sub-btn').attr('disabled',false);
        }else{
            $('.sen-msg .sub-btn').attr('disabled',true);
        }
    })
});
