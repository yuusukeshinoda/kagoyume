<?php
session_start();
require_once("../util/defineUtil.php");
require_once '../util/scriptUtil.php';
echo return_top();
echo '<br>';
login_session();
?>

<html>
<head><title>買い物かご</title></head>
<body>
<?php login_logout(); ?>
<?php
if(!isset($_SESSION['code'])){
  echo '買い物かごには商品が追加されていません。';
}else{

  if(isset($_POST['delete'])){
    unset($_SESSION['code'][$_POST['delete']]);
  }

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
    $key = array_search($itemcode,$_SESSION['code']);
    ?>
    <form action= "<?php echo CART; ?>" method="post">
      <input type="hidden" name="delete" value="<?php echo $key; ?>">
      <input type="submit" name="btn" value="カートから削除">
    </form>
    <?php
    }
  }
  echo '合計金額：'.$total.'円<br>';
  ?>

  <form action="<?php echo BUY_CONFIRM; ?>" method="post">
    <input type="submit" name="btn" value="購入する">
  </form>

  <form action="<?php echo SEARCH; ?>" method="post">
    <input type="submit" name="btn" value="検索結果一覧へ">
  </form>


 <?php } ?>
</body>
</html>
