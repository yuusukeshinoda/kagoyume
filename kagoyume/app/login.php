<?php
session_start();
require_once '../util/dbaccessUtil.php';
require_once '../util/scriptUtil.php';
echo return_top();
?>
<html>
<head><title>ログインページ</title></head>


<body><?php
if(isset($_SESSION['userID']) && $_POST['login']=='logout'){
  session_clear();
  echo 'ログアウトしました。';
}else{

  $flag = false;
  if(!isset($_POST['name']) && !isset($_POST['password'])){ ?>
    <form action="login.php" method="post">
      名前<input type="text" name="name"><br>
      パスワード<input type="text" name="password"><br>
      <input type="submit" name="btn" value="ログイン">
    </form>
    <form action="registration.php" method="post">
    <input type="submit" name="btn" value="新規会員登録ページへ">
    </form>


<?php }elseif($_POST['name']=="" || $_POST['password']==""){
  echo "未入力の項目があります"; ?>
  <form action="login.php" method="post">
   <input type="submit" name="btn" value="入力画面へ戻る">
  </form>

<?php }else{
  $result = search_profiles($_POST['name']);

foreach($result as $value){
  foreach($value as $key1 => $value1){
    if($key1=='userID'){
      $_SESSION['userID'] = $value1;
    }
    if($key1=='password' && $_POST['password']==$value1){
      echo 'ログインしました。ようこそ'.$_POST['name'].'さん<br>'; ?>
      <a href="<?php echo $_SESSION['formerPage']; ?>">直前のページへ戻る</a>
      <?php
      $flag = true;
      break 2;
    }/*elseif($_POST['password']!==$value1){
      unset($_SESSION['userID']);
    }*/
  }
}
if($flag==false){
  echo 'ユーザー名とパスワードが合致するデータがありません。'; ?>
  <form action="login.php" method="post">
   <input type="submit" name="btn" value="入力画面へ戻る">
 </form>
 <form action="registration.php" method="post">
 <input type="submit" name="btn" value="新規会員登録ページへ">
 </form><?php

}
}
}
?>










</body>
</html>
