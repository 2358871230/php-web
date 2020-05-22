<?php
require_once("common.inc.php");

$queryTitle = isset($_GET["title"])?$_GET["title"]:null;
$queryAuthor = isset($_GET["author"])?$_GET["author"]:null;
$queryMinTime = isset($_GET["minTime"])?$_GET["minTime"]:null;
$queryMaxTime = isset($_GET["maxTime"])?$_GET["maxTime"]:null;

$where = "";
if($queryTitle) {
    $where = " `Title` like ('%$queryTitle%')";
}

if($queryAuthor){
    if($where) $where .= " AND `AuthorName` like ('%$queryAuthor%')"; 
    else $where .= "`AuthorName` like ('%$queryAuthor%')";   
}

if($queryMinTime){
    if($where) $where .= " AND "; 
    $where .= "createTime>='$queryMinTime'";   
}

if($queryMaxTime){
    if($where) $where .= " AND "; 
    $where .= "createTime<='$queryMaxTime'";   
}

$pageIndex=isset($_GET["pageIndex"])?$_GET["pageIndex"]:1;
$pageSize = 6;//$_GLOBAL["defaultPageSize"];

$pageInfo = getPageInfo("article",$where,"CreateTime DESC",$pageIndex,$pageSize);
$rows = $pageInfo["items"];
$total = $pageInfo["recordCount"];
$pageCount = $pageInfo["pageCount"];


?>
<?php require_once("header.inc.php");?>
<a href="article_add.php" class="btn">新添文章</a>
                <span class="btn" id="listBtn">表格</span>
                <span  class="btn" id="cardBtn">卡片</span>
                <div id="panel" class="list" >
                    <div class="table">
                        <div class="thead">
                            <div class="tr">
                                <div class="th Title">标题</div>
                                <div class="th Author">作者</div>
                                <div class="th DateTime">时间</div>
                                <div class="th Op">操作</div>
                            </div>
                        </div>
                        <div class="tbody">
                            <?php foreach($rows as $row) { ?>
                            <div class="tr">
                                <div class="td Title"><?=$row["Title"]?></div>
                                <div class="td Author"><?=$row["AuthorName"]?></div>
                                <div class="td DateTime">
                                    <div class="td"><?=$row["CreateTime"]?></div>
                                    <div class="td"><?=$row["UpdateTime"]?></div>
                                </div>
                                <div class="td Op">
                                    <a href="article_detail_new.php?Id=<?=$row["Id"]?>">详情</a>
                                    <?php if($currentUser["Username"]===$row["AuthorName"]) {?>
                                    <a href="article_modify_new.php?Id=<?=$row["Id"]?>"> 修改 </a>
                                        删除
                                    <?php }?>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div id="recordInfo">
                        共<?=$total?>条记录，共<?=$pageCount?>页 当前为<?=$pageIndex?>页
                                    <a href="article_list_new.php?<?=makePageUrl(1)?>">首页</a><
                                    <?php for($i=1;$i<=$pageCount;$i++) { ?>
                                        <a class="<?=$pageIndex==$i?'currentPageNo':''?>"  href="article_list_new.php?<?=makePageUrl($i)?>"><?=$i?></a>
                                    <?php }?>
                                    >
                                    <a href="article_list_new.php?<?=makePageUrl($pageCount)?>">尾页</a>  
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    var listBtn = document.getElementById("listBtn");
                    listBtn.onclick = function() {
                         document.getElementById("panel").className = "list";
                        };
                    var cardBtn = document.getElementById("cardBtn").onclick = function() {
                        document.getElementById("panel").className = "card";

                    };
                </script>   
<?php require_once("footer.inc.php");?>
