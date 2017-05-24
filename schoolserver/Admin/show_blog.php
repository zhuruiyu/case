<?php
    require '../connect.php';
    $sql = "select * from blog where blog.checked = 0";
    $query = mysqli_query($conn,$sql);

?>
<meta charset="utf-8">
<table border="1px" cellspacing="5px" style="margin: 50px auto;width: 700px">
    <tr>
        <th>帖子编号</th>
        <th>帖子标题</th>
        <th>帖子内容</th>
        <th>发布日期</th>
    </tr>
    <?php while($rs = mysqli_fetch_array($query)){?>
        <tr>
            <td><?php echo $rs['bid']?></td>
            <td><?php echo $rs['title']?></td>
            <td><?php echo $rs['content']?></td>
            <td><?php echo $rs['time']?></td>
            <td><a href="manage.php?bid=<?php echo $rs['bid']?>">审核</a></td>
        </tr>
    <?php }?>
</table>
