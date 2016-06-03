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

<?php
login_logout();

$result = fetch_user($_SESSION['userID']);
if(!empty($result)){
//エラーが発生しなければ表示を行う
    if(is_array($result)){
        $results = array(
                            'userID' => $result[0]['userID'],
                            'name' => $result[0]['name'],
                            'password' => $result[0]['password'],
                            'mail' =>$result[0]['mail'],
                            'address' =>$result[0]['address'],
                            'total' =>$result[0]['total'],
                            'newDate' =>$result[0]['newDate']);
        $_SESSION['userInfo'] = $results; ?>
    名前:<?php echo $results['name'];?><br>
    パスワード:<?php echo $results['password'];?><br>
    メールアドレス:<?php echo $results['mail'];?><br>
    住所:<?php echo $results['address'];?><br>
    購入総額:<?php echo $results['total'];?><br>
    登録日時:<?php echo $results['newDate']; ?><br>

    <form action="<?php echo UPDATE; ?>" method="POST">
      <input type="submit" name="btn" value="登録情報を更新する">
    </form>
    <form action="<?php echo DELETE; ?>" method="POST">
      <input type="submit" name="btn" value="削除する">
    </form>

    <?php
  }else{
      echo 'そのデータは存在しません<br>';
  }
}else{
  echo '不正な詳細リクエストです<br>';
}



echo return_top();?>
</body>
</html>
