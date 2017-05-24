<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo site_url()?>">
    <title>精品推荐</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/article.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <script src="assets/js/control_img.js"></script>
    <script src="assets/js/article.js"></script>

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
    <div class="top-btn">

    </div>
    <div id="show-box">
        <ul class="show-box-container">
            <li style="z-index: 100"><img src="assets/images/article/show-img1.jpg" alt=""></li>
            <li><img src="assets/images/article/show-img2.jpg" alt=""></li>
            <li><img src="assets/images/article/show-img3.jpg" alt=""></li>
            <li><img src="assets/images/article/show-img4.jpg" alt=""></li>
            <li><img src="assets/images/article/show-img5.jpg" alt=""></li>
            <li><img src="assets/images/article/show-img6.jpg" alt=""></li>
        </ul>
    </div>
    <div id="show-list">
        <ul class="show-list-nav">
            <li class="selected" value="1">
                <span>
                    <i class="fa fa-cutlery" aria-hidden="true"></i> 吃货天地
                </span>
            </li>
            <li value="2">
                <span>
                    <i class="fa fa-plane" aria-hidden="true"></i> 玩转东北
                </span>
            </li>
            <li value="3">
                <span>
                    <i class="fa fa-book" aria-hidden="true"></i> 漫游书海
                </span>
            </li>
        </ul>
        <ul class="show-article">
            <?php foreach ($rs as $value){?>
            <li value="<?php echo $value->article_id?>">

                <div class="article-show-img">
                    <img src="assets/images/article_upload/<?php echo $value->show_img?>" alt="">
                </div>
                <a href="Article/show_article/<?php echo $value->article_id?>/<?php echo $value->type?>">
                    <div class="show-article-container">
                        <h1><?php echo $value->article_title?></h1>
                        <h3>发布时间：<?php echo $value->add_time?></h3>
                        <div class="article-content">
                            <?php echo $value->article_content?>
                        </div>
                    </div>
                </a>
                <span class="click">
                    <div></div>
                    <span><?php echo $value->article_hits?></span>
                </span>
            </li>
            <?php }?>
        </ul>
        <div class="get_more-container">
            <div class="get_more">
                点击获取更多
            </div>
        </div>

    </div>
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