<?php
session_start();
require_once("../util/defineUtil.php");
require_once '../util/scriptUtil.php';
echo return_top();
echo '<br>';
login_session();
?>
<html>
<head><title>商品詳細ページ</title></head>
<body>
<?php login_logout(); ?>

<?php
$itemcode = $_GET['code'];
$itemcode4url = rawurlencode($itemcode);
$url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemLookup?appid=$appid&itemcode=$itemcode4url";
$xml = simplexml_load_file($url);
if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
    $hits = $xml->Result->Hit;
}

foreach ($hits as $hit) { ?>

  <div class="Item">
      <h2><a href="<?php echo h($hit->Url); ?>"><?php echo h($hit->Name); ?></a></h2>
      <p><a href="<?php echo h($hit->Url); ?>"><img src="<?php echo h($hit->Image->Small); ?>" /></a><?php echo h($hit->Headline); ?></p>
  </div>
  <form action="./add.php" method="post">
    <input type="hidden" name="code" value="<?php echo $itemcode; ?>">
    <input type="submit" name="btn" value="カートに追加">
  </form>
<?php }  ?>
</body>
</html>
