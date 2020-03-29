<?php

session_start();
$currentUser = isset($_SESSION["user"])?$_SESSION["user"]:null;
if(!$currentUser){
    echo "请首先<a href='login.php'>登录</a>";
}else{
?>

<html>
    <head>
        <title>新添文章</title>      
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    </head>   

    <body>
        <div>
            当前用户:<a><?=$currentUser["Username"]?></a>
        </div>
        <form action="article_add_do.php" method="POST">
            <div>
                <label>标题</label>
                <input type="text" name="Title" value=""/>
            </div>
            <div>
                <label>内容</label>
                <textarea name="Content" cols="80" rows="20"></textarea>
            </div>
            <div>
                <input type="reset" value="重置" />
                <input type="submit" value="提交"/>
                
            </div>
        </form>
    </body>
</html>
<?php }?>