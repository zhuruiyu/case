<?php defined('BASEPATH') OR exit('No direct script access allowed');
    if($this->session->userdata("login_on")=="TRUE"){
        redirect("index/user/login_index");
    }
?>

<!DOCTYPE html>
<base href="<?php echo site_url()?>">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>校园生活服务平台</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/index.css">
<!--    <link rel="stylesheet" href="assets/css/font-awesome.css">-->
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/scrollpic.js"></script>
<!--    <script src="assets/js/index.js"></script>-->
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
<!--注册登录和轮播图-->
<div id="content" class="warper">
    <div id="reglog">
        <div id="reglogbtn">
            <span id="logbtn" class="active">登录</span>
            <span id="regbtn">注册</span>
        </div>
        <hr/>
        <div id="content-infor"></div>
        <div id="register">
                &nbsp;&nbsp; <lable for="user">账号</lable>&nbsp;&nbsp;
                <input type="text" id="ruser" name="user" placeholder="请输入注册邮箱"><br /><br /><br /><br />
                &nbsp;&nbsp; <lable for="pass">密码</lable>&nbsp;&nbsp;
                <input type="password" id="rpass" name="pass" placeholder="请输入至少6位密码"><br /><br /><br /><br />
                <input type="button" value="注册" id="regsub">
                <br /><br />
                <p style="background: rgb(193,186,93);text-align: center;color:#fff;">如果您已经注册，请直接登录</p>
        </div>
        <div id="login">
                &nbsp;&nbsp;<lable for="user">账号</lable>&nbsp;&nbsp;
                <input type="text" id="luser" name="user" placeholder="请输入邮箱"><br /><br />
                &nbsp;&nbsp;<lable for="pass">密码</lable>&nbsp;&nbsp;
                <input type="password" id="lpass" name="pass" placeholder="请输入密码"><br /><br />
                &nbsp;&nbsp;<lable for="code">验证码</lable>
                <input type="text" id="code" style="width: 100px; padding-top: -10px;" placeholder="输入验证码">&nbsp;&nbsp;<img src="<?php echo site_url("index/user/bb")?>" id="code-img" style="margin-left: 50px;" /><br /><br />
                &nbsp;&nbsp;<input type="checkbox" name="remember" id="remember">&nbsp;记住我
                <a href="index/user/forget" id="forget">忘记密码</a><br /><br />
                <input type="button" value="登录" id="logsub">
                <br /><br />

                <p style="background: rgb(193,186,93);text-align: center;color:#fff;">如果您已经注册，请直接登录</p>
        </div>
    </div>
    <div id="scrollpic">
        <div id="mask">

        </div>
        <div id="pic">
            <img src="assets/images/fpage.jpg " alt="">
            <img src="assets/images/lpage.jpg " alt="">
            <img src="assets/images/spage.jpg" alt="">
            <img src="assets/images/tpage.jpg" alt="">
        </div>
        <ul id="list">
            <li class="selected">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
        </ul>
    </div>
