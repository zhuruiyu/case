<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/msg_detail.css">
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
<a href="oldMarket/Message/my_msg_receive" class="msg-back"><i class="fa fa-hand-o-left" aria-hidden="true"></i>返回我的消息</a>
<div id="msg-content">
    <p class="sender"><?php echo $rs->user?></p>
    <p class="msg-content"><?php echo $rs->mcontent?></p>
    <form action="oldMarket/Message/do_send_msg/<?php echo $rs->sid?>" method="post" id="post-msg">
        <input type="text" placeholder="请输入回复内容" class="content" name="content">
        <input type="submit" value="回复" class="sub-btn">
    </form>

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