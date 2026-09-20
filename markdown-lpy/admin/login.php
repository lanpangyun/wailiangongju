<?php
session_start();
include '../config.php';
if($_SESSION['admin']){
    header("Location:index.php");exit;
}
if($_POST['sub']){
    $user = $_POST['user'];
    $pwd = md5pwd($_POST['pwd']);
    $sql = "select * from admin where username='$user' and password='$pwd'";
    $r = mysqli_query($conn,$sql);
    if(mysqli_fetch_assoc($r)){
        $_SESSION['admin'] = $user;
        header("Location:index.php");
    }else{
        $msg = "账号密码错误";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>后台登录</title>
<style>
body{background:#f5f7fa;display:flex;align-items:center;justify-content:center;height:100vh;margin:0}
.login{width:360px;background:#fff;padding:30px;border-radius:12px;box-shadow:0 2px 16px #ddd}
h2{text-align:center;margin-bottom:24px}
input{width:100%;padding:12px;margin:8px 0;border:1px solid #ddd;border-radius:8px;outline:none}
button{width:100%;padding:12px;background:#2266ee;color:#fff;border:none;border-radius:8px;margin-top:10px}
.error{color:red;text-align:center;margin:10px 0}
</style>
</head>
<body>
<div class="login">
    <h2>外链工具后台登录</h2>
    <?php if($msg){echo '<div class="error">'.$msg.'</div>';} ?>
    <form method="post">
        <input type="text" name="user" placeholder="账号" required>
        <input type="password" name="pwd" placeholder="密码" required>
        <button name="sub" type="submit">登录</button>
    </form>
</div>
</body>
</html>
