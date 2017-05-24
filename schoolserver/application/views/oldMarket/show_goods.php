<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/pinto.min.js"></script>
    <script>
        //瀑布流的实现
        $(function () {
            $('#good-content').pinto({
                marginY:40,
            });
        });
        //控制一个里面文字的个数
        $(function () {
            var content = $('#good-content .good-content').html();
            console.log(content.length);
            if(content.length>30){

                content = content.slice(0,30)+"...";
                $('#good-content .good-content').html(content);
            }
        })
    </script>
    <style>
        #good-content h3 {
            font-size: 18px;
            margin: 3px 5px;
            color: #333;
        }
        #good-content {
            margin-top: 200px;
            width: 100%;
            background: #fff;
            margin-bottom: 20px;
            /*margin:auto ;*/
        }
        #good-content > div {
            -webkit-box-shadow: 0 4px 15px -5px #555;
            box-shadow: 0 4px 15px -5px #555;
            background-color: #fff;
            /*width:20%;*/
            padding:5px;
            /*margin:20px;*/
        }
        #good-content > div img{
            display: block;
            width: 100%;
        }
        #good-content .show_blank{
            display: block;
            width: 80%;
            margin: 0 auto;
            height: 400px;
            background: #CCCCCC;
            text-align: center;
            font-size: 20px;
            color: #4F5155;
            border-radius: 10px;
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
<ul class="catalog-box">
    <li>
        <h3>二手书籍</h3>
        <?php foreach ($book as $value){?>
            <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>" class="<?php if($value->cid==$cid){
                echo 'selected';
            }?>"><?php echo $value->cname?></a>
        <?php }?>
        <a href="oldMarket/Goods/show_good/9" class="<?php if($cid==9){ echo 'selected';}?>">其他</a>
    </li>
    <li>
        <h3>电子产品</h3>
        <?php foreach ($elec as $value){?>
            <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>" class="<?php if($value->cid==$cid){
                echo 'selected';
            }?>"><?php echo $value->cname?></a>
        <?php }?>
        <a href="oldMarket/Goods/show_good/13" class="<?php if($cid==13){ echo 'selected';}?>">其他</a>
    </li>
    <li>
        <h3>体育用品</h3>
        <?php foreach ($sport as $value){?>
            <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>" class="<?php if($value->cid==$cid){
                echo 'selected';
            }?>"><?php echo $value->cname?></a>
        <?php }?>
        <a href="oldMarket/Goods/show_good/17" class="<?php if($cid==17){ echo 'selected';}?>">其他</a>
    </li>
    <li>
        <h3>二手衣物</h3>
        <?php foreach ($cloth as $value){?>
            <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>" class="<?php if($value->cid==$cid){
                echo 'selected';
            }?>"><?php echo $value->cname?></a>
        <?php }?>
        <a href="oldMarket/Goods/show_good/21" class="<?php if($cid==21){ echo 'selected';}?>">其他</a>
    </li>
    <li>
        <h3>收藏品</h3>
        <?php foreach ($collection as $value){?>
            <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>" class="<?php if($value->cid==$cid){
                echo 'selected';
            }?>"><?php echo $value->cname?></a>
        <?php }?>
        <a href="oldMarket/Goods/show_good/25" class="<?php if($cid==25){ echo 'selected';}?>">其他</a>
    </li>
</ul>
<div id="good-content">
    <?php if(count($goods)==0){
        echo "<p class='show_blank'>糟糕好像没有相关数据，请查看其他分类</p>";
    }else{
     foreach ($goods as $val){?>
        <div>
            <a href="oldMarket/Goods/good_detail/<?php echo $val->gid?>">
                <img src="assets/images/uploads/<?php echo $val->first_img?>">
                <h3><?php echo $val->gtitle?></h3>
                <p class="good-content"><?php echo $val->gcontent?></p>
                <p><span>发布时间：<?php echo $val->time?></span>&nbsp;<span>点击量：<?php echo $val->hits?></span></p>
            </a>
        </div>
    <?php }}?>
<!--    <div style="height: 200px"></div>-->
<!--    <div><img src="assets/images/flink.jpg"><h3>Auto</h3></div>-->
<!--    <div><img src="images/03.jpg"><h3>Bald eagle</h3></div>-->
<!--    <div><img src="images/04.jpg"><h3>Black swan</h3></div>-->
<!--    <div><img src="images/05.jpg"><h3>Book shelf</h3></div>-->
<!--    <div><img src="images/06.jpg"><h3>Camera</h3></div>-->
<!--    <div><img src="images/07.jpg"><h3>Camera</h3></div>-->
<!--    <div><img src="images/08.jpg"><h3>Vintage camera</h3></div>-->
<!--    <div><img src="images/09.jpg"><h3>Coffee</h3></div>-->
<!--    <div><img src="images/10.jpg"><h3>Cookies</h3></div>-->
<!--    <div></div>-->
<!--    <div></div>-->
<!--    <div></div>-->
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