<?php
if(isset($_GET['gid'])){
    require '../connect.php';
    $gid = $_GET['gid'];
    $imgSrc = $_GET['imgSrc'];
    $sql = "select * from img where imgSrc = '$imgSrc'";
    $query = mysqli_query($conn,$sql);
    while($rs = mysqli_fetch_array($query)){
        unlink($rs['imgPath']);
    }
    $sql = "delete from img where imgSrc = '$imgSrc'";
    $query = mysqli_query($conn,$sql);
    if($query){
        $sql = "delete from goods where gid = '$gid'";
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "<script>location='manage.php'</script>";
        }
    }
}