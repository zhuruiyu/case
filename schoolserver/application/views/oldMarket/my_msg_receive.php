<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
<a href="oldMarket/Goods/index" class="msg-back"><i class="fa fa-hand-o-left" aria-hidden="true"></i>返回首页</a>
<aside class="letter-nav">
    <ul>
        <li class="selected"><a href="oldMarket/Message/my_msg_receive">我的私信</a> </li>
        <li ><a href="oldMarket/Message/my_msg_send">已发送</a></li>
        <li><a href="oldMarket/Goods/my_goods">我的发布</a></li>
    </ul>
</aside>
<table class="letter-content">
    <tr>
        <th>时间</th>
        <th>用户</th>
        <th>状态</th>
    </tr>
   <?php foreach ($rs as $value){?>
       <tr class="<?php if($value->isread == 0){
                    echo 'unread';
                }else{
           echo 'read';
       } ?>">
           <td><?php echo $value->time?></td>
           <td><?php echo $value->user?></td>
           <td><?php
                if($value->isread == 0){
                    echo '未读';
                }else{
                    echo '已读';
                }
               ?></td>
           <td><a href="oldMarket/Message/msg_detail/<?php echo $value->mid?>">查看</a></td>
       </tr>
    <?php }?>
</table>
<?php echo $this->pagination->create_links()?>
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