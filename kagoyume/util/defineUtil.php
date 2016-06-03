<?php

const ROOT_URL = 'http://localhost/ec_site/app/top.php';//トップページのURL
const ADD = 'cart.php';                        //買い物かごへ追加ページ
const CART = 'cart.php';                        //買い物かごページ
const LOGIN = 'login.php';                        //ログインページ
const BUY_CONFIRM = 'buy_confirm.php';             //買い物かごページ
const BUY_COMPLETE = 'buy_complete.php';            //ログインページ
const REGISTRATION = 'registration.php';            //新規登録ページ
const REGISTRATION_CONFIRM = 'registration_confirm.php';  //登録確認ページ
const REGISTRATION_COMPLETE = 'registration_complete.php';  //登録完了ページ
const SEARCH = 'search.php';                         //検索結果ページ
const ITEM = 'item.php';                             //商品詳細ページ
const DELETE = 'my_delete.php';                        //登録情報削除ページ
const DELETE_RESULT = 'my_delete_result.php';          //削除完了ページ
const DATA = 'my_data.php';                         //登録情報閲覧ページ
const UPDATE = 'my_update.php';                         //登録情報更新ページ
const UPDATE_RESULT = 'my_update_result.php';          //登録情報更新完了ページ



$appid = "dj0zaiZpPTk2NEZRcHpJUlpoZSZzPWNvbnN1bWVyc2VjcmV0Jng9NDI-";//取得したアプリケーションIDを設定

/*カテゴリーID一覧
　キーにカテゴリID、値にカテゴリ名 */
$categories = array(
                    "1" => "すべてのカテゴリから",
                    "13457"=> "ファッション",
                    "2498"=> "食品",
                    "2500"=> "ダイエット、健康",
                    "2501"=> "コスメ、香水",
                    "2502"=> "パソコン、周辺機器",
                    "2504"=> "AV機器、カメラ",
                    "2505"=> "家電",
                    "2506"=> "家具、インテリア",
                    "2507"=> "花、ガーデニング",
                    "2508"=> "キッチン、生活雑貨、日用品",
                    "2503"=> "DIY、工具、文具",
                    "2509"=> "ペット用品、生き物",
                    "2510"=> "楽器、趣味、学習",
                    "2511"=> "ゲーム、おもちゃ",
                    "2497"=> "ベビー、キッズ、マタニティ",
                    "2512"=> "スポーツ",
                    "2513"=> "レジャー、アウトドア",
                    "2514"=> "自転車、車、バイク用品",
                    "2516"=> "CD、音楽ソフト",
                    "2517"=> "DVD、映像ソフト",
                    "10002"=> "本、雑誌、コミック"
                    );

/* @brief ソート方法一覧
 　キーに検索用パラメータ、値にソート方法 */
$sortOrder = array(
                   "-score" => "おすすめ順",
                   "+price" => "商品価格が安い順",
                   "-price" => "商品価格が高い順",
                   "+name" => "ストア名昇順",
                   "-name" => "ストア名降順",
                   "-sold" => "売れ筋順"
                   );

/**
 * @brief 特殊文字を HTML エンティティに変換する
 *
 * これは、htmlspecialchars()を使いやすくするための関数です。
 * htmlspecialchars() http://jp.php.net/htmlspecialcharsより
 *   文字の中には HTML において特殊な意味を持つものがあり、
 *   それらの本来の値を表示したければ HTML の表現形式に変換してやらなければなりません。
 *   この関数は、これらの変換を行った結果の文字列を返します。
 *
 *   '&' (アンパサンド) は '&amp;' になります。
 *   ENT_QUOTES が設定されている場合のみ、 ''' (シングルクオート) は '&#039;'になります。
 *   '<' (小なり) は '&lt;' になります。
 *   '>' (大なり) は '&gt;' になります。
 *   ''' (シングルクオート) は '&#039;'になります。
 *
 * echo h("<>&'\""); //&lt;&gt;&amp;&#039;&quotと出力します。
 *
 * @param string $str 変換したい文字列
 *
 * @return string html用に変換した文字列
 *
 */
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


$hits = array();
$query = !empty($_GET["query"]) ? $_GET["query"] : "";
$sort =  !empty($_GET["sort"]) && array_key_exists($_GET["sort"], $sortOrder) ? $_GET["sort"] : "-score";
$category_id = ctype_digit($_GET["category_id"]) && array_key_exists($_GET["category_id"], $categories) ? $_GET["category_id"] : 1;

if ($query != "") {
    $query4url = rawurlencode($query);
    $sort4url = rawurlencode($sort);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$appid&query=$query4url&category_id=$category_id&sort=$sort4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
    }
}
?>
