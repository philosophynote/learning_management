<?php

//最初に読み込む
include("funcs.php");
//1. POSTデータ取得
$id = $_GET["id"];

//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る


//３．データ登録SQL作成
$sql = "DELETE FROM learn_tb WHERE Learn_id=:Learn_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':Learn_id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("manage.php");
}
?>
