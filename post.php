<?php
    $change = false;
    //变量
    $username = $_POST["Username"];

    if(!$username){
        $change = true;
        echo"请填写用户名！<br/>";
    }

    $password = $_POST["Password"];
    if(!$password){
        $change = true;
        echo"请填写密码！<br/>";
    }else{
        if(strlen($password)<6){
            echo"密码至少需要6个字符！<br/>";
            $change = true;
        }
    }
    
    if(!$change) echo"登陆成功！";
