<?php
require '../connect.php';
    if(isset($_COOKIE['id'])){
        $name = $_COOKIE['name'];
        if(isset($_GET['bid'])){
            $bid = $_GET['bid'];
            $sql = "update blog set checked=1 where blog.bid=$bid";
            $query = mysqli_query($conn,$sql);
            echo "<script>alert('审核成功')</script>";
            echo "<script>location.href='manage.php'</script>";
        }
    }else{
        echo "<script>alert('您未登录')</script>";
        echo "<script>location='login.html'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>校园百事通后台管理界面</title>
    <link rel="stylesheet" href="css/manage.css">
</head>
<body>
<header>
    <div id="logo"></div>
    <div id="title">校园百事通后台管理界面</div>
</header>
<div id="content">
    <aside>
        <ul id="nav-list">
            <li>用户信息</li>
            <li>论坛信息</li>
            <li>商品信息</li>
            <li>消息</li>
            <li><a href="addCatalog.php">添加标签名</a></li>
            <li><a href="addArticle.php">添加文章</a></li>
        </ul>
    </aside>
    <div class="container welcome active">
        欢迎您，尊敬的<?php echo $name?>
    </div>

    <div class="container user ">
        <div><a href="manage.php?index=1">显示全部</a></div>
        <form action="manage.php" method="get" id="search-box">
            <input type="text" name="keyword">
            <input type="submit" name="sub" value="查询" id="search">
            <input type="hidden" value="1" name="index">
        </form>
        <table border="1px solid" id="user-list">
            <tr>
                <th>id</th>
                <th>user</th>
                <th>password</th>
                <th>state</th>
                <th>regdate</th>
                <th>actdate</th>
            </tr>
        <?php
            $sql = "select * from user where admin = 0";
            $query = mysqli_query($conn,$sql);
            $i = 0;
            $limit = 6;
            while ($result = mysqli_fetch_array($query)){
                $i++;
            }
            $number = $i/$limit;
            if(isset($_GET['sub'])){
                $keyword = $_GET['keyword'];
                $str = "and user like '%$keyword%'";
            }else{
                $str = '';
            }
            if(isset($_GET['plus'])){
                $index = $_GET['index'];
                $plus = $_GET['plus'];
                $index = $index+$plus;
//                echo "<script>alert('$index');alert('$plus')</script>";
                $nindex = $index*$limit;
                $sql = "select * from user where admin=0 $str order by regdate limit ".$nindex.",".$limit;
            }else {
                $index = 0;
                $sql = "select * from user where admin=0 $str order by regdate limit 0," . $limit;
            }
            $query = mysqli_query($conn,$sql);

            while ($result = mysqli_fetch_array($query)){
                echo "<tr>";
                echo "<td>".$result['uid']."</td>";
                echo "<td>".$result['user']."</td>";
                echo "<td>".$result['password']."</td>";
                echo "<td>".$result['state']."</td>";
                echo "<td>".$result['regdate']."</td>";
                echo "<td>".$result['actdate']."</td>";
                echo "<td><a href='user-manage/delete.php?uid=".$result['uid']."'>删除</a></td>";
                echo "</tr>";
            }
        ?>
        </table>
        <a href="manage.php?index=<?php echo $index?>&plus=<?php
        if($index>0){
            echo -1;
        }?>&group=1"><?php if($index>=1) echo '上一页'?></a>
        <a href="manage.php?index=<?php echo $index?>&plus=<?php if($index<$number){
             echo 1;
        }?>&group=1"><?php if($index<$number-1) echo '下一页'?></a>
    </div>
    <div class="container blog"><?php require 'show_blog.php'?></div>
    <div class="container cargo"><?php require 'show_goods.php'?></div>
    <div class="container message">4</div>
</div>


</body>
<script src="../assets/js/jquery-3.0.0.min.js"></script>
<script src="js/manage.js"></script>
</html>
