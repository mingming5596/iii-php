<?php
session_start();

if ($_REQUEST['verifyValue'] == '' || $_REQUEST['verifyValue'] != $_SESSION["verifyCode"]) {
    echo '驗證碼錯誤！！！！！！！！！<br/>';
    echo '<button onclick="history.back()">Back</button>';

    return;
}

include_once 'sql.php';

spl_autoload_register(function($class_name) {
    require_once "{$class_name}.php";
});

if (!isset($_REQUEST['account'])) header('Location: login.php');

$account = $_REQUEST['account'];
$passwd = $_REQUEST['passwd'];

$sql = 'SELECT * FROM member WHERE account = ?';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('s', $account);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $member = $result->fetch_object();

    echo $member->id.":".$member->account.":".$member->realname;

    if (password_verify($passwd, $member->passwd)) {
        $_SESSION['member'] = $member;
        $_SESSION['cart'] = new Cart;
        header("Location: main.php");
    }
}
?>