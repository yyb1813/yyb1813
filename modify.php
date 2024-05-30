<?php
session_start();
$Source = $_GET['source'] ?? '';
$page   = $_GET['page'] ?? '';
if (!$Source or (($Source <> 'admin') and ($Source <> 'member'))) {
    echo "<script>alert('来源参数错误');history.back();</script>";
    exit;
}
if ($page) {
    if (!is_numeric($page)) {
        echo "<script>alert('页面参数错误');history.back();</script>";
        exit;
    }
}

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
    </style>
    <title>112233</title>

</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php';
    include_once 'conn.php';
    $username = $_GET['username'] ?? '';
    if ($username) { //说明有username参数，是管理员修改别人的资料
        //则需要验证管理员权限
        $sql = "select * from info where username = '$username'";
    } else { //说明是会员登录以后修改自己的信息
        $sql = "select * from info where username = '" . $_SESSION['LoggedUsername'] . "'";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {
        $info = mysqli_fetch_array($result);
        $fav  = explode(",", $info['fav']);
        print_r($fav);
    } else {
        die("未找到有效用户");
    }

    ?>
</div>
<form action="postmodify.php" method="post" onsubmit="return check()">
    <table align="center" border="1" style="border-collapse: collapse" cellpadding="10" cellspacing="0">
        <!--        <table align="对齐居中center" borderl="1"边框为1相素 style="border-collapse: 共享边框collapse" cellpadding="10" cellspacing="0">-->
        <!--        https://developer.mozilla.org/zh-CN/docs/Web/CSS/border-collapse-->
        <!--        这里面特别说明一下-->
        <!--        border-collapse CSS 属性是用来决定表格的边框是分开的还是合并的。在分隔模式下，相邻的单元格都拥有独立的边框。在合并模式下，相邻单元格共享边框。-->
        <!--        合并（collapsed）模式下，表格中相邻单元格共享边框。在这种模式下，CSS 属性border-style 的值 inset 表现为槽，值 outset 表现为脊。-->
        <!--        分隔（*separated）*模式是 HTML 表格的传统模式。相邻单元格都拥有不同的边框。边框之间的距离是通过 CSS 属性 border-spacing 来确定的。-->
        <!--        cellpadding 已弃用 这个属性定义了一个单元格的内容和它的边框之间的空间，无论显示与否。如果 cellpadding 的长度是用像素定义的，这个像素大小的空间将被应用到单元格内容的所有四边。-->
        <!--        cellspacing 已弃用 这个属性定义了水平和垂直方向上两个单元格之间空间的大小，使用百分比或像素，包括了表格的顶部与第一行的单元格、表的左边与第一列单元格、表的右边与最后一列的单元格、表的底部与最后一行单元格之间的空间.-->
        <tr>
            <td align="right">用户名</td>
            <td align="left">
                <label><input name="username" readonly value="<?php echo $info['username']; ?>">
                    <!--                    disabled属性会使文本框变灰，而且后端通过request.getParameter(“name”)得不到文本框中的内容。原因是，在表单传输数据时，如果input有disabled属性，对应的value值就不会被传输到后台，自然获取不到。-->
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">密码</td>
            <td align="left">
                <label>
                    <input type="password" name="pw" placeholder="不修改密码请留空">
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">确认密码</td>
            <td align="left">
                <label>
                    <input type="password" name="cpw" placeholder="不修改密码请留空">
                    <!--                    placeholder 属性定义了当表单控件没有值时在控件中显示的文本。占位符文本应简要提示用户应向控件输入的预期数据类型。-->
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">性别</td>
            <td align="left">
                <label> <input name="sex" type="radio" <?php if ($info['sex']){ ?>checked<?php } ?> value="1">男</label>
                <label> <input name="sex" type="radio" <?php if (!$info['sex']) {
                        echo "checked";
                    } ?> value="0">女 </label>
                <!--注意这里的php写法，很重要！！-->
            </td>
        </tr>
        <tr>
            <td align="right">邮箱</td>
            <td align="left">
                <label><input name="email" value="<?php echo $info['email']; ?>"></label>
            </td>
        </tr>
        <tr>
            <td align="right">爱好</td>
            <td align="left">
                <!--                fav[]做为一个数组长，加上因为多选框的原因，每一个都加上标签label，让包括使用触屏设备在内的用户更容易激活这个元素。-->
                <label><input name="fav[]" type="checkbox" <?php if (in_array('听音乐', $fav)) { ?> checked<?php } ?>
                              value="听音乐">听音乐 </label>
                <label><input name="fav[]" type="checkbox" <?php if (in_array('玩游戏', $fav)) { ?> checked<?php } ?>
                              value="玩游戏">玩游戏 </label>
                <label><input name="fav[]" type="checkbox" <?php if (in_array('踢足球', $fav)) { ?> checked<?php } ?>
                              value="踢足球">踢足球 </label>

            </td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" value="提交">
            </td>
            <td>
                <input type="reset" value="重置">
                <input type="hidden" name="source" value="<?php echo $Source ?>">
                <input type="hidden" name="page" value="<?php echo $page ?>">
            </td>
        </tr>
    </table>
</form>
<script>// function 函数是数学描述对应关系的一种特殊集合
    function check() {
        // let username = document.getElementsByName('username')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();
        let email = document.getElementsByName('email')[0].value.trim();
//用户名验证
        // let usernameReg = /^[a-zA-Z0-9\u4E00-\u9FA5]{3,20}$/;去掉中文正表达式
        // let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
        // if (!usernameReg.test(username)) {
        //     alert('用户名必填，且只能大小字符和数字构成，长度为3到1θ个字符！');
        //     return false;
        // }
        let pwReg = /^[a-zA-Z0-9._*\-]{6,10}$/;
        if (pw.length > 0) {
            if (!pwReg.test(pw)) {
                alert('密码必须填写，且只能大小写及.*_字符和数字构成，长度为6到1θ个字符！');
                return false;
            } else {
                if (cpw !== pw) {
                    alert('两次输入的密码不相同！');
                    return false;
                }
            }
        }

        let emailReg = /^[a-zA-Z0-9._\-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
        if (email.length === 0) {
            alert('邮箱不能为空值!');
            return false;
        }
        if (email.length > 0) {
            if (!emailReg.test(email)) {
                alert('邮箱填写不合规范!');
                return false;
            }


        }
    }
</script>
</body>
</html>