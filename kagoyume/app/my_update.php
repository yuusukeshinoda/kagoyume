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
      <title>変更入力画面</title>
</head>
<body>
  <?php login_logout(); ?>
    <?php
        $name = $_SESSION['userInfo']['name'];
        $password = $_SESSION['userInfo']['password'];
        $mail = $_SESSION['userInfo']['mail'];
        $address = $_SESSION['userInfo']['address'];
    ?>
        <form action="<?php echo UPDATE_RESULT ?>" method="POST">
            ユーザー名:
            <input type="text" name="name" value="<?php echo $name; ?>">
            <br><br>

            パスワード:　
            <input type="text" name="password" value="<?php echo $password; ?>">
            <br><br>

            メールアドレス:　
            <input type="text" name="mail" value="<?php echo $mail; ?>">
            <br><br>

            住所:
            <input type="text" name="address" value="<?php echo $address; ?>">
            <br><br>

            <input type="submit" name="btn" value="以上の内容で更新を行う">
              <input type="hidden" name="mode" value="UPDATE" >
        </form>
        <form action="<?php echo DATA; ?>" method="POST">
          <input type="submit" name="btn" value="詳細画面に戻る">
        </form>
    <?php
    echo return_top(); ?>
</body>

</html>
