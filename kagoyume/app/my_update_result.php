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
      <title>更新結果画面</title>
</head>
  <body>
    <?php login_logout(); ?>
    <?php
    if((isset($_POST['mode']) && $_POST['mode']=="UPDATE")){

        $userID = $_SESSION['userID'];
        //フォームから値を取得
        $update_name = $_POST['name'];
        $update_password = $_POST['password'];
        $update_mail = $_POST['mail'];
        $update_address = $_POST['address'];

        $result = update_profile($userID,$update_name,$update_password,$update_mail,$update_address);

        //エラーが発生しなければ表示を行う
        if(!isset($result)){
            ?>
            <h1>更新確認</h1>
            名前:<?php echo $update_name;?><br>
            パスワード:<?php echo $update_password;?><br>
            メールアドレス:<?php echo $update_mail;?><br>
            住所:<?php echo $update_address;?><br><br>
            以上の内容で更新しました。<br>
            <?php
        }else{
            echo 'データの更新に失敗しました。次記のエラーにより処理を中断します:'.$result;
        }

      }else{
        echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
      }

    echo return_top();

    ?>
  </body>
</html>
