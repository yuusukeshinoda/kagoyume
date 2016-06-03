<?php
require_once '../util/defineUtil.php';

/**
 * 使用した場所にトップページへのリンクを挿入する
 * @return トップページへのリンクのaタグ
 */
function return_top(){
    return "<a href='".ROOT_URL."'>トップへ戻る</a>";
}

function login_session(){
    $_SESSION['formerPage'] = $_SERVER["REQUEST_URI"];
}

function go_to_cart(){
  return "<a href='".CART."'>買い物かごへ</a>";
}

function ex_typenum($type){
    switch ($type){
        case 1;
            return "通常配送";
        case 2;
            return "お急ぎ便";
        case 3;
            return "店頭受取";
        case 4;
            return "お届け日時指定便";
        case 5;
            return "特別取扱商品";
    }
}


/**
 * セッションを初期化する
 */
function session_clear(){
    // セッション変数を全て解除する
    $_SESSION = array();

    // セッションを切断するにはセッションクッキーも削除する。
    /*if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }*/

    // 最終的に、セッションを破壊する
    session_destroy();
}

function login_logout(){ ?>
<form action=<?php echo LOGIN; ?> method="post">
<button type="submit" name="login" value="<?php if(isset($_SESSION['userID'])){echo 'logout';}else{echo 'login';}?>"><?php if(isset($_SESSION['userID'])){echo 'ログアウト';}else{echo 'ログイン';}?></button>
</form>
<?php }

function cart(){ ?>
<form action=<?php echo CART; ?> method="post">
<button type="submit" name="cart">買い物かごへ</button>
</form>
<?php }

function bind_p2s($name){
    if(!empty($_POST[$name])){
        $_SESSION['userInfo'][$name] = $_POST[$name];
        return $_POST[$name];
    }else{
        $_SESSION[$name] = null;
        return null;
    }
}

function writeLog($logText){
  $filename = "../logs/log.txt";
  $log = $logText;
  $fp = fopen($filename,'w');
  file_put_contents($filename,$log);
  fclose($fp);
}

?>
