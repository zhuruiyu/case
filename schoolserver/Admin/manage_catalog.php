<?php
    require '../connect.php';
    $sql = "select * from catalog";
    $query = mysqli_query($conn,$sql);
    echo "<table>";
    while ($result = mysqli_fetch_array($query)){
?>
        <tr>
            <td><?php echo $result['cid']?></td>
            <td><?php echo $result['cname']?></td>
            <td><?php echo $result['father']?></td>
            <td><a href="del_catalog.php?cid=<?php echo $result['cid']?>">删除</a></td>
        </tr>
<?php }
    echo "</table>";
?>
