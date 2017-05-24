<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script>
        $(function () {
            $('.content tr td:nth-child(n+3),.content tr td:nth-child(n+3) a').css({'width':"40px",'display':'inline-block'});
        })
    </script>
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
<div id="my_goods-container">
    <aside class="letter-nav">
        <ul>
            <li><a href="oldMarket/Message/my_msg_receive">我的私信</a> </li>
            <li><a href="oldMarket/Message/my_msg_send">已发送</a></li>
            <li class="selected"><a href="oldMarket/Goods/my_goods">我的发布</a></li>
        </ul>
    </aside>
    <div class="content">
        <table border="1px" cellspacing="0">
            <tr>
                <th>文章编号</th>
                <th>文章标题</th>
            </tr>
            <?php foreach ($rs as $value){?>
                <tr>
                    <td><?php echo $value->gid?></td>
                    <td><a href="#"><?php echo $value->gtitle?></a></td>
                    <td><a href="oldMarket/Goods/del_my_good/<?php echo $value->gid?>">删除</a></td>
                    <td><a href="oldMarket/Goods/edit_my_good/<?php echo $value->gid?>">修改</a></td>
                </tr>
            <?php }?>
        </table>
        <?php echo $this->pagination->create_links()?>
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