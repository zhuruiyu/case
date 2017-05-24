<?php
require  '../connect.php';
$arr = ['啊','大','的年轻哦','的奇偶为假期哦','牌','给','到'];
$img_arr = ['589f0ec386ec21.jpg','589f0f0a9d53f1.png','589f0f989c75d1.jpg'];
for ($m=0;$m<100;$m++){
    $title = '';
    for($i=0;$i<5;$i++){
        $title.=$arr[rand(0,6)];
    }
    $content = '';
    for($i=0;$i<20;$i++){
        $content.=$arr[rand(0,6)];
    }
    $now = date('Y-m-d H:i:s');
    $show_img = $img_arr[rand(0,2)];
    $type = rand(1,3);
    $sql = "insert article (article_title,article_content,type,add_time,show_img) values('$title','$content','$type','$now','$show_img')";
    $query = mysqli_query($conn,$sql);
}
