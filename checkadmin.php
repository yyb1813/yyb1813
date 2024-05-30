<?php
session_start();
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']){
    //验证是不是管理员,看不是存在，或者相存在但值为0，如果两件条件有一个，那么提示。
    echo "<script>alert('非管理员不能访问本页面');location.href='login.php';</script>";
    exit;
}
