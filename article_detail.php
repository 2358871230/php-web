<?php
$Id = $_GET["Id"];
$sql = " SELECT * FROM `article` WHERE Id = $Id";
$conn = new mysqli("localhost","root","","myblog");
$rs = $conn->query($sql);
if($conn->error) die($conn->error);
$detail = $rs->fetch_assoc();
?>

<html>
<head>
<meta http-equiv="content-type"content="text/html;charset = utf-8"/>

</head>
<title>--详细--</title>
<body>
   <h3><?php echo $detail["Title"]?></h3> 
   <div>
   <?php echo $detail["AuthorName"]?>
   <?php echo $detail["UpdateTime"]?>
   </div>
   <div><?php echo $detail["Content"]?></div>
   <a href="article_list.php">返回列表</a>
   
</body>

</html>
          