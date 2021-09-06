<?php include("funcs.php");?>
<?php
//SESSION開始
session_start();
//エラーチェック
try{
  if (empty($_POST["token"]) || empty($_SESSION["token"]) || h($_POST["token"]) !== $_SESSION["token"]){
    throw new Exception('token mismatched');
  } 
  }catch(Exception $e){
    echo $e->getMessage();
}

//POST値
$lmail = h($_POST["lmail"]); //login id

//DB接続
$pdo = db_conn();

//該当するユーザーをDBから取り出す
$sql = "SELECT * FROM user_table WHERE lmail=:lmail AND life_flg=1";
$stmt = $pdo->prepare("$sql"); //* PasswordがHash化の場合→条件はlmailのみ
$stmt->bindValue(':lmail', $lmail, PDO::PARAM_STR);
$status = $stmt->execute();

//SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//抽出データ数を取得
$val = $stmt->fetch();         

//該当レコードがあればSESSIONに値を代入
if(password_verify(h($_POST["lpw"]),$val["lpw"])){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["user_id"]   = $val['user_id'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["fname"]     = $val['fname'];
  redirect("manage.php");
}else{
  //Login失敗時(error.html経由)
  echo '<script>alert("ログインに失敗しました。メールアドレスとパスワードを確認してください")</script>';
  redirect("../html/error.html");
}




