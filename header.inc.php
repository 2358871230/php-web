<html>
<head>
    <title>第一个网页</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link type="text/css" rel="stylesheet" href="theme/default.css" />
</head>


<body>
    <div class="layout">
        <div id="header" class="container">
            <div id="caption-info" class="container">
                <h1 class="col-9">我的博客系统</h1>
                <div class="user-info col-3">
                    <?php if($currentUser) {?>
                        <span class="user-name"><?=$currentUser["Username"]?></span>
                        <a href="logout.php">退出登录</a>
                    <?php }else{?>
                        <span class="username">访客</span>
                        <a href="login.php">请登录</a>
                    <?php }?>
                </div>
            </div>
            <div id="main-menu">
                <ul class="topMenu">
                    <li>
                        <span>首页</span>
                    </li>
                    <li><a href="article_list_new.php">文章</a></li>
                    <li id="manger">
                        <span>管理</span>
                        <ul>
                            <li id="user"><span>用户</span></li>
                            <li id="base">
                                <span>基础数据</span>
                                <ul>
                                    <li id="skin"><span>皮肤管理</span></li>
                                    <li id="interest">
                                        <span>兴趣管理</span>
                                        <ul>
                                            <li id="1">1</li>
                                            <li>2</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div id="workspace" class="container">
            <div id="tree" class="col-2"></div>
            <div class="col-10" id="page-area">
           
       