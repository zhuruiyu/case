<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo site_url()?>">
    <meta charset="UTF-8">
    <title>个人中心</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/personal.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
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
    <div id="content-left">
        <div id="password">
            <p style="color:rgb(255, 204, 0);border-left: 5px black solid">&nbsp;修改密码</p>
            <hr>
            <div>
                <label for="oldpass">旧密码</label>
                <input type="password" id="oldpass">
            </div>
            <div>
                <label for="pass">新密码</label>
                <input type="password" id="pass">
            </div>
            <div>
                <label for="repass">重新输入</label>
                <input type="password" id="repass">
            </div>
            <div>
                <input type="submit" value="修改" id="sub">
            </div>
        </div>
        <div id="personal">
            <p style="color:rgb(255, 204, 0);border-left: 5px black solid">&nbsp;个人资料</p>
            <hr>
            <div>
                <label for="user">登录账号</label>
                <input type="text" disabled id="user" value="<?php echo base64_decode($this->session->userdata("uname"))?>">
            </div>
            <div>
                <label for="name">昵称</label>
                <input type="text" id="name" name="name" value="<?php echo $userinfor->username ?>">
            </div>
            <div>
                <label for="sex">性别</label><br />
                <input type="radio" value="1" name="sex" <?php if($userinfor->sex=="1") echo "checked"?>>男
                <input type="radio" value="2" name="sex" <?php if($userinfor->sex=="2") echo "checked"?>>女
            </div>
            <div>
                <label for="grade">年级</label>
                <input type="text" name="grade" id="grade" value="<?php echo $userinfor->grade?>">
            </div>
            <div>
                <label for="major">专业</label>
                <input type="text" id="major" name="major" value="<?php echo $userinfor->major?>">
            </div>
            <div>
                <input type="submit" value="提交" id="personsub">
            </div>
        </div>
    </div>
    <div id="content-right">
        <ul>
            <li><a href="index/user/personal#personal">个人资料</a></li>
            <li><a href="index/user/personal#password">修改密码</a></li>
            <li><a href="index/user/login_index">返回首页</a></li>
        </ul>
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
    var $sub=$("#sub");
    $sub.on("click",function (event) {
        var $oldpass=$.trim($("#oldpass").val());//旧密码
        var $pass=$.trim($("#pass").val());//新密码
        var $repass=$.trim($("#repass").val());
        var $form=$("#password");
        $(".content-infor").remove();
        var flag=0;
        if($oldpass==""){
            $form.append("<div class='content-infor'>*请输入旧密码</div>");
        }else if($pass==""||$repass==""){
            $form.append("<div class='content-infor'>*请输入新密码</div>");
        }else if($pass!=$repass){
            $form.append("<div class='content-infor'>*两次密码不一致</div>");
        }else if($pass.length<6){
            $form.append("<div class='content-infor'>*密码太短了</div>");
        }else{
            $.post("index/user/check_password",{"oldpass":$oldpass},function (data) {
                if(data=="1"){
                    $.post("index/user/change_password",{"pass":$pass,"oldpass":$oldpass},function (data) {
                        if(data=="1"){
                            $form.append("<div class='content-infor' style='color:green;'>*修改成功</div>");
                        }
                    });
                }else{
                    $form.append("<div class='content-infor'>*旧密码不正确</div>");
                }
            });
        }

    });
    var $personsub=$("#personsub");
    $personsub.on("click",function () {
        var name=$.trim($("#name").val());//获取昵称
        var sex=$.trim($('input:radio[name="sex"]:checked').val());//获取性别
        var grade=$.trim($("#grade").val());//获取年级
        var major=$.trim($("#major").val());//获取专业
        var $personal=$("#personal");
        $(".content-infor").remove();
        if(major.length>15||grade.length>15){
            $personal.append("<div class='content-infor'>*请小于15个字的专业名称或年级</div>");
        }else{
            $.post("index/user/checkname",{"name":name},function (data) {
                if(data=="error"){
                    $personal.append("<div class='content-infor'>*昵称已经存在了</div>");
                }else{
                    $.post("index/user/change_personal",{"name":name,"sex":sex,"grade":grade,"major":major},function (data) {
                        if(data=="success"){
                            $personal.append("<div class='content-infor'>*修改成功</div>");
                        }
                    })
                }
            });
        }

    });
</script>
</body>
</html>
