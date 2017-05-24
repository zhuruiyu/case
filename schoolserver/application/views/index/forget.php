<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*忘记密码页面*/
?>
<!DOCTYPE html>
<html lang="en">
<base href="<?php echo site_url()?>">
<head>
    <meta charset="UTF-8">
    <title>忘记密码</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/forget.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <style>
        .newinfor{
            color:red;
        }
    </style>
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
<div id="content" class="warper">
    <div id="content-top">
        <p>&nbsp;找回密码</p>
        <div>
            邮箱&nbsp;<input type="text" placeholder="请输入邮箱地址" id="email"><br /><br />
            <button id="send">发送邮件</button>
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
<script>
    var $send=$("#send");
    $send.on("click",function () {
        var $contentTop=$("#content-top");
        var $newinfor=$(".newinfor");
        $contentTop.find($newinfor).remove();
        var $email=$.trim($("#email").val());
        if($email==""){
            var oP=$("<div class='newinfor'>*请输入邮箱地址</div>");
            $contentTop.append(oP);
        }else if(!$email.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
            var oP=$("<div class='newinfor'>*请输入正确的邮箱地址</div>");
            $contentTop.append(oP);
        }else{
            //检查用户是否有效
            $.post("<?php echo site_url("index/user/checkuser")?>",{"username":$email},function (data) {
                if(data=="error"){
                    //存在，则发送邮件
                    $.post("<?php echo site_url("index/user/send_forget")?>",{"username":$email},function (data) {
                        var oP=$("<div class='newinfor'>发送成功</div>");
                        $contentTop.append(oP);
                    });
                }else{
                    var oP=$("<div class='newinfor'>*请输入有效的邮箱地址</div>");
                    $contentTop.append(oP);
                }
            });
        }
    });
</script>
</body>
</html>
