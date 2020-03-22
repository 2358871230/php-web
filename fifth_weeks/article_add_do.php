<?php
session_start();
$currentUser = $_SESSION["user"];

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
    echo "添加成功,<a href='#'>跳转到列表</a>";
}