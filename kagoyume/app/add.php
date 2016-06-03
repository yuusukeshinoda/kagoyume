<?php
session_start();
require_once '../util/scriptUtil.php';
login_logout();
echo return_top();
echo '<br>';
echo login_session();
echo '<br>';

if(!isset($_SESSION['code'])){
  $arr = array();
  array_push($arr,$_POST['code']);
  $_SESSION['code'] = $arr;
}else{
  array_push($_SESSION['code'],$_POST['code']);
}

echo 'カートに追加しました。<br>';
echo go_to_cart();
?>
