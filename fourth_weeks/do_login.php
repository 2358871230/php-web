<?php
    session_start();
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $sql = "SELECT `Password` FROM `Account` WHERE `Username`='$username'";
    $conn = new mysqli("localhost","root","","myblog");
    $rs=$conn->query($sql);
    $row = $rs->fetch_assoc();

    if(!$row) echo "用户名或密码错误<be />";
    else{
        $passwordInDB = $row["Password"];
        if($password!=$passwordInDB) echo "用户名或密码错误<br />";
        else{
            //会话
            //_GET 访问的url?abc=123 用户填写的数据
            //_POST 请求去的body用户填写的数据
            //_COKIE请求的头的cookie域 服务器告诉浏览器保存一个数据，然后浏览器每次访问都会带着这个数据
            //——SECCION 从cookie里面获取一个临时编码（该编码代表当前用户），根据这个编码，读取服务器的文件，
            //把文件内容填充到——SECCION去,文件的内容，也是服务器写的
            $_SESSION["islogin"] = true;
            echo"登录成功<br />";
        }
    }
    