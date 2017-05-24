<!--二手市场首页-->
<!--翟佳羽-->
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base  href="<?php echo site_url()?>"/>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/oldMarket.js"></script>
</head>
<body>
<!--头部导航菜单-->
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
<!--主体-->
<div id="container">
    <div id="title">二手市场<i class="fa fa-shopping-cart"></i></div>
    <form id="search" method="get" action="oldMarket/Goods/search">
        <input type="text" class="search" placeholder="搜索" name="key"><div class="search-btn"><i class="fa fa-search" aria-hidden="true"></i></div>
        <ul class="search-tips">

        </ul>
    </form>
    <div id="nav">
        <ul id="nav-list">
            <li>
                <span></span>二手书籍
                <a href="oldMarket/Goods/search?key=计算机">计算机</a>
                <a href="oldMarket/Goods/search?key=小说">小说</a>
                <a href="oldMarket/Goods/search?key=财经">财经</a>
                <table class="nav-more" cellspacing="10px">
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">工业技术</a></div>
                            <div class="nav-content">
                                <?php foreach ($industry as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">中外小说</a></div>
                            <div class="nav-content">
                                <?php foreach ($novel as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">文史政治</a></div>
                            <div class="nav-content">
                                <?php foreach ($history as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">其他</a></div>
                            <div class="nav-content">
                                <a href="oldMarket/Goods/show_good/9">其他</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <span></span>电子产品
                <a href="oldMarket/Goods/search?key=充电器">充电器</a>
                <a href="oldMarket/Goods/search?key=电脑">电脑</a>
                <a href="oldMarket/Goods/search?key=手机">手机</a>
                <table class="nav-more" cellspacing="10px">
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">手机</a></div>
                            <div class="nav-content">
                                <?php foreach ($phone as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">相机</a></div>
                            <div class="nav-content">
                                <?php foreach ($camera as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">电脑</a></div>
                            <div class="nav-content">
                                <?php foreach ($computer as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">其他</a></div>
                            <div class="nav-content">
                                <a href="oldMarket/Goods/show_good/13">其他</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <span></span>体育用品
                <a href="oldMarket/Goods/search?key=篮球">篮球</a>
                <a href="oldMarket/Goods/search?key=足球">足球</a>
                <a href="oldMarket/Goods/search?key=乒乓球">自行车</a>
                <table class="nav-more" cellspacing="10px">
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">球类</a></div>
                            <div class="nav-content">
                                <?php foreach ($ball as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">自行车</a></div>
                            <div class="nav-content">
                                <?php foreach ($bike as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">游泳</a></div>
                            <div class="nav-content">
                                <?php foreach ($swim as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">其他</a></div>
                            <div class="nav-content">
                                <a href="oldMarket/Goods/show_good/17">其他</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <span></span>二手衣物
                <a href="oldMarket/Goods/search?key=长袖">长袖</a>
                <a href="oldMarket/Goods/search?key=外套">外套</a>
                <a href="oldMarket/Goods/search?key=鞋子">鞋子</a>
                <table class="nav-more" cellspacing="10px">
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">女装</a></div>
                            <div class="nav-content">
                                <?php foreach ($women as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">男装</a></div>
                            <div class="nav-content">
                                <?php foreach ($man as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">运动鞋</a></div>
                            <div class="nav-content">
                                <?php foreach ($shoes as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">其他</a></div>
                            <div class="nav-content">
                                <a href="oldMarket/Goods/show_good/21">其他</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </li>
            <li>
                <span></span>收藏品
                <table class="nav-more" cellspacing="10px">
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">手表</a></div>
                            <div class="nav-content">
                                <?php foreach ($watch as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">饰品</a></div>
                            <div class="nav-content">
                                <?php foreach ($accessories as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">收藏品</a></div>
                            <div class="nav-content">
                                <?php foreach ($collection as $value){?>
                                    <a href="oldMarket/Goods/show_good/<?php echo $value->cid?>"><?php echo $value->cname?></a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div class="nav-title"><a href="oldMarket/Goods/show_good/10">其他</a></div>
                            <div class="nav-content">
                                <a href="oldMarket/Goods/show_good/25">其他</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </li>
        </ul>
        <div id="carousel">
            <ul class="content">
                <li><img src="assets/images/oldMarket/c-img1.jpg" alt=""></li>
                <li><img src="assets/images/oldMarket/c-img2.jpg" alt=""></li>
                <li><img src="assets/images/oldMarket/c-img3.jpg" alt=""></li>
                <li><img src="assets/images/oldMarket/c-img4.jpg" alt=""></li>
            </ul>
            <ul class="control-list">
                <li class="selected"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <div class="left-btn control-btn"></div>
            <div class="right-btn control-btn"></div>
        </div>
        <div id="news">
            <ul class="function-list">
                <li><a href="oldMarket/Goods/put_good">点击发布</a></li>
                <li><a href="oldMarket/Goods/my_goods">我的发布</a></li>
                <li><a href="oldMarket/Message/my_msg_receive">我的私信</a></li>
            </ul>
            <div class="news-list">
                <h3>最新发布</h3>
                <ul>
                    <?php foreach ($latest_goods as $value){?>
                    <li>
                        <span><?php echo $value->time?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>"><?php echo $value->gtitle?></a>
                    </li>
                    <?php }?>
<!--                    <li><span>time</span>&nbsp;<span>111111111</span></li>-->
<!--                    <li><span>time</span>&nbsp;<span>111111111</span></li>-->
<!--                    <li><span>time</span>&nbsp;<span>111111111</span></li>-->
<!--                    <li><span>time</span>&nbsp;<span>111111111</span></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="father-catalog-nav">
        <h3 class="fCatalog-title">
            <img src="assets/images/oldMarket/smallbook.jpg" alt="">
            <span style="">二手书籍</span></h3>
        <aside class="sCatalog-title"></aside>
        <table class="fCatalog-content" cellspacing="10px">
            <?php
            $i = 0;
            foreach ($book_result as $value) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td>
                    <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>">
                        <div class="good-img"><img src="assets/images/uploads/<?php echo $value->first_img?>" alt="暂无图片"></div>
                        <div class="good-content"><?php echo $value->gtitle ?></div>
                        <div class="good-message">发布时间:<?php echo $value->time ?> 点击数<?php echo $value->hits ?></div>
                    </a>
                </td>

                <?php
                $i++;
                if ($i % 3 == 0) {
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <div class="divide-img"></div>
    </div>
    <div class="father-catalog-nav">
        <h3 class="fCatalog-title">
            <img src="assets/images/oldMarket/smallcomputer.jpg" alt="">
            <span>电子产品</span>
        </h3>
        <aside class="sCatalog-title"></aside>
        <table class="fCatalog-content" cellspacing="10px">
            <?php
            $i = 0;
            foreach ($tec_result as $value) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td>
                    <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>">
                        <div class="good-img"><img src="assets/images/uploads/<?php echo $value->first_img?>" alt="暂无图片"></div>
                        <div class="good-content"><?php echo $value->gtitle ?></div>
                        <div class="good-message">发布时间:<?php echo $value->time ?> 点击数<?php echo $value->hits ?></div>
                    </a>
                </td>

                <?php
                $i++;
                if ($i % 3 == 0) {
                    echo '</tr>';
                }

            }
            ?>
        </table>
        <div class="divide-img"></div>
    </div>
    <div class="father-catalog-nav">
        <h3 class="fCatalog-title">
            <img src="assets/images/oldMarket/smallsport.jpg" alt="">
            <span>体育用品</span>
        </h3>
        <aside class="sCatalog-title"></aside>
        <table class="fCatalog-content" cellspacing="10px">
            <?php
            $i = 0;
            foreach ($sport_result as $value) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td>
                    <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>">
                        <div class="good-img"><img src="assets/images/uploads/<?php echo $value->first_img?>" alt="暂无图片"></div>
                        <div class="good-content"><?php echo $value->gtitle ?></div>
                        <div class="good-message">发布时间:<?php echo $value->time ?> 点击数<?php echo $value->hits ?></div>
                    </a>
                </td>

                <?php
                $i++;
                if ($i % 3 == 0) {
                    echo '</tr>';
                }

            }
            ?>
        </table>
        <div class="divide-img"></div>
    </div>
    <div class="father-catalog-nav">
        <h3 class="fCatalog-title">
            <img src="assets/images/oldMarket/smallcloth.jpg" alt="">
            <span>二手衣物</span>
        </h3>
        <aside class="sCatalog-title"></aside>
        <table class="fCatalog-content" cellspacing="10px">
            <?php
            $i = 0;
            foreach ($cloth_result as $value) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td>
                    <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>">
                        <div class="good-img"><img src="assets/images/uploads/<?php echo $value->first_img?>" alt="暂无图片"></div>
                        <div class="good-content"><?php echo $value->gtitle ?></div>
                        <div class="good-message">发布时间:<?php echo $value->time ?> 点击数<?php echo $value->hits ?></div>
                    </a>
                </td>

                <?php
                $i++;
                if ($i % 3 == 0) {
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <div class="divide-img"></div>
    </div>
    <div class="father-catalog-nav">
        <h3 class="fCatalog-title">
            <img src="assets/images/oldMarket/smallother.jpg" alt="">
            <span>收藏品</span>
        </h3>
        <aside class="sCatalog-title"></aside>
        <table class="fCatalog-content" cellspacing="10px">
            <?php
            $i = 0;
            foreach ($collection_result as $value){
                if($i%3==0){
                    echo "<tr>";
                }
            ?>
            <td>
                <a href="oldMarket/Goods/good_detail/<?php echo $value->gid?>">
                    <div class="good-img"><img src="assets/images/uploads/<?php echo $value->first_img?>" alt="暂无图片"></div>
                    <div class="good-content"><?php echo $value->gtitle ?></div>
                    <div class="good-message">发布时间:<?php echo $value->time ?> 点击数<?php echo $value->hits ?></div>
                </a>
            </td>

            <?php
                $i++;
                if ($i % 3 == 0) {
                    echo '</tr>';
                }
            }
            ?>
        </table>
        <div class="divide-img"></div>
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