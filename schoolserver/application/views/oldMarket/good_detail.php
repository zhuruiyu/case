<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/good_detail.css">
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/good_detail.js"></script>
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
<nav class="good-detail-nav">
    <ul id="top-nav">
        <li><span class="title">发布人</span><span class="content"><?php echo $rs[0]->user?></span></li>
        <li><span class="title">浏览次数</span><span class="content"><?php echo $rs[0]->hits?></span></li>
        <li><span class="title">发布时间</span><span class="content"><?php echo $rs[0]->time?></span></li>
    </ul>
    <a href="oldMarket/Goods/index" class="back"><i class="fa fa-hand-o-left" aria-hidden="true"></i>返回二手市场首页</a>
</nav>
<div class="good-detail-container">
    <div class="good-img">
        <span class="left-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
        <span class="right-btn"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
        <?php foreach ($rs as $val){?>
            <img src="assets/images/uploads/<?php echo $val->imgName ?>" alt="">
        <?php }?>
    </div>
    <aside class="content">
        <h1><?php echo $rs[0]->gtitle?></h1>
        <p><?php echo $rs[0]->gcontent?></p>
        <div class="price">价格: <span><?php echo $rs[0]->price?>元</span></div>
        <div id="contact">联系卖家</div>
    </aside>
</div>
<form action="oldMarket/Message/do_send_msg/<?php echo $rs[0]->uid?>" class="sen-msg" method="post">
    <h3>请输入你要发送的内容</h3><span><i class="fa fa-times" aria-hidden="true"></i></span>
    <input type="text" name="content" placeholder="在此输入你要发送的留言" class="content">
    <input type="submit" name="sub" class="sub-btn" value="发送" disabled>
</form>
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
