<?php

spl_autoload_register(function($class_name) {
    require_once "{$class_name}.php";
});

session_start();

if (!isset($_SESSION['member'])) header('Location: login.php');

$member = $_SESSION['member'];
$cart = $_SESSION['cart'];

$icon = base64_encode($member->icon);
?>

<h1>CY </h1>
<hr/>
<img src="data:image/png;base64,<?php echo $icon; ?>" />
<br/>
Welcome!!! <?php echo $member->realname; ?> <br/>
<a href="logout.php">logout</a>
<hr />
<?php include_once 'shoppingCart.php'; ?>
<hr/>
2019 Copyright.
