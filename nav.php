<h1>会员注册管理系统</h1>
<?php if (isset($_SESSION['LoggedUsername']) && $_SESSION['LoggedUsername'] <> '') {
    ?>
    <div class="logged">当前登录者: <?php echo $_SESSION['LoggedUsername']; ?> <?php if($_SESSION['isAdmin']){?>欢迎管理员登录<?php } ?> <span class="logout"><a
                    href="Logout.php">注销登录</a></span></div>
    <?php
}
//$id = isset($_GET['id']) ? $_GET['id'] : 1;
//PHP isset()函数使用详解，PHP判断变量是否存在
//isset
//一、判断变量是否存在,如果存在，显示当前id,如果不存在，就默认为1；
$id = ($_GET['id']) ?? 1;
//如果你的PHP版本为7.0就可以这样写
?>
<!--        <div class="logged">当前登录者: -->
<!--    --><?php //echo $_SESSION['LoggedUsername'];?><!--<span class="logout"><a href="Logout.php">注销登录</a></span></div>-->
<h2>
    <a href="index.php?id=1" <?php if ($id == 1){ ?>class="current" <?php } ?> >首页</a>
    <a href="singup.php?id=2" <?php if ($id == 2) { ?>class="current" <?php } ?> >会员注册</a>
    <a href="Login.php?id=3" <?php if ($id == 3) { ?>class="current" <?php } ?> >会员登录</a>
    <a href="modify.php?id=4&source=member" <?php if ($id == 4) { ?>class="current" <?php } ?> >个人资料修改</a>
    <a href="admin.php?id=5" <?php if ($id == 5) { ?>class="current" <?php } ?>> 后台管理</a>
</h2>
