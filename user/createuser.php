<?php
//最初に読み込む
include("../funcs.php");
//パスワードの暗号化
$hash_pass = password_hash(h($_POST['lpw']), PASSWORD_DEFAULT);
echo $hash_pass;

//画像判定
require_once '../securimage/securimage.php';
$securimage = new Securimage();

if(isset($_POST['captcha_code'])) {
  if($securimage->check($_POST['captcha_code']) === true) {
    echo '画像認証OK';
  } else {
    echo '画像認証エラー';
  }  
}
//1. POSTデータ取得
$name  = h($_POST["name"]);
$lmail  = h($_POST["lmail"]);
$fname = h($_FILES["fname"]["name"]);
$kanri_flg = h($_POST["kanri_flg"]);
$life_flg = h($_POST["life_flg"]);

//1-2. FileUpload処理
$upload = "../img/"; //画像アップロードフォルダへのパス
//アップロードした画像を../img/へ移動させる記述↓
if(move_uploaded_file($_FILES['fname']['tmp_name'], $upload.$fname)){
  //FileUpload:OK
} else {
  //FileUpload:NG
  echo "Upload failed";
  echo $_FILES['upfile']['error'];
}

//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();       //function内の$pdoを受け取る
//echo $pdo;

//３．データ登録SQL作成
$sql = "INSERT INTO user_table(name,lmail,lpw,fname,kanri_flg,life_flg)VALUES(:name,:lmail,:lpw,:fname,:kanri_flg,:life_flg)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lmail', $lmail, PDO::PARAM_STR); 
$stmt->bindValue(':lpw', $hash_pass, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fname',$fname, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("../toppage.php");
}

