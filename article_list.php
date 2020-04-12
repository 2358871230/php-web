<?php
session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;
if(!$currentUser){
    header("Location: login.php");
    die(0);
}

$pageSize = 3;
$pageIndex = isset($_GET["pageIndex"])?$_GET["pageIndex"]:null;
if($pageIndex<=0) $pageIndex = 1;

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

if($where) $where = "WHERE $where";

$startRow = ($pageIndex -1)*$pageSize;

$sql = "select * from `article` $where order by `createTime` desc limit $startRow,$pageSize ";
$conn = new mysqli("localhost","root","","myblog");
$rs = $conn->query($sql);
if($conn->error) die($conn->error);
$rows=[];
while($row = $rs->fetch_assoc()){
    $rows[]=$row;
}
$rs->close();

$totalSql = "select count(Id) as total from `article` $where";
$rs = $conn->query($totalSql);
$total = $rs->fetch_assoc()['total'];

$pageCount = ceil($total/$pageSize);

function makePageUrl($pageIndex){
    $url = "article_list.php?";
    foreach($_GET as $k =>$v){
        if($k==="pageIndex"){
            continue;
        }
        $url .=$k."=".$v."&";
    }
    $url.="pageIndex=".$pageIndex;
    return $url;
}
/*
function makePageUrl($pageNo){
    $currUrl = $_SERVER['REQUEST_URI'];
    return preg_replace('/pageIndex=\d+/',"pageIndex=".$pageNo,$currUrl);
}
*/
?>

<html>
    <head>
        <title>文章列表</title>      
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <link rel="stylesheet" type="text/css" href="article_list_css.css"/>
    </head>   

    <body>
        <div>
            <span>当前用户：<?=$currentUser["Username"]?></span>
            
            <a href="logout.php">退出</a>
        </div>
        <h2>
            文章列表
        </h2>
        <a href="article_add.php" class="btn">新添文章</a>
        <form action="article_list.php" method="get">
            <span>
                <label>标题</label>
                <input type="text" value="<?=$queryTitle ?>" name="title" />
            </span>
            <span>
                <label>作者</label>
                <input type="text" value="<?=$queryAuthor ?>" name="author" />
            </span>
            <span>
                <label>时间</label>
                <input type="text" value="<?=$queryMinTime ?>" name="minTime" />
                -<input type="text" value="<?=$queryMaxTime?>" name="maxTime" />
            </span>
            <input type="submit" value="搜索" class="btn" />
        </form>
        <table border="0" cellspacing="0" cellpadding='0'>
            <head>
                <tr>
                    <th>标题</th>
                    <th>作者</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
            </head>
            <tbody>
                <?php if($rows) { ?>
                    <?php foreach($rows as $row){ ?>
                    <tr>
                        <td>
                            <a href="article_detail.php?Id=<?=$row["Id"]?>"><?=$row["Title"]?></a>
                        </td>
                        <td><?php echo $row["AuthorName"]?></td>
                        <td>
                            <?php echo $row["CreateTime"]?><br />
                            <?php echo $row["UpdateTime"]?>
                        </td>
                        <td>
                            <a href="article_detail.php?Id=<?=$row["Id"]?>">详情</a>
                            <?php if($currentUser["Username"]===$row["AuthorName"]) {?>
                            <a href="article_modify.php?Id=<?=$row["Id"]?>"> 修改 </a>
                             删除
                            <?php }?>
                        </td>
                    </tr>
                <?php } ?>
                <?php }else { ?>
                    <tr><td colspan="4">没有数据</td></tr>
                <?php }?>
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        共<?=$total?>条记录，共<?=$pageCount?>页 当前为<input type='text' value="<?=$pageIndex?>" />页
                        <a href="article_list.php?<?=makePageUrl(1)?>">首页</a><
                        <?php for($i=1;$i<=$pageCount;$i++) { ?>
                            <a class="<?=$pageIndex==$i?'currentPageNo':''?>"  href="article_list.php?<?=makePageUrl($i)?>"><?=$i?></a>
                        <?php }?>
                        >
                        <a href="article_list.php?<?=makePageUrl($pageCount)?>">尾页</a>
                    </td>
                </tr>            
            </tfoot>
        </table>
    </body>
</html>