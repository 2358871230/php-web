<?php
    session_start();
?>
<h2>登录</h2>
<form action="do_login.php" method="POST">
    <div>
        <label for="myUsername">用户名</label>
        <input type="text" id="myUsername" name="Username" value="<?=isset($_COOKIE["username"]
        )?$_COOKIE["username"]:"" ?>" />
    </div>
    <div>
        <label for="myPassword">密码</label>
        <input type="password" id="myPassword" name="Password" />
    </div>
    <div>
        <input type="checkbox" id="myPassword" name="Remember" />记住用户名密码
    </div>
    <input type="submit" value="提交">
</form>