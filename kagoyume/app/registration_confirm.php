<?php
session_start();
require_once("../util/defineUtil.php");
require_once("../util/scriptUtil.php");
?>

<html>
<head><title>入力確認画面</title></head>
<body>
<?php
$confirm_values = array(
                        'name' => bind_p2s('name'),
                        'pass' => bind_p2s('pass'),
                        'mail' =>bind_p2s('mail'),
                        'address' =>bind_p2s('address'),
                        );

if(!in_array(null,$confirm_values, true)){

  echo 'ユーザー名：'.$confirm_values['name'].'<br>';
  echo 'パスワード：'.$confirm_values['pass'].'<br>';
  echo 'メールアドレス：'.$confirm_values['mail'].'<br>';
  echo '住所：'.$confirm_values['address'].'<br><br>';
  echo '上記の内容で登録します。よろしいですか。';
  ?>

  <form action="./registration_complete.php" method="post">
  <input type="submit" value="はい">
  <input type="hidden" name="mode" value="REGISTRATION" >
  </form>
  <form action="./registration.php" method="post">
  <input type="submit" value="いいえ">
  </form>

<?php
}else{
  ?>
  <h1>入力項目が不完全です</h1><br>
  再度入力を行ってください<br>
  <h3>不完全な項目</h3>
  <?php
  //連想配列内の未入力項目を検出して表示
  foreach ($confirm_values as $key => $value){
      if($value == null){
          //値が存在しない要素のキー名(POSTされたname属性)に対応する名前を出力する
          switch ($key){
              case 'name':
                  echo '名前';
                  break;
              case 'pass':
                  echo 'パスワード';
                  break;
              case 'mail':
                  echo 'メールアドレス';
                  break;
              case 'address':
                  echo '住所';
                  break;
          }
          echo 'が未記入です<br>';
      }
  } ?>
  <form action="<?php echo REGISTRATION ?>" method="POST">
    <input type="hidden" name="mode" value="REINPUT" >
    <input type="submit" name="no" value="登録画面に戻る">
  </form>

<?php
} ?>
</body>
</html>
