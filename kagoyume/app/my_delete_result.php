<?php
session_start();
require_once '../util/defineUtil.php';
require_once '../util/scriptUtil.php';
require_once '../util/dbaccessUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>削除結果画面</title>
</head>
<body>
    <?php
    if((isset($_POST['mode']) && $_POST['mode']=="DELETE")){

      $result = delete_user($_SESSION['userID']);
      if(!isset($result)){
      ?>
      <h1>削除確認</h1>
      削除しました。<br>
      <?php
      unset($_SESSION['userID']);
      }else{
          echo 'データの削除に失敗しました。次記のエラーにより処理を中断します:'.$result.'<br>';
          login_logout();
      }
    }else{
      echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
    }

    echo return_top();
    ?>
   </body>
</body>
</html>
