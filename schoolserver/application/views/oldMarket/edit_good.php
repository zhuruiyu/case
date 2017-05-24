<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
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
<form action="oldMarket/Goods/do_edit_my_good" method="post" id="edit-good">
    <input type="hidden" name="gid" value="<?php echo $gid?>">
    <input type="text" value="<?php echo $rs->gtitle?>" name="title">
    <textarea name="content" id="" cols="30" rows="10" >
        <?php echo $rs->gcontent?>
    </textarea>
    <input type="submit" value="修改">
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