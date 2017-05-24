<?php
//我的发帖


?>
<!DOCTYPE html>
<base href="<?php echo site_url()?>">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的回复</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <link rel="stylesheet" href="assets/css/myblog.css">
    <style>
        .selected{
            border-bottom: 1px solid red;
        }
    </style>
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
<div id="content" class="warper">
    <div id="con">
        <p id="con-title"><i class=" fa fa-futbol-o"></i>&nbsp;&nbsp;我的回复</p>
        <hr>
        <div id="con-content">
            <?php foreach ($myblog as $key=>$value){?>
                <div class="con-item">
                    <div class="item-title">
                        <span><?php echo $value["username"]?></span>
                        <span>回复了你</span>
                        <span><?php echo $value["time"]?></span>
                    </div>
                    <div class="item-con">
                        <?php
                        $content=$value["content"];
                        $index=$value["bid"];
                        $flag=$value["flag"];
                        $replayid=$value["replayid"];
                        if(strlen($content)>100){
                            if($value["flag"]=="1"){
                                //echo "<span class='selected'>mb_substr($content,0,100)&nbsp;</span>";
                                echo "<span style='color: red'>[未读]</span><span class='selected' onclick=turn(".$index.",".$flag.",".$replayid.")>$content</span>";
                            }else{
                                echo "<span onclick=turn(".$index.",".$flag.",".$replayid.")>$content</span>";
                            }
                        }else{
                            if($value["flag"]=="1"){
                                //echo "<span class='selected'>mb_substr($content,0,100)&nbsp;</span>";
                                echo "<span style='color: red'>[未读]</span><span class='selected' onclick=turn(".$index.",".$flag.",".$replayid.")>$content</span>";
                            }else{
                                echo "<span onclick=turn(".$index.",".$flag.",".$replayid.")>$content</span>";
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php }?>
        </div>
        <div id="con-btn">
            <button>点击加载更多</button>
        </div>
    </div>
    <div id="list">
        <div id="list-login">
            <ul>
                <li><i class="fa fa-copyright"></i>&nbsp;<a href="<?php echo site_url("blog/Blog/writeblog")?>">发表帖子</a></li>
                <li><i class="fa fa-comment"></i>&nbsp;<a href="<?php echo site_url("blog/blog/commentblog")?>">我的回复</a></li>
                <li><i class="fa fa-exchange"></i>&nbsp;<a href="<?php echo site_url("blog/blog/myblog")?>">我的发帖</a></li>
            </ul>
        </div>
        <div id="list-con">
            <ul>
                <li><i class="fa fa-mail-reply"></i>&nbsp;<a href="<?php echo site_url("index/user/index")?>">返回首页</a></li>
            </ul>
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
    $(function () {
        //点击按钮加载五条数据
        var flag=1;
        var count=<?php echo count($myblog)?>;
        var btn=$("#con-btn button");
        hide(flag);
        btn.on("click",function () {
            flag++;
            var conItem=$(".con-item");

            if(flag*8>=conItem.length){
                btn[0].style.display='none';
            }else{
                show(flag);
            }

        });
        function hide(num) {
            var conItem=$(".con-item");
            if(conItem.length>=8){
                for(var i=conItem.length;i>8*num;i--){
                    conItem[i-1].style.display="none";
                }
            }
        }
        function show(num) {
            var conItem=$(".con-item");
            for(var i=0;i<8*num;i++){
                conItem[i].style.display="block";
            }
        }

    });
    function turn(bid,flag,replayid) {
        if(flag!="1"){
            location="<?php echo site_url("blog/blog/detail/")?>"+bid;
        }else{
            $.post("<?php echo site_url("blog/blog/change_flag")?>",{"replayid":replayid},function (data) {
                if(data=="success"){
                    location="<?php echo site_url("blog/blog/detail/")?>"+bid;

                }
            });
        }
    }
</script>
</body>
</html>
