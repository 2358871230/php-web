<?php
//var_dump($_POST);
$hasError = false;
//变量
$username =$_POST['Username'];   

if(!$username){
     echo"请输入用户名<br/>";
    }

$password = $_POST['Password'];

if(!$password){  
     echo"请输入密码<br/>";
     return;
    } else {
        if(strlen($password)<4) {
            echo"密码至少要有四个字符";
            
    }
}

$Tel = $_POST['Tel'];

if(!$Tel){
    echo"请输入电话号码<br/>";
    return;
}else{
    if(preg_match("/^1[345678]{1}\d{9}$/",$Tel))
	{
		$hasError = false;
	}
	else{
		echo "请输入正确的密码";
		$hasError = true;
	}
}

if(!$hasError) echo "检查通过";