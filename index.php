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
    </style>
    <title>112233</title>

</head>
<body>
<div class="main">
    <?php
    include_once 'nav.php'
    ?>

</div>

</body>
</html>