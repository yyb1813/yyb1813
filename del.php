<?php
include_once 'checkAdmin.php';
include_once 'conn.php';
$id       = $_GET['id'];
$username = $_GET['username'];
$page   = $_GET['page'] ?? '';
//增加一个看是不是传过来的参数是否存在或者空值错误
if (!$id || !$username) {
    echo "<script>alert('id参数错误');history.back();</script>";
    exit;
}
if($page){
    if(!is_numeric($page)){
        echo "<script>alert('页面参数错误');history.back();</script>";
        exit;
    }
}
if (is_numeric($id) && is_numeric($username)) {
    //对于GET过来的数据做安全的判定，查看是不是数字过来。&&两个条件中，只要有一个不符号就报错
    //但这个还是不安全，对方可以做一个来删除管理员的ID，所以还要判断是不是针对用户才安全,$_SESSION很重要了
    $sql = "delete from info where id = $id and username='$username'";
//    $sql    = "delete from info where id = $id ";安全一点，再加上用户名判断;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('删除会员 $username 成功');location.href = 'admin.php?id=5&page={$page}';</script>";
    } else {
        echo "<script>alert('删除会员 $username 失败');history.back();</script>";
    }
} else {
    echo "<script>alert('参数错误');history.back();</script>";
}