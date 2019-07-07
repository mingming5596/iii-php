<form id="loginForm" method="POST" action="checkAccount.php">
    Account: <input id="account" type="text" name="account" />
    <br />
    Password: <input type="password" name="passwd" /><br />
    <img src="<?php include_once 'verifyCode.php' ?>" />
    <input type="text" name="verifyValue" /><br/>
    <input type="submit" value="Login" />
    <input type="button" value="register" onclick="location.href='register.php'" />
</form>