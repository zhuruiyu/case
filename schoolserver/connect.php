<?php
$conn = mysqli_connect('localhost','root','');if(!$conn)die("数据库连接失败");
mysqli_set_charset($conn,'utf8');
mysqli_select_db($conn,'schoolserver');

?>