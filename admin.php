<?php
include_once 'checkadmin.php';
?>
<!doctype html>
<!--输入html:5,然后按Tab键可以快速补全代码-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .main {
            width: 80%;
            margin: 0 auto;
            text-align: center
        }

        /*.main{width: 80% 代表宽度80% ;margin:0上下0 auto左右自动;text-align: center文字居中}*/
        /*margin 属性为给定元素设置所有四个（上右下左）方向的外边距属性*/
        /*参考Css网站:https://developer.mozilla.org/zh-CN/docs/Web/CSS/margin*/
        /*text-align CSS 属性设置块元素或者单元格框的行内内容的水平对齐。这意味着其效果和 vertical-align 类似，但是是水平方向的。*/
        h2 {
            font-size: 20px
        }

        h2 a {
            color: navy;
            text-decoration: none;
            margin-right: 15px)
        }

        h2 a:last-child {
            margin-right: 0
        }

        h2 a:hover {
            color: brown;
            text-decoration: underline
        }

        .current {
            color: bisque
        }

        /*h2{font-size:20px文字的大小}*/
        /*h2 a{color: navy链接A标签颜色;text-decoration: 下划线样式none不要;margin-right: 元素块向右的相素15px)}*/
        /*h2 a:last-child 伪类代表一组兄弟元素中的最后元素{margin-right:0}*/
        /*h2 a:hover鼠标经过时的样式{color:brown;text-decoration:显示下划线underline}*/
        /*.current当前栏目的区分显示状态{color: bisque}*/
        /*tr:hover{background-color: azure}*/
        /*如果加了点击效果美化，最好就将经过代码关闭*/
        .trClick1{background-color: yellow}
        .trClick2{background-color: white}
        /*设备鼠标经过TR表格的时候或者点击和点击后的色彩显示*/
    </style>
    <title>112233</title>

</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php';
    include_once 'conn.php';
    include_once 'page.php';
    $sql = "select count(id) as total from info";//使用聚合函数count统计记录总数
    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_array($result);
    $total = $info['total'];  //得到记录总数
    $perPage = 10; //设置每一页显示多少条数据
    $page = $_GET['page'] ?? 1; //读取当前页码
    paging($total, $perPage);//引用分页函数
    $sql = "select * from info order by id desc limit $firstCount,$perPage";
    $result = mysqli_query($conn, $sql);
//    printf("Error: %s\n", mysqli_error($conn));数据库经常出错，但又不知错在那里，加上一个打印数据，方便查看
//    exit();
    ?>
    <table border="1" cellspacing="0" cellpadding="1o" style="border-collapse: collapse" align="center" width="70%">
        <tr>
            <td>序号</td>
            <td>用户名</td>
            <td>性别</td>
            <td>信箱</td>
            <td>爱好</td>
            <td>是否管理员</td>
            <td>操作</td>
        </tr>
        <?php
        $i = ($page - 1) * $perPage + 1;//这里要注意，因为不同的分页都要重新构建新的序号，所以采用页码-1，*页数量+1，所以第一页就是1开始，第二页就是2-1=1 1*2=2+1=3，以此类推。
        while ($info = mysqli_fetch_array($result)) {
            ?>
            <tr onclick="if(this.className == 'trClick2'){this.className = 'trClick1'}else{this.className = 'trClick2'}" class="trClick2">
<!--                //这里要注意对应的CLSS,点过高亮效果,表格美化操作-->
                <td><?php echo $i; ?></td>
                <td><?php echo $info['username'] ?></td>
                <td><?php echo $info['sex'] ? '男' : '女' ?></td>
                <!--                这里注意条件格式，？号代表1和0，1为真，0为假，假如是1那么是男，否则就为女-->
                <td><?php echo $info['email'] ?></td>
                <td><?php echo $info['fav'] ?></td>
                <td><?php echo $info['admin'] ? '管理员' : '' ?></td>
                <td>
                    <a href="modify.php?id=4&username=<?php echo $info['username']; ?>&source=admin&page=<?php echo $page; ?>">修改资料</a>
                    <?php if ($info['username'] <> 'admin') { ?><a
                        href="javascript:del(<?php echo $info['id']; ?>,'<?php echo $info['username']; ?>');">删除会员</a>
                        <?php
                    }
                    else{
                        echo "<span style='color:gray'>删除会员</span> ";
                    }
                    if ($info['admin']) {
                        if ($info['username'] <> 'admin') {
                            ?><a href="setAdmin.php?action=0&userID=<?php echo $info['id']; ?>&page=<?php echo $page; ?>">取消管理员</a>
                            <?php
                        } else {
                            echo '<span style="color: gray">取消管理员</span>';
                        }
                    } else {
                        if ($info['username'] <> 'admin'){
                            ?><a href="setAdmin.php?action=1&userID=<?php echo $info['id']; ?>&page=<?php echo $page; ?>">设置管理员</a>
                            <?php
                        }
                        else {
                            echo '<span style="color: gray">设置管理员</span>';
                        }
                    }
                    ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    echo $pageNav;
    ?>
</div>
<script>
    function del(id,name){
        if(confirm('您确定要删除会员 ' + name + ' ?')){
            //location.href = 'del.php?id=刘德华&username=1111';这里做了一个判断测试后台DEL文件是否提示参数错误信息
            //location.href = 'del.php?id=42&username=2222'; //如果对方构建了一个对应的ID，也是不安全的。
            location.href = 'del.php?id=' + id + '&username=' + name +  '&page=<?php echo $page; ?>';

        }
    }
</script>
</body>
</html>