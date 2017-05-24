<?php
require "../connect.php";
if(isset($_POST['user'])) {
    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    $illegal = ['&', '+', '=', '$', '!'];
    $isLegal = true;
    if($pwd == '' || $user==''){              //判断用户名密码是否为空
        echo "<script>alert('用户名或密码为空')</script>";
        echo "<script>location='login.html'</script>";
    }
    for ($i = 0; $i < strlen($pwd); $i++) {
        for ($j = 0; $j < count($illegal); $j++) {
            if ($pwd[$i] == $illegal[$j]) {
                $isLegal = false;
            }
        }
    }
    if ($isLegal) {                               //判断密码是否合法
        $sql = "select * from user where user='$user' and password='$pwd'";    //密码验证
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);
        if ( $result['admin']== 1) {
            setcookie('id',$result['uid'],time()+600);     //将uid设置成cookie
            setcookie('name',$result['user'],time()+600);  // 将user设置为cookie

            echo "<script>alert('登录成功')</script>";
            echo "<script>location='manage.php'</script>";
        } elseif($result['admin'] == 0) {
            echo "<script>alert('您无权限登录!')</script>";
            echo "<script>location='login.html'</script>";
        }else{
            echo "<script>alert('用户名或密码错误!')</script>";
            echo "<script>location='login.html'</script>";
        }
    } else {
        echo "<script>alert('密码不合法')</script>";
        echo "<script>location='login.html'</script>";
    }
}