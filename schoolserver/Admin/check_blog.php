<?php
    require '../connect.php';
    $bid = $_GET['bid'];
    $sql = "update blog set check=1 where blog.bid=$bid";
    $query = mysqli_query($conn,$sql);
    echo "<script>location='manage_catalog.php'</script>";
?>