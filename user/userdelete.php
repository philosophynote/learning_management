<?php

//最初に読み込む
include("..//main/funcs.php");
//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る


//３．データ登録SQL作成
$sql = "DELETE FROM user_table WHERE user_id=:user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("userselect.php");
}
?>
