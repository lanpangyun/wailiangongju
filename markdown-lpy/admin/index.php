<?php
session_start();
include '../config.php';
if(!$_SESSION['admin']){
    header("Location:login.php");exit;
}
$page = $_GET['page']?intval($_GET['page']):1;
$pagesize = 15;
$offset = ($page-1)*$pagesize;
$total = mysqli_fetch_row(mysqli_query($conn,"select count(id) from links"))[0];
$pages = ceil($total/$pagesize);
$list = mysqli_query($conn,"select * from links order by id desc limit $offset,$pagesize");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>外链管理后台</title>
<style>
*{margin:0;padding:0}
body{padding:20px;font-family:system-ui}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
a{color:#2266ee;text-decoration:none}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden}
th,td{border:1px solid #eee;padding:12px;text-align:left}
th{background:#f5f7fa}
.btn{padding:4px 10px;border-radius:4px;color:#fff;text-decoration:none;font-size:13px;margin:0 3px}
.add{background:#09c}
.edit{background:#f90}
.del{background:#f33}
.page{margin-top:20px;text-align:center}
.page a{padding:6px 12px;border:1px solid #eee;margin:0 3px}
</style>
</head>
<body>
<div class="top">
    <h2>外链列表管理</h2>
    <div>
        <a href="add.php" class="btn add">新增外链</a>
        <a href="logout.php">退出登录</a>
    </div>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>外链地址</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
<?php while($row=mysqli_fetch_assoc($list)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td style="max-width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?php echo $row['url']; ?></td>
        <td><?php echo $row['status']?'显示':'隐藏'; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn edit">编辑</a>
            <a href="del.php?id=<?php echo $row['id']; ?>" class="btn del" onclick="return confirm('确定删除？')">删除</a>
        </td>
    </tr>
<?php } ?>
</table>
<div class="page">
<?php for($i=1;$i<=$pages;$i++){ ?>
    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php } ?>
</div>
</body>
</html>
