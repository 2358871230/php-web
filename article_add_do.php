<?php
session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;
if(!$currentUser){
    echo "未登录";
    die(0);
}

$title = $_POST["Title"];
$content = $_POST["Content"];
$authorId = $currentUser["Id"];
$authorName = $currentUser["Username"];
$now = date_format(new DateTime(),'Y-m-d H:i:s');

$sql="INSERT INTO `Article`
(`Title`,`Content`,`AuthorId`,`AuthorName`,`CreateTime`,`UpdateTime`)
VALUES
('$title','$content','$authorId','$authorName','$now','$now')
";

$conn = new mysqli("localhost","root",'','myblog');

$conn->query($sql);

if($conn->error) echo $conn->error;
else{
    echo "添加成功,<a href='article_list_new.php'>跳转到列表</a>";
}