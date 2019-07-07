<?php

if (!isset($_REQUEST["type"]) || !isset($_REQUEST["pid"]) || !isset($_REQUEST["qty"])) {
  $res = new Class {};
  $res->status = 'error';
  echo json_encode($res);

  return;
};

spl_autoload_register(function($class_name) {
    require_once "{$class_name}.php";
});

$type = $_REQUEST["type"];
$pid = $_REQUEST["pid"];
$qty = $_REQUEST["qty"];

$cart = new Cart;

if ($type === 'add') {
  $cart->addProducts($pid, $qty);
}

$res = new Class {};

$res->status = 'success';

echo json_encode($res);
?>