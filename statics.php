<?php

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
// include("funcs.php");
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM learn_tb");
$status = $stmt->execute();

//３．データ表示(select.phpと合体できそう)
if($status==false) {
  sql_error($stmt);
}else{
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data_array[] = $r; 
  }
}


  foreach($data_array as $key => $val){
     $Date[$key] = $val["Date"];
}
//配列のkeyのupdatedでソート
array_multisort($Date, SORT_DESC, $data_array);

$json_data=json_encode($data_array);
?>