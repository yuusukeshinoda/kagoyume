<?php
session_start();

/** @mainpage
 *  商品検索フォームを表示
 */

/**
 * @file
 * @brief 商品検索フォームを表示
 *
 * 商品検索フォームを表示し、
 * フォームから入力された値を条件に、検索APIを利用して、検索した結果をhtmlに埋め込んで表示します。
 * 検索結果に対して、カテゴリーによる絞り込みと、並び順の変更ができます。
 *
 * PHP version 5
 */

require_once("../util/defineUtil.php");//共通ファイル読み込み(使用する前に、appidを指定してください。)
require_once("../util/scriptUtil.php");
login_session();
if(isset($_SESSION['userID'])){ ?>
<form action=<?php echo DATA ?> method="post">
 <input type="submit" name="btn" value="ユーザー情報ページへ">
</form>
<?php } ?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <title>かごいっぱいのゆめ</title>
        <link rel="stylesheet" type="text/css" href="../css/prototype.css"/>
    </head>
    <body>

        <?php login_logout(); ?>
        <?php cart(); ?>

        <h1><a href= <?php echo ROOT_URL; ?>>かごいっぱいのゆめ</a></h1>
        <form action=<?php echo SEARCH; ?> class="Search">
        表示順序:
        <select name="sort">
        <?php foreach ($sortOrder as $key => $value) { ?>
        <option value="<?php echo h($key); ?>" <?php if($sort == $key) echo "selected=\"selected\""; ?>><?php echo h($value);?></option>
        <?php } ?>
        </select>

        キーワード検索：
        <select name="category_id">

        <?php foreach ($categories as $id => $name) { ?>
        <option value="<?php echo h($id); ?>" <?php if($category_id == $id) echo "selected=\"selected\""; ?>><?php echo h($name);?></option>
        <?php } ?>
        </select>
        <input type="text" name="query" value="<?php echo h($query); ?>"/>
        <input type="submit" value="検索"/>
        </form>
    </body>
</html>
