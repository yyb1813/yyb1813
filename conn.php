<?php
//定义一个变量CONN的数据库连接方式

//定义一个数据库的链接,链接最后定义为一次，为方便程序代码的校正。
//include_once 'conn.php';
//global $conn; //这里定义一个全局的变量。
$conn = mysqli_connect("localhost", "root", "root", "member");
if (!$conn) {
die("数据库连接失败!");
}
//设置字符集为utf8，解决中文乱码的问题
//mysql_query("SET NAMES 'utf8'");
//mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET CHARACTER_SET_RESULT = utf8");
mysqli_query($conn, "set names utf8");
//对前端而页面进来的数据做一个必要地引导验证,||相当于或者or


