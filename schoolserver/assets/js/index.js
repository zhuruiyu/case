/*首页js*/
/*like*/

$(function () {
    //切换注册登录div
    var $logbtn=$("#logbtn");
    var $regbtn=$("#regbtn");
    var $reglogbtn=$("#reglogbtn");
    var $showperson=$("#showPerson");
    var $contentinfor=$("#content-infor");
    var $log=$("#login");
    var $reg=$("#register");
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
    //失去焦点的时候进行AJAX查询，判读用户是否登录
    $ruser.blur(function () {
        if($ruser.val()!=""){
            if(!$ruser.val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                $ruser.val("");
                //如果不匹配，则添加一个span，提示错误信息
                $ruser.after("<span style='color:red;'>*输入格式错误</span>");
            }else{
                $.post("php/check.php",{username:$ruser.val()},function (data) {
                    if(data=="error"){
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
             $.post("php/sendcode.php",{username:$ruser.val().replace(/\ +/g,""),password:$rpass.val().replace(/\ +/g,"")},function (data) {
                 if(data=="error"){
                     alert("注册失败,请您重新注册");
                 }else if(data=="success"){
                     alert("注册成功,请您到邮箱激活账号");
                     setTimeout(function () {
                         $regsub.attr("disabled","disabled");
                     },0);
                     setTimeout(function () {
                      $regsub.attr("disabled",false);
                     },30000);
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
        }else{
            $.post('user/login',{username:$luser.val().replace(/\ +/g,""),password:$lpass.val().replace(/\ +/g,"")},function (data) {
                //解析为json,{"uid":xx,"uname":xxx,"state":xxx}
                //console.log(data);
                // var json=JSON.parse(data);
                // if(json["state"]=="success"){
                //     $log.hide();
                //     $reg.hide();
                //     $reglogbtn.hide();
                //     $showperson.show();
                // }else if(json["state"]=="error"){
                //     $contentinfor.html("*密码输入错误");
                // }
            });
        }
    });



});
