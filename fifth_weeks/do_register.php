<?php
session_start();
function mycount($arr){
    $count = 0;
    foreach($arr as $k=>$v)$count++;
    return $count;
}

function myimplode($arr,$needle){
    $count = mycount($arr);
    $result=",";
    while($count>0){
        $result=",".$arr[$count-1].$result;
        $count--;
    }
    return $result;
}

$hasError = false;
//变量
$username =$_POST['Username'];   
//如果有，就检查长度
if($username){
    //检查长度
    $len=strlen($username);
    if($len<3){
        $hasError = true;
        echo"用户名长度至少有3个<br />";
    }else if($len>6){
        $hasError = true;
        echo"用户名长度最多不能超过6个<br />";
    }
}else{
    echo"用户名必须填写<br />";
    $hasError = true;
}

$password = $_POST['Password'];
//如果有，就检查长度
if($password){
    //检查长度
    $len=strlen($password);
    if($len<3){
        $hasError = true;
        echo"密码长度至少有3个<br />";
    }else if($len>6){
        $hasError = true;
        echo"密码名长度最多不能超过6个<br />";
    }
}else{
        echo"密码必须填写<br />";
        $hasError = true;
}
//age,是只填写了数字的字符串
$age=$_POST["Age"];
//如果有，就检查长度
if($age){
    $ageNum = intval("$age");
    if(!$ageNum){
        echo"岁数必须是数字";
        $hasError = true;
    }
}

$interests = $_POST['Interests'];

$interestValue = null;
if(!$interests){
    echo"兴趣必须填写<br />";
}else{
    $count =mycount($interests);
    if($count<2){
        echo"兴趣至少要有2个";
        $hasError = true;
    }else if($count>3){
        echo"兴趣最多填三个";
        $hasError = true;
    }else{
        $interestValue = myimplode($interests,",");
    }
}

$intro = $_POST["Intro"];

if(!$hasError){
    $sql="INSERT INTO `Account` (`Username`,`Password`,`Gender`,`Age`,`Interests`,`Intro`)
    VALUES('$username','$password',1,$age,'$interestValue','$intro')
    ";
    $conn = new mysqli('localhost','root','','myblog');
    $conn->query($sql);
    if($conn->error) echo"数据库有错误:$conn->error";
    else{
        echo"注册成功，<a href='login.php'>请点击这里登陆</a><br />";
    }
}



