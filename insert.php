<?php
//ini_set( "display_errors", On );
//error_reporting( E_ALL );
//最初に読み込む
include("funcs.php");
//1. POSTデータ取得
$user_id =h($_POST["user_id"]);
$date   = h($_POST["date"]);
$input  = h($_POST["input"]);
$output = h($_POST["output"]);
$contents = h($_POST["contents"]);
$thoughts = h($_POST["thoughts"]);
//echo $date;
//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る
// echo ($pdo);

//３．データ登録SQL作成
$sql = "INSERT INTO learn_tb(User_id,Date,Input,Output,Contents,Thoughts)VALUES(:User_id,:Date,:Input,:Output,:Contents,:Thoughts)";
// echo ($sql);
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':User_id', $user_id, PDO::PARAM_INT); 
$stmt->bindValue(':Date', $date, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Input', $input, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Output', $output, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':Contents', $contents, PDO::PARAM_STR);
$stmt->bindValue(':Thoughts', $thoughts, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


// ４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("manage.php");
}

