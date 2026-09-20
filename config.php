<?php
error_reporting(E_ALL ^ E_NOTICE);
$db_host = 'localhost';
$db_user = 'root';    // 数据库用户名
$db_pwd = 'root';     // 数据库密码
$db_name = 'link_tool';// 数据库名

$conn = mysqli_connect($db_host,$db_user,$db_pwd,$db_name);
mysqli_set_charset($conn,'utf8mb4');

function gettime(){
    return time();
}
function md5pwd($str){
    return md5($str);
}
?>
