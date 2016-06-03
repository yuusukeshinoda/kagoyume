<?php

//DBへの接続を行う。成功ならPDOオブジェクトを、失敗なら中断、メッセージの表示を行う
function connect2MySQL(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=kagoyume_db;charset=utf8','yussuke','mofcarro');
        //SQL実行時のエラーをtry-catchで取得できるように設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('DB接続に失敗しました。次記のエラーにより処理を中断します:'.$e->getMessage());
    }
}


//レコードの挿入を行う。失敗した場合はエラー文を返却する
function insert_profiles($name, $pass, $mail, $address){
    //db接続を確立
    $insert_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $insert_sql = "INSERT INTO user_t(name,password,mail,address,total,newDate)"
            . "VALUES(:name,:password,:mail,:address,:total,:newDate)";

    //現在時をdatetime型で取得
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':name',$name);
    $insert_query->bindValue(':password',$pass);
    $insert_query->bindValue(':mail',$mail);
    $insert_query->bindValue(':address',$address);
    $insert_query->bindValue(':total',0);
    $insert_query->bindValue(':newDate',$date);

    //SQLを実行
    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

function insert_buy($userID, $total, $type){
    //db接続を確立
    $insert_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $insert_sql = "INSERT INTO buy_t(userID,total,type,buyDate)"
            . "VALUES(:userID,:total,:type,:buyDate)";

    //現在時をdatetime型で取得
    $datetime =new DateTime();
    $date = $datetime->format('Y-m-d H:i:s');

    //クエリとして用意
    $insert_query = $insert_db->prepare($insert_sql);

    //SQL文にセッションから受け取った値＆現在時をバインド
    $insert_query->bindValue(':userID',$userID);
    $insert_query->bindValue(':total',$total);
    $insert_query->bindValue(':type',$type);
    //$insert_query->bindValue(':total',$total);
    $insert_query->bindValue(':buyDate',$date);

    //SQLを実行
    try{
        $insert_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $insert_db=null;
        return $e->getMessage();
    }

    $insert_db=null;
    return null;
}

function search_profiles($name=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT userID,password FROM user_t WHERE name = :name";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':name',$name);


    //SQLを実行
    try{
        $search_query->execute();
    } catch (PDOException $e) {
        $search_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $search_query->fetchAll(PDO::FETCH_ASSOC);
}

//レコードの更新を行う。失敗した場合はエラー文を返却する
function update_profile($userID, $name, $password, $mail, $address){
    //db接続を確立
    $update_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $update_sql = "UPDATE user_t SET name = :name, password = :password, mail = :mail, address = :address WHERE userID = :userID";

    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);

    //SQL文に受け取った値＆現在時をバインド
    $update_query->bindValue(':userID',$userID);
    $update_query->bindValue(':name',$name);
    $update_query->bindValue(':password',$password);
    $update_query->bindValue(':mail',$mail);
    $update_query->bindValue(':address',$address);

    //SQLを実行
    try{
        $update_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $update_db=null;
        return $e->getMessage();
    }

    $update_db=null;
    return null;
}

function profile_detail($id){
    //db接続を確立
    $detail_db = connect2MySQL();

    $detail_sql = "SELECT * FROM user_t WHERE userID=:id";

    //クエリとして用意
    $detail_query = $detail_db->prepare($detail_sql);

    $detail_query->bindValue(':id',$id);

    //SQLを実行
    try{
        $detail_query->execute();
    } catch (PDOException $e) {
        $detail_query=null;
        return $e->getMessage();
    }

    $result = $detail_query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function update_total($userID,$total){
    //db接続を確立
    $update_db = connect2MySQL();

    //DBに全項目のある1レコードを登録するSQL
    $update_sql = "UPDATE user_t SET total = total + :total WHERE userID = :userID";

    //クエリとして用意
    $update_query = $update_db->prepare($update_sql);

    //SQL文に受け取った値＆現在時をバインド
    $update_query->bindValue(':userID',$userID);
    $update_query->bindValue(':total',$total);

    //SQLを実行
    try{
        $update_query->execute();
    } catch (PDOException $e) {
        //接続オブジェクトを初期化することでDB接続を切断
        $update_db=null;
        return $e->getMessage();
    }

    $update_db=null;
    return null;
}

//ユーザーデータ削除用
function fetch_user($userID=null){
    //db接続を確立
    $search_db = connect2MySQL();

    //SQL文を用意。引数がない場合はこれ自体が実行される
    $search_sql = "SELECT * FROM user_t WHERE userID = :userID";

    //クエリとして用意
    $search_query = $search_db->prepare($search_sql);
    $search_query->bindValue(':userID',$userID);


    //SQLを実行
    try{
        $search_query->execute();
    } catch (PDOException $e) {
        $search_query=null;
        return $e->getMessage();
    }

    //該当するレコードを連想配列として返却
    return $search_query->fetchAll(PDO::FETCH_ASSOC);
}

function delete_user($userID){
  //db接続を確立
  $delete_db = connect2MySQL();

  $delete_sql = "DELETE FROM user_t WHERE userID=:userID";

  //クエリとして用意
  $delete_query = $delete_db->prepare($delete_sql);

  $delete_query->bindValue(':userID',$userID);

  //SQLを実行
  try{
      $delete_query->execute();
  } catch (PDOException $e) {
      $delete_query=null;
      return $e->getMessage();
  }
  return null;
}

?>
