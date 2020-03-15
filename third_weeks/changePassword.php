<?php
//只能登录的用户才能访问
//未登录的用户报错
session_start();
$islogin=isset($_SESSION["islogin"])? $_SESSION["islogin"]:false;
if(!$islogin) echo"未登录，请先登录";
else echo"已经登录，请修改密码";