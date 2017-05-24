<?php defined('BASEPATH') OR exit('No direct script access allowed');
//      if($this->session->userdata("login_on")!="TRUE"){
//          redirect("index/user/index");
//      }
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
        <hr/>
        <div id="content-infor"></div>
        <div id="showPerson" style="display: block">
            <ul>
                <li><a href="index/user/personal">个人中心</a></li>
                <li><a href="oldMarket/Goods/index">我的市场</a></li>
                <li><a href="">我的讨论</a></li>
                <li><a href="#">我的私信</a></li>
                <li><span id="exit">退出登录<span/></li>
            </ul>
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
            <li>1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
        </ul>
        <div id="left"></div>
        <div id="right"></div>
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
        var $logbtn = $("#logbtn");
        var $regbtn = $("#regbtn");
        var $reglogbtn = $("#reglogbtn");
        var $showperson = $("#showPerson");
        var $contentinfor = $("#content-infor");
        var $log = $("#login");
        var $reg = $("#register");
        var $remember = $("#remember");
        var $exit = $("#exit");
        $exit.on("click", function () {
            $.post("<?php echo site_url("index/user/login_out")?>", function (data) {
                if (data == "1") {
                    removeCookie("SC_N");
                    removeCookie("SC_V");
                }
                var str = "http://localhost:80/schoolserver/index/user/index";
                location = str;
            });
        });
        function setCookie(key, value, day) {
            //设置cookie
            var str = key + "=" + value + ";";
            if (day) {
                var date = new Date();
                date.setDate(date.getDate() + day);
                str += "expires=" + date;
            }
            document.cookie = str;
        }

        function removeCookie(key) {
            setCookie(key, "", -1);
        }
    });
</script>
</html>




