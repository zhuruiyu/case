<?php defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<base href="<?php echo site_url()?>">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学习论坛</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery-3.0.0.min.js"></script>
    <script src="assets/js/editor/kindeditor.js"></script>
    <script src="assets/js/editor/lang/zh_CN.js"></script>
    <link rel="stylesheet" href="assets/css/writeblog.css">
    <style>
        .infor{
            color:red;
            margin-left: 20px;
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
    <div id="content-main">
        <div id="content-title">
            <div id="content-infor">
                发表帖子
            </div>
            <span><label for="">标题:</label><input type="text" name="title" id="title"></span>
            <span>
                <label for="classfiy">分类：</label>
                <input type="radio" value="校园要闻" name="classfiy">校园要闻
                <input type="radio" value="热点问题" name="classfiy">热点问题
                <input type="radio" value="学习交流" name="classfiy">学习交流
            </span>
        </div>
        <div id="content-con">
            <label for="">内容:</label><br /><br />
            <textarea id="contentqq" name="content" style="width:700px;height:300px;visibility:hidden; ">

            </textarea>
        </div>
        <div id="content-sub">
            <button id="sub">发表</button>
        </div>

    </div>
    <ul id="content-list">
        <li><a href="<?php echo site_url("blog/blog/myblog")?>">我的发帖</a></li>
        <li><a href="<?php echo site_url("blog/blog/commentblog")?>">发帖回复</a></li>
        <li><a href="<?php echo site_url("blog/blog/index")?>">返回讨论</a></li>
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
    $(function () {
        $("#sub").on("click",function () {
            editor.sync();
            var $title=$.trim($("#title").val());
            var $content=$.trim($("#contentqq").val());
            var $classfy=$('input:radio[name="classfiy"]:checked').val();
            var $contentSub=$("#content-sub");
            $contentSub.find("span").remove();
            console.log($classfy);
            if($title==""){
                $contentSub.append($("<span class='infor'>*请输入标题</span>"));
            }else if($content==""){
                $contentSub.append($("<span class='infor'>*请输入内容</span>"));
            }else if($classfy==""){
                $contentSub.append($("<span class='infor'>*请选择分类</span>"));
            }else{
                $.post("<?php echo site_url("blog/Blog/writeData")?>",{"title":$title,"content":$content,"classfy":$classfy},function (data) {
                    if(data=="success"){
                        $contentSub.append($("<span class='infor'>*发表成功</span>"));
                    }else{
                        $contentSub.append($("<span class='infor'>*发表失败</span>"));
                    }
                })
            }
        });
    });
</script>
</html>
