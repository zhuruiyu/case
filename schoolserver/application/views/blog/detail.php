<?php

?>
<!DOCTYPE html>
<base href="<?php echo site_url()?>">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学习论坛</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/detail.css">
    <link rel="stylesheet" href="assets/css/layer.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/editor/kindeditor.js"></script>
    <script src="assets/js/editor/lang/zh_CN.js"></script>
    <style>
        .newinfor{
            color:red;
            margin-left: 280px;
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
<div id="question-header">
    <div id="header-main" class="warper">
        <div id="header-con">
            <div id="header-title"><?php echo $blog->title ?></div>
            <span id="header-hits"><i class="fa fa-comment"></i>&nbsp;&nbsp;<?php echo $blog->replynum?>&nbsp;条评论</span>
            <span id="header-comment"><i class="fa fa-eye"></i>&nbsp;&nbsp;浏览(<?php echo $blog->hits?>)<span>&nbsp;&nbsp;&nbsp;<?php echo $blog->classfy?></span></span>
        </div>
        <div id="header-writer">
            <div id="about-writer">关于作者</div>
            <span id="writer-name"><?php echo $blog->username?></span>
            <span id="writer-sex"><?php echo $blog->grade?></span>
            <span id="writer-major"><?php echo $blog->major?></span>
        </div>
    </div>
</div>
<div id="question-content" class="warper">
    <div id="content-con">
        <div id="content-main"><?php echo $blog->content?></div>
        <div id="content-connect">
            <?php if($this->session->userdata("login_on")=="TRUE"){
                echo "<button id=\"content-comment\"><i class=\"fa fa-pencil\"></i>&nbsp;写评论</button>";
            }else{
                echo "<span id='unlogin-comment'>未登录</span>";
            }
            ?>

        </div>
    </div>
    <div id="content-reply">
        <div id="reply-content">
            <?php
            $arr=[];
            for($i=0;$i<count($result);$i++) {
                $arr[$i] = 0;
                for ($j = $i; $j < count($result); $j++) {
                    if ($result[$j]->rrid != "0") {
                        $arr[$i]++;
                    }
                }
            }
            if(count($result)==0){
                echo "<p style='font-size: 18px;text-align: center'>暂时没有评论</p>";
            }else{
            foreach ($result as $key=>$value){
                if($value->rrid=="0"){
            ?>
                    <div class="reply-main">
                        <div class="reply-writer">
                            <?php if($key%2==0){
                                echo "<span><i class=\"fa fa-user-o\"></i></span>";
                            }else{
                                echo "<span><i class=\"fa fa-user-circle-o\"></i></span>";
                            }
                            ?>
                            <span><?php echo $value->username?>,</span>
                            <span><?php echo $value->major?></span>
                        </div>
                        <div class="reply-con">
                            <span><?php echo $value->content?></span><br/>
                            <span class="comment">(<?php echo $value->commentnum==""?0:$arr[$key];?>)条评论</span>
                            <?php if($value->commentnum!=""){
                                echo "<span class='comment font' onclick='show($value->bid,$value->replayid)'>查看全部评论</span>";
                            }else{
                                echo "<span class='comment font' onclick='show($value->bid,$value->replayid)'>添加评论</span>";
                            }?>

                        </div>

                    </div>
            <?php
                }
            }
            }
            ?>
        </div>
        <ul id="content-list">
            <li><i class="fa fa-mail-reply"></i>&nbsp;<a href="<?php echo site_url("index/user/index")?>">返回首页</a></li>
        </ul>
        <div id="show-top" title="返回顶部">
            <i class='fa fa-angle-double-up'></i>
        </div>
    </div>
    <div id="user-reply">
        <div id="writer-infor">
            <span><?php echo base64_decode($this->session->uname)?></span>
            <span>最多输入200个字</span>
        </div>
        <textarea id="contentqq" name="content" style="width:660px;height:200px;visibility:hidden;">
            </textarea>
        <button id="sub">提交</button>
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
    //函数立即调用
    (function () {
        KindEditor.ready(function(K) {
            K.each({
                'plug-align' : {
                    name : '对齐方式',
                    method : {
                        'justifyleft' : '左对齐',
                        'justifycenter' : '居中对齐',
                        'justifyright' : '右对齐'
                    }
                },
                'plug-order' : {
                    name : '编号',
                    method : {
                        'insertorderedlist' : '数字编号',
                        'insertunorderedlist' : '项目编号'
                    }
                },
                'plug-indent' : {
                    name : '缩进',
                    method : {
                        'indent' : '向右缩进',
                        'outdent' : '向左缩进'
                    }
                }
            },function( pluginName, pluginData ){
                var lang = {};
                lang[pluginName] = pluginData.name;
                KindEditor.lang( lang );
                KindEditor.plugin( pluginName, function(K) {
                    var self = this;
                    self.clickToolbar( pluginName, function() {
                        var menu = self.createMenu({
                            name : pluginName,
                            width : pluginData.width || 100
                        });
                        K.each( pluginData.method, function( i, v ){
                            menu.addItem({
                                title : v,
                                checked : false,
                                iconClass : pluginName+'-'+i,
                                click : function() {
                                    self.exec(i).hideMenu();
                                }
                            });
                        })
                    });
                });
            });
            window.editor=K.create('#contentqq', {
                themeType : 'qq',
                items : [
                    'bold','italic','underline','fontname','fontsize','forecolor','hilitecolor','plug-align','plug-order','plug-indent','link'
                ]
            });
        });
    })();
    //
    $(function () {
        //判断评论框是否显示
        var flag=<?php
        if($this->session->userdata("login_on")=="TRUE"){
            echo "true";
       }else{
            echo "false";
        }
        ?>;
        if(!flag){
            var $userReply=$("#user-reply");
            $userReply.remove();
        }
        //点击提交按钮，提交信息
        var $sub=$("#sub");
        $sub.on("click",function () {
            editor.sync();
            var $content=$.trim($("#contentqq").val());
            var $bid=<?php echo $blog->bid?>;
            var $wid=<?php echo $blog->wid?>;
            var $userReply=$("#user-reply");
            $userReply.find(".newinfor").remove();
            if($content.length==0){
                $userReply.append($("<span class='newinfor'>*请输入内容</span>"));
            }else if($content.length>=200){
                $userReply.append($("<span class='newinfor'>*输入内容过长</span>"));
            }else{
                $.post("<?php echo site_url("blog/Blog/writeReply")?>",{"bid":$bid,"wid":$wid,"content":$content},function (data) {
                    if(data=="success"){
                        $userReply.append($("<span class='newinfor'>*发表成功</span>"));
                    }
                });
            }
        });
        var $contentComment=$("#content-comment");
        //点击评论，滚动到底部
        $contentComment.on("click",function () {
            //滚动条滚动到底部
            $(window).scrollTop($(document).height());
        });
        //添加返回顶部按钮
        $(window).scroll(function () {
            var showTop=$("#show-top");
            if($(window).scrollTop()>100){
                showTop.css("display","block");
            }else{
                showTop.css("display","none");
            }
        });
        var showTop=$("#show-top");
        showTop.on("click",function () {
            $('html,body').animate({
                scrollTop:'0px'
            },1000,function () {
            });
        });

        //点击未登录
        var unloginComment=$("#unlogin-comment");
        unloginComment.on("click",function () {
            location='<?php echo site_url("index/user/index")?>';
        })

    });
    //显示多级评论
    function show(index,flag) {
        var inx=<?php if($this->session->userdata("login_on")=="TRUE") echo 1;else echo 0;?>;
        if(inx){
            $.post("<?php echo  site_url("blog/blog/get_moreComment")?>",{"index":index,"flag":flag},function (data) {
            var json=JSON.parse(data);
            var container=$("<div class='main-container'></div>");
            if(json!=null){
                var arr=[];
                for(var i=0;i<json.length;i++){
                    var total=$("<div class=main-total></div>");
                    var title=$("<div class='main-title'><span class='main-writer'><i class='fa fa-user-o'></i>&nbsp;&nbsp;"+ json[i].username+"</span><span class='main-time'>"+ json[i].time +"</span></div>");
                    var content=$("<div class='main-content'>"+ json[i].content +"</div>");
                    var comment=$('<span class="main-comment">评论</span>');
                    comment[0].num=json[i].replayid;
                    comment[0].total=total;
                    comment[0].flag=0;
                    comment.on("click",function () {
                        if($(this)[0].flag==0){
                            reply($(this)[0].num,$(this)[0].total);
                            $(this)[0].flag++;
                        }else{
                            removeReply($(this)[0].total);
                            $(this)[0].flag=0;
                        }
                    });
                    total.append(title).append(content).append(comment);
                    container.append(total);
                }
                var layer=new Dialog();
                layer.open({
                    url:container
                });
            }else{
                var layer=new Dialog();
                layer.open();
            }
            $(".layer-btn").on("click",function () {
                var $layerCon=$(".layer-con");
                //flag===当前回复贴的replayid
                //$blog->wid==当前帖子的作者
                //$blog->bid==当前帖子的id
                if($.trim($layerCon.val())==""){
                    var str="请输入评论内容";
                    maininfor(str);
                }else{
                    var bid=<?php echo $blog->bid?>;//当前帖子的id
                    var rid=<?php echo $blog->wid?>;//当前帖子的作者
                    var rrid=flag;//当前回复贴的replayid
                    var content=$.trim($layerCon.val());//回复的内容
                    var arr={
                        "bid":bid,
                        "wid":rid,
                        "rrid":rrid,
                        "content":content
                    };
                    $.post("<?php echo site_url("blog/Blog/writeReply")?>",arr,function (data) {
                        if(data=="success"){
                            var str="评论成功";
                            maininfor(str);
                            $layerCon.val("");
                        }else{
                            var str="评论失败";
                            maininfor(str);
                        }
                    })
                }
            });
            });
            $("html,body").css("overflowY","hidden");
        }else{
            location='<?php echo site_url("index/user/index")?>';
        }


        function maininfor(title) {
            var oSpan=$("<span class='layer-infor'>"+ title +"</span>");
            var layerContent=$(".layer-content");
            layerContent.append(oSpan);
            setTimeout(function () {
                $(".layer-infor").remove();
            },2000);
        }

        //对多级评论的评论，添加评论框
        function reply(index,total) {
            total.append("<input type='text' placeholder='回复' class='total-con'><button class='total-btn'>回复</button>");
            var btn=$(".total-btn",total);
            btn.on("click",function () {
                var totalContent=$(".total-con",total);
                if($.trim(totalContent.val())==""){
                    var str="请输入回复内容";
                    maininfor(str);
                }else{
                    var bid=<?php echo $blog->bid?>;//当前帖子的bid
                    var rid=<?php echo $blog->wid?>;//当前帖子的作者
                    var rrid=index;//当前回复贴的replayid
                    var content=$.trim(totalContent.val());
                    var arr={
                        "bid":bid,
                        "wid":rid,
                        "rrid":rrid,
                        "content":content
                    };
                    $.post("<?php echo site_url("blog/Blog/writeReply")?>",arr,function (data) {
                        if(data=="success"){
                            var str="评论成功";
                            maininfor(str);
                            totalContent.val("");
                        }else{
                            var str="评论失败";
                            maininfor(str);
                        }
                    });
                }
            })
        }
        //对多级评论的评论，移除评论框
        function removeReply(total) {
            $(".total-con",total).remove();
            $(".total-btn",total).remove();
        }


    }
    //加载遮罩层
    function Dialog(){

    }
    Dialog.prototype.open= function (options) {
        var that=this;
        var setting={
            width:500,
            height:"80%",
            title:"评论",
            url:""
        };
        $.extend(setting,options);
        this.container=$('<div class="layer-container"></div>');
        var $mask=$('<div class="layer-mask"></div>').on('click', function () {
            that.close();
        });
        var $content=$('<div class="layer-content"></div>').css(
            {
                width:setting.width,
                height:setting.height,
                marginLeft:-setting.width/2,
                marginTop:-setting.height/2
            }
        );
        var $layerTitle=$('<div class="layer-title"></div>');
        var $title=$('<span class="title">'+ setting.title +'</span>');
        var $close=$('<span class="close">[x]</span>').on('click', function () {
            that.close();
        });
        var $main=$('<div class="layer-main"></div>').append(setting.url);
        var $comment=$("<div class='layer-comment'><input type='text' class='layer-con' placeholder='回复'/><button class='layer-btn'>回复</button></div>");
        $layerTitle.append($title).append($close);
        $content.append($layerTitle).append($main).append($comment);
        this.container.append($mask).append($content);
        $(document.body).append(this.container);
    };
    Dialog.prototype.close= function () {
        this.container.remove();
        console.log("aaa");
        $("html,body").css("overflowY","auto");
    };
</script>
</html>
