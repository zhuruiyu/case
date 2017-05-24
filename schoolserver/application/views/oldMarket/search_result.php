<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/oldMarket.js"></script>
    <script src="assets/js/pinto.min.js"></script>
    <script>
        //瀑布流的实现
        $(function () {
            $('#good-content').pinto({
                marginY:40,
                marginX:20
            });
            if($('#good-content').find('.blank').length==1){
                $('#good-content').css('background','#ccc');
            }
//            console.log($('#good-content').find('.blank').length);
        });
        //控制一个里面文字的个数
        $(function () {
            var content = $('#good-content .good-content').html();
            console.log(content.length);
            if(content.length>30){

                content = content.slice(0,30)+"...";
                $('#good-content .good-content').html(content);
            };

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
<div id="container">
    <div class="top">
        <form id="search" method="get" action="oldMarket/Goods/search">
            <input type="text" class="search" placeholder="搜索" name="key"><div class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></div>
            <ul class="search-tips">

            </ul>
        </form>
        <h3>本次搜索的关键词为：<?php echo $key?></h3>
    </div>
    <div id="good-content">
        <?php
            if(count($rs)==0){
                echo "<span class='blank'>糟糕好像没有相关数据，请搜些其它试试</span>";
            }else{
                foreach ($rs as $val){

        ?>
            <div>
                <a href="oldMarket/Goods/good_detail/<?php echo $val->gid?>">
                    <img src="assets/images/uploads/<?php echo $val->first_img?>">
                    <h3><?php echo $val->gtitle?></h3>
                    <p class="good-content"><?php echo $val->gcontent?></p>
                    <p><span>发布时间：<?php echo $val->time?></span>&nbsp;<span>点击量：<?php echo $val->hits?></span></p>
                </a>
            </div>
        <?php }}?>

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