<?php
//修改忘记密码页面
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
        <p>&nbsp;修改密码</p>
        <div>
            邮箱账号&nbsp;<input type="text" value="<?php echo $user?>" id="email" disabled><br /><br />
            新密码&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="pass"><br /><br />
            重新输入&nbsp;<input type="password" id="repass"><br /><br />
             <button id="send">修改</button>
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
<script>
    $(function () {
        $("#send").on("click",function () {
            var $pass=$.trim($("#pass").val());
            var $repass=$.trim($("#repass").val());
            var $contentTop=$("#content-top");
            var $newinfor=$(".newinfor");
            var $user=$.trim($("#email").val());
            $contentTop.find($newinfor).remove();
            if($pass==""||$repass==""){
                var oP=$("<div class='newinfor'>*请输入密码</div>");
                $contentTop.append(oP);
            }else if($pass.length<6){
                var oP=$("<div class='newinfor'>*请输入至少六位的密码</div>");
                $contentTop.append(oP);
            } else if($pass!=$repass){
                var oP=$("<div class='newinfor'>*密码不一致</div>");
                $contentTop.append(oP);
            }else{
                $.post("<?php echo site_url("index/user/change_pass")?>",{"user":$user,"pass":$pass},function (data) {
                    if(data=="success"){
                        var oP=$("<div class='newinfor'>*修改成功</div>");
                        $contentTop.append(oP);
                    }
                });
            }
        });
    });
</script>
</html>
