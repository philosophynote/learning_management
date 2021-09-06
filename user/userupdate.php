<?php

//最初に読み込む
include("../funcs.php");
//1. POSTデータ取得
$id   = h($_POST["id"]);
$name  = h($_POST["name"]);
$lmail   = h($_POST["lmail"]);
$lpw = h($_POST["lpw"]);
$kanri_flg = h($_POST["kanri_flg"]);
$life_flg = h($_POST["life_flg"]);


//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る


//３．データ登録SQL作成
$sql = "UPDATE user_table SET name=:name, lmail=:lmail, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE user_id=:user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lmail', $lmail, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_STR);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("userselect.php");
}











?>
