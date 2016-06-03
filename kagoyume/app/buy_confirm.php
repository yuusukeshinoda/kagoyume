<?php
session_start();
require_once '../util/dbaccessUtil.php';
require_once '../util/scriptUtil.php';
require_once("../util/defineUtil.php");
echo return_top();
echo '<br>';
login_session();
?>

<html>
<head><title>購入確認</title></head>
<body>
<?php login_logout(); ?>
<?php
if(!isset($_SESSION['userID'])){
  echo 'ログインしてください。';
  login_session();

}else{
  foreach ($_SESSION['code'] as $key => $value) {
    $itemcode = $value;
    $itemcode4url = rawurlencode($itemcode);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=$appid&itemcode=$itemcode4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] !== 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
      }

    foreach ($hits as $hit) { ?>
      <div class="Item">
          <h2><a href="<?php echo h($hit->Url); ?>"><?php echo h($hit->Name); ?></a></h2>
          <p><a href="<?php echo h($hit->Url); ?>"><img src="<?php echo h($hit->Image->Small); ?>" /></a><?php echo h($hit->Headline); ?></p>
          <p><?php echo $hit->Price.'円'; ?></p>
      </div>

      <?php
      isset($total) ? $total += $hit->Price : $total = $hit->Price;

    }
  }
  echo '合計金額：'.$total.'円<br>';
  ?>


  <form action="buy_complete.php" method="post">
  <?php  for($i=1;$i<=5;$i++){
  echo ex_typenum($i); ?><input type="radio" name="type" value="<?php echo $i; ?>"><br>
  <?php } ?>

  <input type="hidden" name="total" value="<?php echo $total; ?>">
  <input type="hidden" name="mode" value="BUY" >
  <input type="submit" name="btn" value="上記の内容で購入する">
  </form>

  <form action="cart.php" method="post">
    <input type="submit" name="btn" value="カートに戻る">
  </form>

  <?php
} ?>
</body>
</html>
