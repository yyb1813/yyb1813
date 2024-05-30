<?php
// sleep(2);
//人为地加上等8的时间,让图片显示;
$json = $_GET['json'];
if ($json <> 'encode') {
    echo "<script>alert('来源参数错误');history.back();</script>";
    exit;
} else {
    include_once 'conn.php';
    $username = $_POST['username'];
    $a        = array();
    if (empty($username)) {
        $a['code'] = 1;
        $a['msg']  = '用户名不能为空';
    } else {
        $sql    = "select 1 from info where username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            //找到了此用户名，则说明此用户名不可用
            $a['code'] = 0;
            $a['msg']  = '此用户名不可用';
        } else {
            $a['code'] = 2;
            $a['msg']  = '此用户名可用';
        }
    }
    echo json_encode($a);
//这里使用了一个json_encode的转换,将得到a的数组,用JSON的形式显示出来.
//PHP json_encode() 用于对变量进行 JSON 编码，该函数如果执行成功返回 JSON 数据，否则返回 FALSE
//PHP json_decode() 函数用于对 JSON 格式的字符串进行解码，并转换为 PHP 变量。
}