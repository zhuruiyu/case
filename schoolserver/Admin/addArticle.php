<?php
require '../connect.php';
    if(isset($_POST['sub'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $type = $_POST['type'];
        $now = date('Y-m-d H:i:s');
        $sql = "insert article (article_title,article_content,type,add_time) values('$title','$content','$type','$now')";
        $query = mysqli_query($conn,$sql);
    }
?>
<meta charset="utf-8">
<form action="addArticle.php" method="post" style="width: 500px;height: 400px;margin: 0 auto">
    文章标题:<input type="text" name="title" style="width: 200px;margin-left: 5px"></br>
    文章内容: <textarea name="content" id="" cols="30" rows="10"></textarea>
    <select name="type" id="">
    <option value="1">风景</option>
    <option value="2">美食</option>
    <option value="3">书籍</option>
    </select>
    <input type="submit" name="sub" value="发表">
</form>