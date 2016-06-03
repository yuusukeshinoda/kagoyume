<?php
session_start();
require_once '../util/dbaccessUtil.php';
require_once '../util/scriptUtil.php';
login_logout();
echo return_top();
echo '<br>';
if((isset($_POST['mode']) && $_POST['mode']=="BUY")){

  $userID = $_SESSION['userID'];
  $total = $_POST['total'];
  $type = $_POST['type'];

  $result = insert_buy($userID,$total,$type);

  //エラーが発生しなければ表示を行う
  if(!isset($result)){
    echo '購入を完了しました。';
    unset($_SESSION['code']);
  }else{
    echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
  }

  $result = update_total($userID,$total);
  //エラーが発生しなければ表示を行う
  if(!isset($result)){
    echo '購入総額のデータを更新しました。';
  }else{
    echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
  }

}else{
  echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
}

?>
