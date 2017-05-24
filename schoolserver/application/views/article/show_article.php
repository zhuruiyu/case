<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo site_url()?>">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/show_article.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/show_article.js"></script>
    <script src="assets/js/control_img.js"></script>
    <script>
        //使图片在加载后居中
        window.onload = function () {
            sort_img($('.article-show-img img'));
        }
    </script>
    <title>Title</title>
</head>
<body>

<header>
    <div id="header-content" class="warper">
        <ul>
            <li>校园生活服务平台</li>
            <li><a href="index/User/login_index"><img src="assets/images/nav-logo1.png" alt="">
                    &nbsp;首页</a></li>
            <li><a href="oldMarket/Goods/index"><img src="assets/images/nav-logo4.png" alt="">
                    &nbsp;二手市场</a></li>
            <li><a href="Article/index"><img src="assets/images/nav-logo3.png" alt="">
                    &nbsp;精品推荐</a></li>
            <li><a href="blog/Blog"><img src="assets/images/nav-logo2.png" alt="">
                    &nbsp;信息平台</a></li>
        </ul>
    </div>
</header>
<div id="article-container">
    <div class="article-top">
        <p class="article-title"><?php echo $rs->article_title?></p>
        <span class="add_time"><?php echo $rs->add_time?></span>
    </div>
    <div class="article-show-img">
        <img src="assets/images/article_upload/<?php echo $rs->show_img?>" alt="">
    </div>
    <div class="article-content">
        <?php echo $rs->article_content?>
    </div>

    <div class="copy">-------<?php if($rs->type == 1){echo "美食推荐";}else if($rs->type == 2){echo '玩转东北';}else{echo '漫游书海';}?></div>
</div>
<div class="panel"></div>
<div class="footer-nav">
    <span class="last">
        <?php if($last!=''){?>
        <a href="Article/show_article/<?php echo $last->article_id;?>/<?php echo $last->type;?>">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        </a>
        <?php }?>
    </span>
    <span class="top">
        <i class="fa fa-chevron-up" aria-hidden="true"></i>
    </span>
    <span class="next">
        <?php if($next != ''){?>
        <a href="Article/show_article/<?php echo $next->article_id?>/<?php echo $next->type?>">
            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
        </a>
        <?php }?>
    </span>
</div>
<div id="footer">
    <div id="footer-content" class="warper">
        <div id="footer-right">
            版权所有:@copyright校园生活服务平台
            黑龙江大学信息科学与技术学院
        </div>
    </div>
</div>
</body>
</html>