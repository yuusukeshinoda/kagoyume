<?php session_start(); ?>
<?php require_once("../util/defineUtil.php"); ?>
<?php require_once("../util/scriptUtil.php"); ?>
<?php echo return_top();
echo '<br>';
login_session(); ?>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>検索結果一覧</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>
      <?php login_logout(); ?>
      <?php cart(); ?>
      <?php
      if(empty($_GET['query'])){
        echo '検索エラー：キーワードを入力してください。';
      }else{
        foreach ($hits as $hit) { ?>
        <div class="Item">
            <h2><a href="<?php echo ITEM."?code=$hit->Code"; ?>"><?php echo h($hit->Name); ?></a></h2>
            <p><a href="<?php echo h($hit->Url); ?>"><img src="<?php echo h($hit->Image->Medium); ?>" /></a></p>
        </div>
        <?php } ?>
      <?php } ?>
    </body>
</html>
