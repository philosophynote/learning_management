<?php include("funcs.php");?>
<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();
try{
  if (empty($_POST["token"]) || empty($_SESSION["token"]) || h($_POST["token"]) !== $_SESSION["token"]){
    throw new Exception('token mismatched');
  } 
  }catch(Exception $e){
    echo $e->getMessage();
}

//POST値
$lmail = h($_POST["lmail"]); //login id
// $lpw = password_hash($_POST["lpw"],PASSWORD_DEFAULT); //login Password


//1.  DB接続します
$pdo = db_conn();

//2. データ登録SQL作成
$sql = "SELECT * FROM user_table WHERE lmail=:lmail AND life_flg=1";
$stmt = $pdo->prepare("$sql"); //* PasswordがHash化の場合→条件はlmailのみ
$stmt->bindValue(':lmail', $lmail, PDO::PARAM_STR);
// $stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //* PasswordがHash化する場合はコメントする
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()
// verd ($_POST);
// verd ($val);
//5. 該当レコードがあればSESSIONに値を代入
if(password_verify(h($_POST["lpw"]),$val["lpw"])){ //* PasswordがHash化の場合はこっちのIFを使う
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["user_id"]   = $val['user_id'];
  $_SESSION["name"]      = $val['name'];
  $_SESSION["fname"]     = $val['fname'];
  redirect("manage.php");
}else{
  //Login失敗時(Logout経由)
  echo '<script>alert("ログインに失敗しました。メールアドレスとパスワードを確認してください")</script>';
  redirect("html/error.html");
}




