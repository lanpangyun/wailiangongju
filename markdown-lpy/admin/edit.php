<?php
session_start();
include '../config.php';
if(!$_SESSION['admin']){header("Location:login.php");exit;}
$id = intval($_GET['id']);
$info = mysqli_fetch_assoc(mysqli_query($conn,"select * from links where id=$id"));
if($_POST['sub']){
    $title = $_POST['title'];
    $url = $_POST['url'];
    $sort = intval($_POST['sort']);
    $status = intval($_POST['status']);
    mysqli_query($conn,"update links set title='$title',url='$url',sort=$sort,status=$status where id=$id");
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>编辑外链</title>
<style>
.box{max-width:600px;margin:30px auto}
h2{margin-bottom:20px}
input,textarea,select{width:100%;padding:10px;margin:8px 0;border:1px solid #ddd;border-radius:6px}
button{padding:10px 30px;background:#2266ee;color:#fff;border:none;border-radius:6px}
</style>
</head>
<body>
<div class="box">
    <h2>编辑外链</h2>
    <form method="post">
        <input placeholder="标题" name="title" value="<?php echo $info['title']; ?>" required>
        <textarea placeholder="外链地址" name="url" rows="3" required><?php echo $info['url']; ?></textarea>
        <input placeholder="排序" name="sort" value="<?php echo $info['sort']; ?>">
        <select name="status">
            <option value="1" <?php echo $info['status']==1?'selected':''; ?>>显示</option>
            <option value="0" <?php echo $info['status']==0?'selected':''; ?>>隐藏</option>
        </select>
        <button name="sub" type="submit">保存修改</button>
    </form>
</div>
</body>
</html>
