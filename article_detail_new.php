<?php
require_once("common.inc.php");
//获取文章本身的内容
$Id = $_GET["Id"];
$sql = " SELECT * FROM `article` WHERE Id = $Id";
$conn = new mysqli("localhost","root","","myblog");
$rs = $conn->query($sql);
if($conn->error) die($conn->error);
$detail = $rs->fetch_assoc();
$rs->close();

//如果有回复提交，把回复存入数据库
if(isset($_POST["doReply"])){
    $content = getParam('replyContent');
    $createTime = date_format(new DateTime(),'Y-m-d H:i:s');
    $authorName = $currentUser["Username"];
    $authorId = $currentUser["Id"];
    $articleId = $_GET["Id"];
    $sql = "INSERT INTO `reply`(`Content`,`CreateTime`,`AuthorId`,`AuthorName`,`ArticleId`)
    values('$content','$createTime','$authorId','$authorName','$articleId')";
    $conn->query($sql);
    if($conn->error) die($conn->error);
}

//获取回复列表
$pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
$pageSize = 4;//$_GLOBAL["defaultPageSize"];

$pageInfo = getPageInfo("reply","ArticleId=$Id","CreateTime ASC",$pageIndex,$pageSize);
$replies = $pageInfo["items"];
$recordCount = $pageInfo["recordCount"];
$pageCount = $pageInfo["pageCount"];
?>

<?php require_once("header.inc.php");?>

<div class="dataset detail">
    <div class="field Title">
        <label>
            文章标题
        </label>
        <span class="input"><?php echo $detail["Title"]?></span>
    </div>
    <div class="field Content">
        <label class="articleContent">
            <span>内容</span>
        </label>
        <span class="input"><?php echo str_replace("\n","<br />",$detail["Content"])?></span>
    </div>
   <div class="info">
        <?=$detail["AuthorName"]?>编辑于
        <?=$detail["UpdateTime"]?>
   </div>
   <div class="actions">
       <a href="article_list_new.php">返回列表</a>
   </div>
</div>     
<div class="replyArea">
    <form action="article_detail_new.php?Id=<?=$Id?>" method="post">
        <textarea name="replyContent"></textarea>
        <input type="submit" name="doReply" value="回复" />
    </form>
    <div>
        <div class="replyList">
            <?php foreach($replies as $re){ ?>
            <div class="replyItem<?=$re["Id"]?>">
                <div><?=$re["AuthorName"]?></div>
                <div class="createTime"><?=$re["CreateTime"]?></div>
                <div class="replyContent"><?=$re["Content"]?></div>
            </div>
            <?php } ?>
        </div>
        <div class="replyListPage">
            共<?=$recordCount?>条评论,共<?=$pageCount?>页
            <?php for($i=1;$i<=$pageCount;$i++){?>
                <a href="article_detail_new.php?Id=<?=$Id?>&pageIndex=<?=$i?>"><?=$i ?></a>
            <?php }?>
        </div>
    </div>
</div>
<?php if(isset($_GET["pageIndex"])) {?>
<script type="text/javascript">
    function showBottom(){
        let elem = document.body;
        let elem1 = document.documentElement;
        elem1.scorllTop = document.body.offsetHeight;
        elem.scrollTo(0,document.body.offsetHeight);
    }
    setTimeout(function(){
        showBottom();
        },10);
    
</script>
<?php }?>
<?php require_once("footer.inc.php");?>
