<?php
$username = $_POST['username'];
$pw       = $_POST['pw'];
$cpw      = $_POST['cpw'];
$email    = $_POST['email'];
$sex      = $_POST['sex'];
//为防止报错没有选择,我们前面加个@implode
$fav = @implode(",", $_POST['fav']);
$page =$_POST['page'];
$source=$_POST['source'];

if (strlen(!$username )) {
    echo "<script>alert('用户名必须填写!');history.back();</script>";
    exit;
}
else {
    if (!preg_match('/^[a-zA-Z0-9]{3,10}$/', $username)) {
        // if (!preg_match('/^[\x00-\xffa-zA-Z0-9]{3,20}$/', $username)) {
        echo "<script>alert('用户名必填，且只能大小写字符和数字构成，长度为3到1θ个字符！');history.back();</script>";
        exit;
    }
}
//前面加!empty号表示不为空,不加empty表示为空
if (!empty($pw)){
    if ($pw <> $cpw) {
        echo "<script>alert('两次输入的密码不一致!');history.back();</script>";
        exit;
    }
    if (!preg_match('/^[a-zA-Z0-9._*\-]{6,10}$/', $pw)) {
        echo "<script>alert('密码必须填写，且只能大小写及.*_字符和数字构成，长度为6到1θ个字符！');history.back();</script>";
        exit;
    }
}

    if (empty($email)) {
        echo "<script>alert('邮箱不能为空值');history.back();</script>";
        exit;
    }
    else {
        if (!preg_match('/^[a-zA-Z0-9._\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/', $email)) {
            echo "<script>alert('邮箱填写不合规范！');history.back();</script>";
            exit;
        }
   }
include_once "conn.php";
global $conn;
if ($pw){
    $sql = "update info set pw='".md5($pw). "',email='$email',sex='$sex',fav='$fav' where username='$username'";
    $url ='logout.php';
   }
else {
    $sql = "update info set email='$email',sex='$sex',fav='$fav' where username='$username'";
    $url ='index.php';
}
if($source=='admin'){
    $url ='admin.php?id=5&page='.$page;
}
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('更新成功!');location.href='$url';</script>";
} else {
    echo "<script>alert('更新失败!');history.back();</script>";

}