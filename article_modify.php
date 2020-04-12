<?php
session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;

$Id = $_GET["Id"];
$sql = " SELECT * FROM `article` WHERE Id = $Id";
$conn = new mysqli("localhost","root","","myblog");
$rs = $conn->query($sql);
if($conn->error) die($conn->error);
$detail = $rs->fetch_assoc();
if($currentUser["Username"]!==$detail["AuthorName"]){
    die("不是作者，不能修改");
}
?>

<html>
<head>
<meta http-equiv="content-type"content="text/html;charset = utf-8"/>

</head>
<title>--修改--</title>
<body>
    <form method="POST" action="article_modify_do.php?Id=<?=$Id?>">
    <div>
        <label>
            标题
        </label>
        <input type="text" name="title" value="<?=$detail["Title"]?>" />
    </div>
    <div>
        <label>
            内容
        </label>
        <textarea name="Content" ><?=$detail["Content"]?></textarea>
    </div>
   <div>
   <?=$detail["AuthorName"]?>编辑于
   <?=$detail["UpdateTime"]?>
   </div>
   <div>
       <input type="submit" value="提交" />
       <a href="article_list.php">返回列表</a>
   </div>
    </form>
   
</body>

</html>