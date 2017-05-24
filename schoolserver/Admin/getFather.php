<?php
include '../connect.php';
$fater = $_POST['father'];
$sql = "select * from catalog where father='$fater'";
$query = mysqli_query($conn,$sql);
$rs = mysqli_fetch_all($query);
$json = json_encode($rs);
echo $json;

