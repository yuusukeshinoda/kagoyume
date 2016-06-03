<?php
session_start();
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");

$name = isset($_SESSION['userInfo']['name']) ? $_SESSION['userInfo']['name'] : "";
$pass = isset($_SESSION['userInfo']['pass']) ? $_SESSION['userInfo']['pass'] : "";
$mail = isset($_SESSION['userInfo']['mail']) ? $_SESSION['userInfo']['mail'] : "";
$address = isset($_SESSION['userInfo']['address']) ? $_SESSION['userInfo']['address'] : "";
?>

<html>
<head>
  <title>新規登録画面</title>
</head>
<body>
  <?php echo return_top(); ?>
  <p><font size="5" color="blue">新規会員登録ページです。以下の情報を入力してください。</font></p>
  <form action="./registration_confirm.php" method="post">
    ユーザー名<input type="text" name="name" value="<?php echo $name; ?>"><br>
    パスワード<input type="text" name="pass" value="<?php echo $pass; ?>"><br>
    メールアドレス<input type="text" name="mail" value="<?php echo $mail; ?>"><br>
    住所<input type="text" name="address" value="<?php echo $address; ?>"><br>
    <input type="submit" name="btn" value="確認画面へ">
  </form>

</body>
</html>
