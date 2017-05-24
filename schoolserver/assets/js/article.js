
//存储已经点赞的数组
var arr = $.cookie('aid');
if(!arr){
    console.log('a');
    arr = '';
}else{
    arr = arr.split(',');
}
function show_click() {
    if(arr == ''){
        console.log('b');
        return false;
    }

    for(var i=0;i<arr.length;i++){
        if(arr[i]==''){
            continue;
        }
        $('.show-article li[value="'+arr[i]+'"]').find('.click div').addClass('clicked');
    }
}
//控制文字的个数
function controll_word() {
    // var content = $('.article-content').html();
    // console.log(content.length);
    // if(content.length>10){
    //
    //     content = content.slice(0,10)+"...";
    //     $('.article-content').html(content);
    // }
    $('.article-content').each(function () {
        var content = $(this).html().trim();
        if(content.length>100){
            content = content.slice(0,100)+'...';
            $(this).html(content);
        }
    })
}
window.onload = function () {
    sort_img($('.article-show-img img'));
};
//显示所有已点赞的文章的黄色小手
$(function () {
   setTimeout(function () {
       show_click();

       controll_word();
   },300);
    //点击按钮回到顶部
    var $topBtn = $('#article-container .top-btn');
    $(document).scroll(function () {
        if($(document).scrollTop()>50){
            $topBtn.finish().show();
        }else{
            if(!$topBtn.is(':hidden')){
                $topBtn.animate({top:'-200px'},1000,function () {
                    $topBtn.removeClass('on').on('mouseout',function () {
                        $(this).removeClass('on');
                    }).hide().css({
                        top:'400px'
                    });
                });
            }

        }
    });
    $topBtn.on({
        mouseover:function () {
            $(this).addClass('on');
        },
        mouseout:function () {
            $(this).removeClass('on');
        },
        click:function () {
            $(this).addClass('on').off('mouseout');
            $('html,body').animate({
                scrollTop:'0px'
            },1000,function () {


            });
        }
    })
});
//处理AJAX
//美食的处理
$(function () {
    var index = 0;
    var $showArticle = $('.show-article');
    $('.show-list-nav li').on({
        click:function () {
            $('.get_more').show();
            index = 0;
            var type = $(this).val();
            $.post('Article/get_article',{'type':type,'index':index},function (data) {
                var result = JSON.parse(data);

                if(result){
                    $showArticle.empty();
                }
                for(var i=0;i<result.length;i++){
                    $Li = $('<li value="'+result[i].article_id+'"></li>');
                    $img = $('<img src="assets/images/article_upload/'+result[i].show_img+'" alt="暂无图片">');
                    $img[0].onload = function () {
                        sort_img($('.article-show-img img'));
                    };
                    $showImg = $('<div class="article-show-img"></div>');
                    $img.appendTo($showImg);
                    $showImg.appendTo($Li);
                    $a = $('<a href="Article/show_article/'+result[i].article_id+'/'+result[i].type+'"></a>');
                    $articleCon = $('<div class="show-article-container"></div>');
                    $('<h1>'+result[i].article_title+'</h1>').appendTo($articleCon);
                    $('<h3>发布时间'+result[i].add_time+'</h3>').appendTo($articleCon);
                    $('<div class="article-content">'+result[i].article_content+'</div>').appendTo($articleCon);
                    $articleCon.appendTo($a);
                    $a.appendTo($Li);
                    $('<span class="click"><div></div><span>'+result[i].article_hits+'</span></span>').on(
                        {
                            'click':function () {
                                var $click = $(this);
                                var aid = $(this).parents('li').val();
                                $.post('Article/hit',{'aid':aid},function (data) {
                                    if(data=='success'){
                                        var val = $click.find('span').html();
                                        val = parseInt(val)+1;
                                        $click.find('span').html(val);
                                        $click.find('div').addClass('clicked');
                                        arr = arr+','+aid;
                                        console.log(arr);
                                        $.cookie('aid',arr,1);
                                    }
                                })
                            }
                        })
                        .appendTo($Li);
                    $Li.appendTo($showArticle);
                }
                setTimeout(function () {
                    // sort_img();
                    controll_word();
                    show_click();
                },100);
            });
            $(this).addClass('selected').siblings().removeClass('selected');

        }
    });
    //点击在获取十条数据
    $('.get_more').on('click',function () {
        index+=10;
        var type = $('.show-list-nav').find('.selected').val();
        $.post('Article/get_article',{'type':type,'index':index},function (data) {
            var result = JSON.parse(data);
            for(var i=0;i<result.length;i++){
                $Li = $('<li value="'+result[i].article_id+'"></li>');
                $img = $('<img src="assets/images/article_upload/'+result[i].show_img+'" alt="暂无图片">');
                $img[0].onload = function () {
                    sort_img($('.article-show-img img'));
                };
                $showImg = $('<div class="article-show-img"></div>');
                $img.appendTo($showImg);
                $showImg.appendTo($Li);
                $a = $('<a href="Article/show_article/'+result[i].article_id+'/'+result[i].type+'"></a>');
                $articleCon = $('<div class="show-article-container"></div>');
                $('<h1>'+result[i].article_title+'</h1>').appendTo($articleCon);
                $('<h3>发布时间'+result[i].add_time+'</h3>').appendTo($articleCon);
                $('<div class="article-content">'+result[i].article_content+'</div>').appendTo($articleCon);
                $articleCon.appendTo($a);
                $a.appendTo($Li);
                $('<span class="click"><div></div><span>'+result[i].article_hits+'</span></span>').on(
                    {
                        'click':function () {
                            var $click = $(this);
                            var aid = $(this).parents('li').val();
                            $.post('Article/hit',{'aid':aid},function (data) {
                                if(data=='success'){
                                    var val = $click.find('span').html();
                                    val = parseInt(val)+1;
                                    $click.find('span').html(val);
                                    $click.find('div').addClass('clicked');
                                    arr = arr+','+aid;
                                    console.log(arr);
                                    $.cookie('aid',arr,1);
                                }
                            })
                        }
                    })
                    .appendTo($Li);
                $Li.appendTo($showArticle);
            }
            if(result.length<10){
                $('.get_more').hide();
            }
            setTimeout(function () {
                // sort_img();
                controll_word();
                show_click();
            },100);

        });
    });
    $('.show-article .click').on(
        {
            'click':function () {
                var $click = $(this);
                var aid = $(this).parents('li').val();
                $.post('Article/hit',{'aid':aid},function (data) {
                    if(data=='success'){
                        var val = $click.find('span').html();
                        val = parseInt(val)+1;
                        $click.find('span').html(val);
                        $click.find('div').addClass('clicked');
                        arr = arr+','+aid;
                        console.log(arr);
                        $.cookie('aid',arr,1);
                    }
                })
             }
        })

});
//轮播图
$(function () {
    var idx = 0;
    $('.show-box-container li').each(function () {
        var index = $(this).index();
        $(this).css({
            transform:"rotateY("+(-index*60)+"deg) translateZ(270px)"

        });
    });
    $('.show-box-container').on('click',function () {
        idx = idx+1;
        $(this).css({
            transform:"rotateY("+(-idx*60)+"deg)"
        })
    });
    var timer = setInterval(function () {
        $('.show-box-container').trigger('click');
    },3000);
    $('.show-box-container').on({
        mouseover:function () {
            clearInterval(timer);
        },
        mouseout:function () {
            timer = setInterval(function () {
                $('.show-box-container').trigger('click');
            },3000);
        }
    })
});
