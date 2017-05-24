<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*like*/
/*blog首页*/
?>
<!DOCTYPE html>
<base href="<?php echo site_url()?>">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>信息平台</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/blog.css">
</head>
<body>
<!--header导航栏-->
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
<div id="img-content" class="warper">
    <div><img src="assets/images/blog/blog1.jpg" alt=""></div>
    <div><img src="assets/images/blog/blog2.jpg" alt=""></div>
    <div><img src="assets/images/blog/blog3.jpg" alt=""></div>
    <div><img src="assets/images/blog/blog4.jpeg" alt=""></div>
    <div><img src="assets/images/blog/blog1.jpg" alt=""></div>
</div>
<div id="content" class="warper">
    <div id="con">
        <p id="con-title">
            <i class=" fa fa-address-card-o"></i>&nbsp;&nbsp;校园要闻
            <span><a href="blog/Blog/blog">全部信息</a></span>
            <span><a href="blog/Blog/hotlearn">学习交流</a></span>
            <span><a href="blog/Blog/hotquestion">热点问题</a></span>
        </p>
        <hr>
        <?php foreach ($blog as $key=>$value){?>
            <div class="con-item">
                <div class="con-writer">
                    <i class="fa fa-bars" style="width: 20px;height: 20px;"></i>
                    <span><?php echo $value->username?></span>
                    <span>发表了帖子<i class="fa fa-superpowers"></i>&nbsp;</span>
                    <span><?php echo $value->time?></span>
                    <span><?php echo $value->classfy?></span>
                </div>
                <div class="item-title">
                    <a href="<?php echo site_url('blog/blog/detail/'.$value->bid)?>"><?php echo $value->title?></a>
                </div>
                <div class="writer-intro">
                    <span><?php echo $value->username?></span>
                    <?php echo $value->grade?>,
                    <?php echo $value->major?>
                </div>
                <div class="item-con">
                    <?php
                    $content=$value->content;
                    if(strlen($content)>100){
                        echo mb_substr($content,0,100)."....&nbsp;"."<a href=".site_url('blog/blog/detail/'.$value->bid).">查看全部</a>";
                    }else{
                        echo $content;
                    }
                    ?>
                </div>
                <div class="con-reply">
                    <span>浏览数(<?php echo $value->hits?>)</span>&nbsp;&nbsp;
                    <span>评论(<?php echo $value->replynum?>)</span>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        echo $this->pagination->create_links();
        ?>
    </div>
    <div id="list">
        <div id="unlogin">
            <a href="<?php echo site_url("index/user/index")?>">未登录</a>
        </div>
        <div id="list-con">
            <ul>
                <li><i class="fa fa-address-card-o"></i>&nbsp;<a href="blog/Blog/index">全部信息</a></li>
                <li><i class="fa fa-futbol-o"></i>&nbsp;<a href="blog/Blog/hotblog">校园要闻</a></li>
                <li><i class="fa fa-futbol-o"></i> &nbsp;<a href="blog/Blog/hotquestion">热点问题</a></li>
                <li><i class="fa fa-futbol-o"></i>&nbsp;<a href="blog/Blog/hotlearn">学习交流</a></li>
                <li><i class="fa fa-mail-reply"></i>&nbsp;<a href="index/user/index">返回首页</a></li>
            </ul>
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
