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
      <title>削除確認画面</title>
</head>
  <body>
    <?php login_logout(); ?>
    <?php
    $data = fetch_user($_SESSION['userID']);
    foreach($data as $value){
      foreach($data as $value1){ ?>
        <h1>削除確認</h1>
        このユーザーをマジで削除しますか？<br>
        名前:<?php echo $value1['name'];?><br>
        パスワード:<?php echo $value1['password'];?><br>
        メールアドレス:<?php echo $value1['mail'];?><br>
        住所:<?php echo $value1['address'];?><br>
        購入総額:<?php echo $value1['total'];?><br>
        登録日時:<?php echo $value1['newDate']; ?><br>
        <?php
      }
    } ?>

        <form action="<?php echo DELETE_RESULT; ?>" method="POST">
          <input type="submit" name="YES" value="はい"style="width:100px">
          <input type="hidden" name="mode" value="DELETE" >
        </form><br>
        <form action="<?php echo ROOT_URL; ?>" method="POST">
          <input type="submit" name="NO" value="いいえ"style="width:100px">
        </form>
    <?php
       echo return_top();?>
   </body>
</html>
