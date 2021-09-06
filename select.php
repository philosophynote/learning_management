<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM learn_tb");
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view.='<p>';//p開始タグ
    $view.=$r["Learn_id"]."|".$r["Date"]."|".$r["Input"]."|".$r["Output"]."|".$r["Contents"]."|".$r["Thoughts"];
    $view.="　";
    $view.='<input type="button" onclick="location.href='detail.php'" "value="編集">';//シングルクォート
    // $view.="[編集]";
    $view.='<button  href="delete.php?id='.$r["Learn_id"].'">';//シングルクォート
    $view.="[削除]";
    $view.='</button>';
    $view.='</p>';//p終了タグ
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
    
</div>
<!-- Main[End] -->

</body>
</html>
