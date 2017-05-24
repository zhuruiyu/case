//使图片包含在div中
function sort_img($arr) {
    $arr.each(function () {
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

    });
}
