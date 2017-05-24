<?php
include '../connect.php';
if(isset($_POST['sub'])){
    $father = $_POST['father'];
    $cname = $_POST['cname'];
    $sql = "select * from catalog where cname = '$cname' and father='$father'";
    $query = mysqli_query($conn,$sql);
    $rs = mysqli_fetch_array($query);
    if($rs){
        echo "<script>alert('标签名已存在')</script>";
        echo "<script>location='addCatalog.php'</script>";
    }else{
        $sql = $sql = "insert into catalog(cname,father) values('$cname','$father')";
        $query = mysqli_query($conn,$sql);
        if($query){
            echo "<script>alert('添加成功')</script>";
            echo "<script>location='addCatalog.php'</script>";
        }
    }

}else{
    $sql = "select * from catalog where father = 0";
    $query = mysqli_query($conn,$sql);
}
?>
<a href="manage.php">返回管理页面</a>
<form action="addCatalog.php" method="post">
    <select name="" id="grand">
        <?php
        while($rs1 = mysqli_fetch_array($query)){?>
            <option value="<?php echo $rs1['cid']?>"><?php echo $rs1['cname']?></option>
        <?php
        }
        ?>
    </select>
    <input type="text" name="cname">
    <select name="father" id="father"></select>
    <input type="submit" name="sub" value="添加">
</form>
<script src="jquery-3.0.0.min.js"></script>
<script>
    $(function () {
        $('#grand option').each(function () {
            $(this).attr('selected',false);
        });
        var father = $("#grand").val();
            $.post('getFather.php',{father:father},function (data) {
                var result = eval(data);
                 for (var i=0;i<result.length;i++){

                     $("#father").append("<option value='"+result[i][0]+"'>"+result[i][1]+"</option>");
                 }
            });
       $('#grand').on('change',function () {
           $("#father option").each(function () {
                $(this).remove();
           });
           father = $("#grand").val();
           $.post('getFather.php',{father:father},function (data) {
               var result = eval(data);
               for (var i=0;i<result.length;i++){
                   $("#father").append("<option value='"+result[i][0]+"'>"+result[i][1]+"</option>");
               }
           });
       })
    });
</script>