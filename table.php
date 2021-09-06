<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
// include("funcs.php");
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
    $view.='<tr><td>';
    $view.=$r["Date"]."</td><td>";
    $view.=$r["Input"]."</td><td>";
    $view.=$r["Output"]."</td><td>";
    $view.=$r["Contents"]."</td><td>";
    $view.=$r["Thoughts"]."</td><td>";
    $view.='<a class="btn btn-outline-info btn-rounded" href="detail.php?id='.$r["Learn_id"].'">';//シングルクォート
    $view.="編集";
    $view.='</a></td><td>';
    // $view.='<button type="button" onclick=“location.href=\‘’.‘detail.php?id=’.$res[“Learn_id”].‘\’“>編集</button>';
    // $view.='</button></td><td>';
    $view.='<a class="btn btn-outline-info btn-rounded" href="delete.php?id='.$r["Learn_id"].'">';//シングルクォート
    $view.="削除";
    $view.='</a></td>';
    // $view.='<button type=“button” onclick=“location.href=\‘’.‘delete.php?id=’.$res[“Learn_id”].‘\’“>削除</button>';
    // $view.='</button></td>';   
    $view.='</tr>';
  }
}
?>

<table class="table table-striped table-hover display" id="table_id">
    <thead>
        <tr class="table-info">
        <th>日付</th>
        <th>インプット時間</th>
        <th>アウトプット時間</th>
        <th>学習内容</th>
        <th>感想・反省</th>
        <th>編集</th>
        <th>削除</th>
        </tr>
    </thead>
    <tbody id="table_body">
        <?=$view?>
    </tbody>
</table>
