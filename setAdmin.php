<?php
include_once 'checkAdmin.php';
$action = $_GET['action'];
$id = $_GET['userID'];
$page   = $_GET['page'] ?? '';
if($page){
    if(!is_numeric($page)){
        echo "<script>alert('页面参数错误');history.back();</script>";
        exit;
    }
}
if(is_numeric($action) && is_numeric($id)){
    //对于GET过来的数据做安全的判定，查看是不是数字过来。&&是并且的意思,两个条件中，只要有一个不符号就报错,1为真，！为假
    if($action == 1 || $action == 0){
        //说明是设置或取消管理员,非常重要的是，update和DELETE必须要加上判断where; || 是或者的意思
        //&& 是逻辑与，|| 是逻辑或，& 是按位与2。 &&运算两边，只要有一个假，最后的结果就是假。这就相当于日常生活中的“并且”
        $sql = "update info set admin = $action where id = $id";
    }
    else{
        echo "<script>alert('参数错误');history.back();</script>";
        exit;
    }
    include_once 'conn.php';
    $result = mysqli_query($conn,$sql);
    if($action){
        $msg = '设置管理员';
    }
    else{
        $msg = '取消管理员';
    }
    if($result){
        //单引号中加变量和中文数字合在一起时，最好在变量中用{}放在里面；
        echo "<script>alert('{$msg}成功');location.href='admin.php?id=5&page={$page}';</script>";
    }
    else{
        echo "<script>alert('{$msg}失败');history.back();</script>";
    }
}
else{
    //说明action和（或）id不是数字
    echo "<script>alert('参数错误');history.back();</script>";
}