</div>
<div id="circlrlist" class="warper">

    <ul>
        <li><a href=""><img src="assets/images/flink.jpg" alt=""></a><span>二手市场,在这里发布物品</span></li>
        <li><a href=""><img src="assets/images/slink.jpg" alt=""></a><span>精品推荐,在这里查看推荐</span></li>
        <li><a href=""><img src="assets/images/tlink.jpg" alt=""></a><span>学习讨论，在这里进行讨论</span></li>
    </ul>

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
        var $logbtn=$("#logbtn");
        var $regbtn=$("#regbtn");
        var $reglogbtn=$("#reglogbtn");
        var $contentinfor=$("#content-infor");
        var $log=$("#login");
        var $reg=$("#register");
        var $remember=$("#remember");
        //切换注册登录div
        $logbtn.on("click",function () {
            $logbtn.addClass('active');
            $regbtn.removeClass('active');
            $log.show();
            $reg.hide();
            $contentinfor.html("");
            return false;
        });
        $regbtn.on("click",function () {
            $regbtn.addClass('active');
            $logbtn.removeClass('active');
            $reg.show();
            $log.hide();
            $contentinfor.html("");
            return false;
        });
        $.post("<?php echo site_url('index/user/cookie_login')?>",{"username":getCookie("SC_N"),"password":getCookie("SC_V")},function (data) {
            //如果cookie登录成功，刷新页面设置session
           // console.log(data);
            if(data=="1"){
                location="<?php echo site_url("index/user/index")?>";
            }
        });
        //验证注册，和输入是否合法
        var $ruser=$("#ruser");
        var $rpass=$("#rpass");
        var $regsub=$("#regsub");
        var $regreset=$("#regreset");
        //输入账号的时候得到焦点，清除span
        $ruser.focus(function () {
            //验证账号
            //得到焦点先把span清除
            if($ruser.next()[0].nodeName=='SPAN'){
                $ruser.next().remove();
            }
        });
        //输入密码的时候得到焦点，清除span
        $rpass.focus(function () {
            if($rpass.next()[0].nodeName=='SPAN'){
                $rpass.next().remove();
            }
        });
        //失去焦点的时候进行AJAX查询，判读用户是否被注册
        $ruser.blur(function () {
            if($ruser.val()!=""){
                if(!$ruser.val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                    $ruser.val("");
                    //如果不匹配，则添加一个span，提示错误信息
                    $ruser.after("<span style='color:red;'>*输入格式错误</span>");
                }else{
                    $.post("<?php echo site_url("index/user/checkuser")?>",{username:$ruser.val().replace(/\ +/g,"")},function (data) {
                        if(data=="error"){
                            $ruser.val("");
                            $ruser.after("<span style='color:red;'>*账号已被注册</span>");
                        }else{
                            $ruser.after("<span style='color:green;'>*账号可用</span>");
                        }
                    });
                }
            }
        });
        //点击注册，发送激活链接
        $regsub.on("click",function () {
            if($ruser.next()[0].nodeName=='SPAN'){
                $ruser.next().remove();
            }
            if($rpass.next()[0].nodeName=='SPAN'){
                $rpass.next().remove();
            }
            if($ruser.val()==""){
                $ruser.after("<span style='color:red;'>*请输入邮箱</span>");
            }else if($rpass.val()==""){
                $rpass.after("<span style='color:red;'>*请输入密码</span>");
            }else if($rpass.val().replace(/\ +/g,"").length<6){
                $rpass.after("<span style='color:red;'>*输入密码过短</span>");
            }else{

                $.post("<?php echo site_url("index/user/checkuser")?>",{username:$ruser.val().replace(/\ +/g,"")},function (data) {
                    if(data=="error"){
                        $ruser.val("");
                        $ruser.after("<span style='color:red;'>*账号已被注册</span>");
                    }else{
                        $.post("<?php echo site_url('index/user/sendcode')?>",{username:$ruser.val().replace(/\ +/g,""),password:$rpass.val().replace(/\ +/g,"")},function (data) {
                            if(data=="error"){
                                alert("注册失败,请您重新注册");
                            }else if(data=="success"){
                                alert("注册成功,请您到邮箱激活账号");
                                $ruser.val("");
                                $rpass.val("");
                                setTimeout(function () {
                                    $regsub.attr("disabled","disabled");
                                },0);
                                //点击注册延时30秒才允许再次点击
                                setTimeout(function () {
                                    $regsub.attr("disabled",false);
                                },30000);
                            }
                        });
                    }
                });
            }
        });
        //重置按钮
        $regreset.on("click",function () {
            $ruser.val("");
            $rpass.val("");
            if($ruser.next()[0].nodeName=='SPAN'){
                $ruser.next().remove();
            }
            if($rpass.next()[0].nodeName=='SPAN'){
                $rpass.next().remove();
            }
        });
        //验证登录
        var $luser=$("#luser");
        var $lpass=$("#lpass");
        var $code=$("#code");
        var $logreset=$("#logreset");
        var $logsub=$("#logsub");
        //得到焦点先把span清除
        $luser.focus(function () {
            //验证账号
            if($luser.next()[0].nodeName=='SPAN'){
                $luser.next().remove();
            }
        });
        $lpass.focus(function () {
            //验证账号
            if($lpass.next()[0].nodeName=='SPAN'){
                $lpass.next().remove();
            }
        });
        //失去焦点的时候判断，账号输入是否合理
        $luser.blur(function () {
            if($luser.val()!=""){
                if(!$luser.val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                    $luser.val("");
                    //如果不匹配，则添加一个span，提示错误信息
                    $luser.after("<span style='color:red;'>*输入格式错误</span>");
                }else{
                    $luser.after("<span style='color:green;'>*输入正确</span>");
                }
            }else{
                $luser.after("<span style='color:red;'>*请输入邮箱</span>");
            }
        });
        //重置按钮
        $logreset.on("click",function () {
            $luser.val("");
            $lpass.val("");
            if($luser.next()[0].nodeName=='SPAN'){
                $luser.next().remove();
            }
            if($lpass.next()[0].nodeName=='SPAN'){
                $lpass.next().remove();
            }
        });
        //点击登录验证数据库
        $logsub.on("click",function () {
            if($luser.next()[0].nodeName=='SPAN'){
                $luser.next().remove();
            }
            if($lpass.next()[0].nodeName=='SPAN'){
                $lpass.next().remove();
            }
            if($luser.val()==""){
                $luser.after("<span style='color:red;'>*请输入邮箱</span>");
            }else if($lpass.val()==""){
                $lpass.after("<span style='color:red;'>*请输入密码</span>");
            }else if($code.val()==""){
                $contentinfor.html("*请输入验证码");
            }else{
                $.post('<?php echo site_url("index/user/login")?>',{username:$luser.val().replace(/\ +/g,""),password:$lpass.val().replace(/\ +/g,""),code:$code.val().replace(/\ +/g,"")},function (data) {
                    //解析为json,{"uid":xx,"uname":xxx,"state":xxx}
                    var json=JSON.parse(data);
                    if(json["state"]=="success"){
                        $log.hide();
                        $reg.hide();
                        $reglogbtn.hide();
                        //如果点击"记住我",登录成功设置cookie
                        if($remember.is(":checked")){
                            //设置cookie
                            setCookie("SC_N",json["uname"],30);
                            setCookie("SC_V",json["pass"],30);
                        }
                        $contentinfor.html("");
                        location="<?php echo site_url('index/user/login_index')?>";
                    }else if(json["state"]=="error"){
                        $contentinfor.html("*密码或账号输入错误");
                    }else if(json["state"]=="codeerror"){
                        $contentinfor.html("验证码输入错误");
                    }
                });
            }
        });
        function setCookie(key,value,day) {
            //设置cookie
            var str=key+"="+value+";";
            if(day){
                var date=new Date();
                date.setDate(date.getDate()+day);
                str+="expires="+date;
            }
            document.cookie=str;
        }
        function getCookie(key) {
            //获取cookie
            var str=document.cookie;
            var arr=str.split("; ");
            for(var i=0;i<arr.length;i++){
                var arr2= arr[i].split("=");
                if(arr2[0]==key){
                    return arr2[1];
                }
            }
        }
        function removeCookie(key) {
            setCookie(key,"",-1);
        }
        //点击图片更还验证码
        var $codeImg=$("#code-img");
        $codeImg.on("click",function () {
            $.post("<?php echo site_url("index/user/bb")?>",function (data) {
                console.log("aaa");
                $codeImg[0].src="";
                $codeImg[0].src="<?php echo site_url("index/user/bb")?>";

            });
        });
    });
</script>
</html>




