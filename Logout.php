<?php
session_start();
session_destroy();
//销毁
header( "Location:index.php");
//header() 函数向客户端发送原始的 HTTP 报头。