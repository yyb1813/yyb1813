<?php
header("content-type:text/html;charset=utf8");
//在后端获取前端表单数据的方法是使用全局数组$_GET或$_POST,这里要注意大小写.
$username = $_POST['username'];
$pw       = $_POST['pw'];
$cpw      = $_POST['cpw'];
$email    = $_POST['email'];
$sex      = $_POST['sex'];
//为防止报错没有选择,我们前面加个@implode
$fav = @implode(",", $_POST['fav']);
//
//echo  "您输入的用户名是: $username <br> ";
//在""号中输入的是字符串,因为可以加参数,不建议用单引号来使用, 中间输入的.号代码的是连接符作用.
//echo "您输入的密码是：{$pw} <br>";
//因为前面用的是双引号,引入字符串,所以这里不必要的大括号,
//echo "您输入的密码是：$pw  <br>";
//echo "您输入的确认密码是：$cpw <br>";
//echo "您选择的性别是: ";
//echo $sex == 1 ? '男' : '女';
////？表达式，也称为三元运算符。如果前面的表达式值为直，则输出冒号前面的值，否则，输出冒号后面的值。
//echo "<br>";
//echo "您选择的爱好是：";
//print_r($fav); 可以先用打印的方式输出内容进行查看.
//因为fav这里是数组,所以我们采用输出数组的函数用,号来进行连接
//,号是一个形参数,是数须的,这里单引号双引号注意半角和全角的输入方式.
//在输入implode(参数时,直接输入""号就可以,不用TAB,里面的参数自动出来)
//$fav = implode(",",$fav);
//$fav = implode(",",$fav);
//echo $fav;
////定义一个变量CONN的数据库连接方式
//
////定义一个数据库的链接,链接最后定义为一次，为方便程序代码的校正。

//$conn = mysqli_connect("localhost", "root", "root", "member");
//if (!$conn) {
//    die("数据库连接失败!");
//}
////设置字符集为utf8，解决中文乱码的问题
////mysql_query("SET NAMES 'utf8'");
////mysql_query("SET CHARACTER SET utf8");
////mysql_query("SET CHARACTER_SET_RESULT = utf8");
//mysqli_query($conn, "set names utf8");
////对前端而页面进来的数据做一个必要地引导验证,||相当于或者or
if (strlen(!$username || !$pw)) {
    echo "<script>alert('用户名的密码必须填写!');history.back();</script>";
    exit;
} else {
    if (!preg_match('/^[a-zA-Z0-9]{3,10}$/', $username)) {
        // if (!preg_match('/^[\x00-\xffa-zA-Z0-9]{3,20}$/', $username)) {
        echo "<script>alert('用户名必填，且只能大小写字符和数字构成，长度为3到1θ个字符！');history.back();</script>";
        exit;
    }
}
    if ($pw <> $cpw) {
        echo "<script>alert('两次输入的密码不一致!');history.back();</script>";
        exit;
    }
    if (!preg_match('/^[a-zA-Z0-9._*\-]{6,10}$/', $pw)) {
        echo "<script>alert('密码必须填写，且只能大小写及.*_字符和数字构成，长度为6到1θ个字符！');history.back();</script>";
        exit;
    }

if (empty($email)) {
    echo "<script>alert('邮箱不能为空值');history.back();</script>";
    exit;
}
//empty等于空不用加！
else {
    if (!preg_match('/^[a-zA-Z0-9._\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/', $email)) {
        echo "<script>alert('邮箱填写不合规范！');history.back();</script>";
        exit;
    }

}
include_once "conn.php";
global $conn;
//判断用户名是否重复（是否被占用）
$sql    = "select * from info where username = '$username'";
$result = mysqli_query($conn, $sql);//返回一个记录集
$num    = mysqli_num_rows($result);
if ($num) {
    echo "<script>alert('用户已存在!');history.back();</script>";
    exit;
    // mysqli_close($conn);
    // die("数据库连接关闭!");

}

//再来一个数据库连接成功后的执行语句.
$sql = "INSERT INTO info (`username`, `pw`, `email`, `sex`, `fav`, `createtime`) VALUES ( '$username', '" . md5($pw) . "', '$email', '$sex', '$fav', '" . time() . "')";
//输出结果
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('数据插入成功!');location.href='index.php';</script>";
} else {
    echo "<script>alert('数据插入失败!');history.back();</script>";

}
//mysqli_close($conn);关闭数据库非必须


