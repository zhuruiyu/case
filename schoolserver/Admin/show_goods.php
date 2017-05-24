<?php
    require '../connect.php';
    $sql = "select * from goods,user where goods.uid = user.uid";
    $query = mysqli_query($conn,$sql);
?>
<meta charset="utf-8">
<table border="1px" cellspacing="5px" style="margin: 50px auto;width: 700px">
    <tr>
        <th>商品编号</th>
        <th>商品标题</th>
        <th>商品发布人</th>
        <th>发布日期</th>
    </tr>
    <?php while($rs = mysqli_fetch_array($query)){?>
        <tr>
            <td><?php echo $rs['gid']?></td>
            <td><?php echo $rs['gtitle']?></td>
            <td><?php echo $rs['user']?></td>
            <td><?php echo $rs['time']?></td>
            <td><a href="del_goods.php?gid=<?php echo $rs['gid']?>&imgSrc=<?php echo $rs['imgSrc']?>">删除</a></td>
        </tr>
    <?php }?>
</table>