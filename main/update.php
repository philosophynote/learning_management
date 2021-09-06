<?php

//最初に読み込む
include("funcs.php");
//1. POSTデータ取得
$id   = h($_POST["id"]);
$user_id = h($_POST["user_id"]);
$date   = h($_POST["date"]);
$input  = h($_POST["input"]);
$output = h($_POST["output"]);
$contents = h($_POST["contents"]);
$thoughts = h($_POST["thoughts"]);


//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る


//３．データ登録SQL作成
$sql = "UPDATE learn_tb SET User_id=:User_id, Date=:Date, Input=:Input, Output=:Output, Contents=:Contents, Thoughts=:Thoughts WHERE Learn_id=:Learn_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':User_id',$user_id, PDO::PARAM_INT);
$stmt->bindValue(':Date', $date, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Input', $input, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Output', $output, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Contents', $contents, PDO::PARAM_STR);
$stmt->bindValue(':Thoughts', $thoughts, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Learn_id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("manage.php");
}











?>
