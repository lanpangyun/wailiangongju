<?php
session_start();
include '../config.php';
if(!$_SESSION['admin']){header("Location:login.php");exit;}
if($_POST['sub']){
    $title = $_POST['title'];
    $url = $_POST['url'];
    $sort = intval($_POST['sort']);
    $status = intval($_POST['status']);
    $time = gettime();
    $sql = "insert into links(title,url,sort,status,addtime) values('$title','$url',$sort,$status,$time)";
    mysqli_query($conn,$sql);
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>新增外链</title>
<style>
.box{max-width:600px;margin:30px auto}
h2{margin-bottom:20px}
input,textarea,select{width:100%;padding:10px;margin:8px 0;border:1px solid #ddd;border-radius:6px}
button{padding:10px 30px;background:#2266ee;color:#fff;border:none;border-radius:6px}
</style>
</head>
<body>
<div class="box">
    <h2>添加新外链</h2>
    <form method="post">
        <input placeholder="标题名称" name="title" required>
        <textarea placeholder="外链完整地址" name="url" rows="3" required></textarea>
        <input placeholder="排序数字（数字越大越靠前）" name="sort" value="0">
        <select name="status">
            <option value="1">前台显示</option>
            <option value="0">前台隐藏</option>
        </select>
        <button name="sub" type="submit">提交保存</button>
    </form>
</div>
</body>
</html>
