<?php
require_once("common.inc.php");


$message="";
if(isset($_POST["submit"])){
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $sql = "insert into `Account` (`Username`,`Password`,`Intro`)values('$username',
    '$password','')";
    $conn = createDb();
    $conn->query($sql);
    if($conn->error) die($conn->error);
    $userId=$conn->insert_id;
    $fileInfo = $_FILES["face"];
    $dest=__DIR__."/faces/$userId.jpg";
    move_uploaded_file($fileInfo["tmp_name"],$dest);
    $message="注册成功";
}
require_once("header.inc.php");
if($message){
    echo $message;
}else{


?>



    <form action="html_form.php?id=234" method="POST" enctype="multipart/form-data" class="dataset">
        <h1>用户注册</h1>
        <div class="field">
            <label>用户名</label><input type="text" value="" name="Username" placeholder="用户名" />
        </div>
        <div class="field">
            <label>密码</label><input type="password" value="" name="Password" title="4及以上个字符" />
        </div>
        <div class="field">
        <label>头像文件</label><input type="file" value="" name="face" />

        </div class="actions">
           <input type="submit" name="submit" value="提交" /> 
       </form>
   
<?php
}
 require_once("footer.inc.php");?>