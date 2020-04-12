<?php
session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;

$title=$_POST["title"];
$content = $_POST["Content"];
$updatetime = date_format(new DateTime(),'Y-m-d H:i:s');
$Id =$_GET["Id"];
$Username=$currentUser["Username"];

$sql = "UPDATE `article` SET `Title`= '$title' , `Content` = '$content',`Updatetime` = '$updatetime' WHERE Id = '$Id' 
AND AuthorName='$Username' ";

$conn = new mysqli("localhost","root","","myblog");
$conn->query($sql);
if($conn->error) die($conn->error);
Header("Location: article_list.php");

?>