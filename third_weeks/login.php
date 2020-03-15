<?php
    session_start();
?>
<h2>登录</h2>
<form action="do_login.php" method="POST">
    <div>
        <label for="myUsername">用户名</label>
        <input type="text" id="myUsername" name="Username" />
    </div>
    <div>
        <label for="myPassword">密码</label>
        <input type="password" id="myPassword" name="Password" />
    </div>
    <input type="submit" value="提交">
</form>