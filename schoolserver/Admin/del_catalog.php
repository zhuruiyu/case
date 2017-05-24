<?php
    require '../connect.php';
    $cid = $_GET['cid'];
    $sql = "delete from catalog where cid = '$cid'";
    $query = mysqli_query($conn,$sql);
    echo "<script>location='manage_catalog.php'</script>";
?>