<?php
session_start();
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
        .red {
            color: red
        }

        .green {
            color: green
        }

        .black {
            color: black
        }

        #loading {
            width: 80px;
            display: none
        }
    </style>
    <title>112233</title>

</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php'
    ?>
</div>
<form action="postReg.php" method="post" onsubmit="return check()">
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
<!--                        onblur 事件发生在对象失去焦点时。-->
            <td align="left">
                <label>
                <input name="username" onblur="checkUsername()"><span class="red">*</span> <span id="usernameMsg"></span><img src="image/loading.gif" id="loading" alt="1111">
<!-- alt 属性是一个必需的属性，它规定在图像无法显示时的替代文本-->
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">密码</td>
            <td align="left">
                <label>
                    <input type="password" name="pw">
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">确认密码</td>
            <td align="left">
                <label>
                    <input type="password" name="cpw">
                </label>
            </td>
        </tr>
        <tr>
            <td align="right">性别</td>
            <td align="left">
                <label> <input name="sex" type="radio" checked value="1">男 </label>
                <label> <input name="sex" type="radio" value="0">女 </label>

            </td>
        </tr>
        <tr>
            <td align="right">邮箱</td>
            <td align="left">
                <label><input name="email"></label>
            </td>
        </tr>
        <tr>
            <td align="right">爱好</td>
            <td align="left">
                <!--                fav[]做为一个数组长，加上因为多选框的原因，每一个都加上标签label，让包括使用触屏设备在内的用户更容易激活这个元素。-->
                <label><input name="fav[]" type="checkbox" value="听音乐">听音乐 </label>
                <label><input name="fav[]" type="checkbox" value="玩游戏">玩游戏 </label>
                <label><input name="fav[]" type="checkbox" value="踢足球">踢足球 </label>

            </td>
        </tr>
        <tr>
            <td align="right">
                <input type="submit" value="提交">
            </td>
            <td>
                <input type="reset" value="重置">
                <!--                安全机制,在这里做了一个隐藏域-->
            </td>
        </tr>
    </table>
</form>
<script src="jquery/1.9.1/jquery.min.js"></script>
<!--<script src="https://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>-->
<script>// function 函数是数学描述对应关系的一种特殊集合
    function checkUsername() {
        let username = document.getElementsByName('username')[0].value.trim();
        //取到标签里的值的时候用TRIM的方式去掉前后的空格.value.trim()
        let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
        //这里我加入了长度大于0的时候才弹提示,否则不弹
        if (username.length > 0) {
            if (!usernameReg.test(username)) {
                alert('用户名必填，且只能由大小写字符和数字构成，长度为3到10个字符！');
                $("#usernameMsg").text('');
                document.getElementsByName('username')[0].value = '';
                document.getElementsByName('username')[0].focus();
                return false;
            }
            $.ajax({
                url: "checkUsername.php?&json=encode",
                type: 'post',
                dataType: 'json',
                data: {username: username},
                //加上一个隐藏LOGIN图标
                beforeSend: function () {
                    $("#usernameMsg").text('');
                    $("#loading").show();
                    //连接显示
                },
                success: function (data) {
                    $("#loading").hide();
                    //成功之后隐藏
                    if (data.code == 0) {
                        //表明不可用,然后在ID域里面加上CLASS的色彩,让看起来清楚一点
                        $("#usernameMsg").text(data.msg).removeClass('black').addClass('green');
                    } else if (data.code == 2) {
                        //表明可用
                        $("#usernameMsg").text(data.msg).removeClass('green').addClass('black');
                    }
                },
                error: function () {
                    alert('网络错误');
                }
            })
        }
    }

    function check() {
        // let username = document.getElementsByName('username')[0].value.trim();
        let pw = document.getElementsByName('pw')[0].value.trim();
        let cpw = document.getElementsByName('cpw')[0].value.trim();
        let email = document.getElementsByName('email')[0].value.trim();
// 用户名验证
//         let usernameReg = /^[a-zA-Z0-9\u4E00-\u9FA5]{3,20}$/;去掉中文正表达式
//          let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
//          if (!usernameReg.test(username)) {
//              alert('用户名必填，且只能大小字符和数字构成，长度为3到1θ个字符！');
//              return false;
//          }
        let pwReg = /^[a-zA-Z0-9._*\-]{6,10}$/;
        if (!pwReg.test(pw)) {
            alert('密码必须填写，且只能大小写及.*_字符和数字构成，长度为6到1θ个字符！');
            return false;
        } else {
            if (cpw !== pw) {
                alert('两次输入的密码不相同！');
                return false;
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
    }
</script>
</body>
</html>