<?php
require_once("common.inc.php");

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

<?php require_once("header.inc.php");?>
<form method="POST" action="article_modify_do.php?Id=<?=$Id?>" class="dataset">
    <div class="field">
        <label>
            文章标题
        </label>
        <input type="text" class="col-9" name="title" value="<?=$detail["Title"]?>" />
    </div>
    <div class="field">
        <label>
            内容
        </label>
        <textarea class="col-9" name="Content" ><?=$detail["Content"]?></textarea>
    </div>
   <div class="info">
        <?=$detail["AuthorName"]?>编辑于
        <?=$detail["UpdateTime"]?>
   </div>
   <div class="actions">
       <input type="submit" value="提交" />
       <a href="article_list_new.php">返回列表</a>
   </div>
    </form>
             
<?php require_once("footer.inc.php");?>
