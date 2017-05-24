<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>"/>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/oldMarket.css">
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
<form action="index.php/oldMarket/Goods/do_put_good" method="post" id="put-good" enctype="multipart/form-data">
    <input type="text" placeholder="标题" name="title" class="good-title"><span class="mark">* 标题不超过20个字</span>
    <textarea name="content" id="" cols="30" rows="10" placeholder="物品介绍" class="good-content"></textarea>
    <div id="choose-catalog">
        <div class="Catalog">
            <div class="tip"><span class="mark">*</span>请选择一级标题:</div>
            <select name="" id="grand" class="fCatalog">
                <?php foreach ($fCatalog as $value){?>
                    <option value="<?php echo $value->cid?>"><?php echo $value->cname?></option>
                <?php }?>
            </select>
        </div>
        <div class="Catalog">
            <div class="tip"><span class="mark">*</span>请选择二级标题:</div>
            <select name="father" id="father" >
                <option value="">请选择一个标签</option>
            </select>
        </div>
        <div class="Catalog">
            <div class="tip"><span class="mark">*</span>请选择三级标题:</div>
            <select name="cname" id="cname" >
                <option value="">请选择一个标签</option>
            </select>
        </div>
    </div>
    <div class="price">
        <span>价格</span>
        <input type="number" name="price">元
    </div>
    <ul class="upload-list">
        <li><span class="mark">*请选择你要上传的图片，最多不超过五张</span></li>
        <li><input type="file" name="files[]">这是第一张图片</li>
    </ul>
    <div id="sub-btn">
        <div class="btn-mask"></div>
        <input type="submit" class="sub-btn" value="提交" disabled>
    </div>

</form>
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
        //动态添加上传文件的按钮
        $(function () {
            var max = 5;
            var now = 0;
            function clone() {
                $input = $('<li><input type="file" name="files[]"></li>');
                $input.one('change',function () {
                    now++;
                    if(now>=max){
                        return false;
                    }
                    var $file = clone();
                    $(this).after($file)
                });
                return $input;
            }
            $('form input[type="file"]').one("change",function () {
                now++;
                if(now>=max){
                    return false;
                }
                var $file = clone();
                $(this).parent().after($file);
            });
        });
        //动态获取标签
        $('#grand option').each(function () {
            $(this).attr('selected',false);
        });
        var father = $("#grand").val();
        $.post('<?php echo site_url("oldMarket/Goods/get_father")?>',{father:father},function (data) {
            var result = eval(data);
            for (var i=0;i<result.length;i++){

                $("#father").append("<option value='"+result[i].cid+"'>"+result[i].cname+"</option>");
            }
        });
        $('#grand').on('change',function () {
            $("#father option").each(function () {
                $(this).remove();
            });
            father = $("#grand").val();
            $('#father').append("<option>请选择一个标签</option>");
            $.post('<?php echo site_url("oldMarket/Goods/get_father")?>',{father:father},function (data) {
                var result = eval(data);
                for (var i=0;i<result.length;i++){
                    $("#father").append("<option value='"+result[i].cid+"'>"+result[i].cname+"</option>");
                }
            });
        });
        $('#father').on('change',function () {
            $("#cname option").each(function () {
                $(this).remove();
            });
            father = $("#father").val();
            $('#cname').append("<option>请选择一个标签</option>");
            $.post('<?php echo site_url("oldMarket/Goods/get_father")?>',{father:father},function (data) {
                var result = eval(data);
                if(result==''){
                    $("#cname").append("<option value='other'>其他</option>");
                }
                for (var i=0;i<result.length;i++){
                    $("#cname").append("<option value='"+result[i].cid+"'>"+result[i].cname+"</option>");
                }
            });
        });
        $('#sub-btn .btn-mask').mouseover(function () {

            if($('.good-title').val()==''||$('.good-content').val()==''||$('#cname').val()==''){
                alert('带*标记的请务必填写');
            }else if($('.good-title').val().length>20){
                alert('标题过长');
            }else{
                var $file = $('form input[type="file"]').last();
                if($file.val()==''){
                    $file.remove();
                }
                $('.sub-btn').attr('disabled',false);
                $(this).hide();
            }
        })
    });
</script>
</html>