<?php session_start(); ?>
<?php require_once '../util/dbaccessUtil.php'; ?>
<?php require_once '../util/scriptUtil.php'; ?>

<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>新規登録完了画面</title>
</head>
  <body>
    <?php
    //トップページに戻る
    echo return_top();
    if((isset($_POST['mode']) && $_POST['mode']=="REGISTRATION")){

    $name = $_SESSION['userInfo']['name'];
    $pass = $_SESSION['userInfo']['pass'];
    $mail = $_SESSION['userInfo']['mail'];
    $address = $_SESSION['userInfo']['address'];
    $result = insert_profiles($name, $pass, $mail, $address);

    if(!isset($result)){ ?>

      <h1>登録結果画面</h1><br>
      名前:<?php echo $name;?><br>
      パスワード:<?php echo $pass;?><br>
      メールアドレス:<?php echo $mail;?><br>
      住所:<?php echo $address;?><br><br>
      以上の内容で登録しました。<br>

      <?php
      writeLog($name); ?>

    <?php
    }else{
        echo 'データの挿入に失敗しました。次記のエラーにより処理を中断します:'.$result;
        //新規登録に失敗した場合セッションを破棄
        session_clear();
    }

  }else{
    echo 'アクセスルートが不正です。もう一度トップページからやり直してください<br>';
  }
    ?>

  </body>
</html>
