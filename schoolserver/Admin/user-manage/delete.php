<?php
include "../../connect.php";
if(isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $sql = "delete from user where uid=".$uid;
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<script>alert('删除成功')</script>";
        echo "<script>location='../manage.php'</script>";
    }else{
        echo "<script>alert('删除失败')</script>";
        echo "<script>location='../manage.php'</script>";
    }
}