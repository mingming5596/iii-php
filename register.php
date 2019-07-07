<?php
include_once 'sql.php';

if (isset($_REQUEST['account'])) {
    $account = $_REQUEST['account'];
    $passwd = $_REQUEST['passwd'];
    $realname = $_REQUEST['realname'];

    $passwd = password_hash($passwd, PASSWORD_DEFAULT);

    $icon = null;
    if ($_FILES['icon']['error'] == 0) {
        $icon = addslashes(file_get_contents($_FILES['icon']['tmp_name']));
    }

    $sql = "INSERT INTO member (account, passwd, realname, icon) VALUES ";
    $sql .= "('{$account}', '{$passwd}', '{$realname}', '{$icon}')";

    if ($mysqli->query($sql)) {
        header('Location: login.php');
        // echo 'ok';
    } else {
        echo '????error';
    }
}

?>

<script>

    let xhttp = new XMLHttpRequest();
    let isDataOK = false;

    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == 0) {
                document.getElementById('mesg').innerHTML = 'ok';
                isDataOK = true;
            } else {
                document.getElementById('mesg').innerHTML = 'GG';
            }
        }
    }

    function isNewAccount() {
        let account = document.getElementById('account').value;
        xhttp.open('GET', 'isNewAccount.php?account='+account, true);
        xhttp.send();
    }

    function isSubmit() {
        return isDataOK;
    }
</script>

<form method="POST" action="register.php" onsubmit="return isSubmit()" enctype="multipart/form-data">
    Account: <input id="account" type="text" name="account" onchange="isNewAccount()" />
    <span id="mesg"></span>
    <br />
    Password: <input type="password" name="passwd" /><br />
    Realname: <input type="text" name="realname" /><br />
    Icon: <input type="file" name="icon" /><br />

    <input type="submit" value="Register" />
</form>
