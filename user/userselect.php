<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("../funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user_table");
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view.='<tr><td>';
    $view.=$r["user_id"]."</td><td>";
    $view.=$r["name"]."</td><td>";
    $view.=$r["lmail"]."</td><td>";
    $view.=$r["lpw"]."</td><td>";
    $view.=$r["kanri_flg"]."</td><td>";
    $view.=$r["life_flg"]."</td><td>";
    $view.='<a class="btn btn-outline-info btn-rounded" href="userdetail.php?id='.$r["user_id"].'">';//シングルクォート
    $view.="編集";
    $view.='</a></td><td>';
    // $view.='<button type="button" onclick=“location.href=\‘’.‘detail.php?id=’.$res[“Learn_id”].‘\’“>編集</button>';
    // $view.='</button></td><td>';
    $view.='<a class="btn btn-outline-info btn-rounded" href="userdelete.php?id='.$r["user_id"].'">';//シングルクォート
    $view.="削除";
    $view.='</a></td>';
    // $view.='<button type=“button” onclick=“location.href=\‘’.‘delete.php?id=’.$res[“Learn_id”].‘\’“>削除</button>';
    // $view.='</button></td>';   
    $view.='</tr>';
  }
}
?>



<?php include("html/header.html");?>
<!-- Main[Start] -->
    <div class="container pt-4 main" data-mdb-spy="scroll" data-mdb-target="#sidebar-list" data-mdb-offset="0">
      <div class="card">
          <div class="card-header text-center py-3 bg-info d-flex justify-content-evenly">
            <h5 class="mb-0 text-center">
              <strong>ユーザー一覧</strong>
            </h5>
            <h5 class="mb-0 text-center">
              <a href="userindex.php"><strong>ユーザー登録へ</strong></a>
            </h5>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover display" id="table_id">
                <thead>
                    <tr class="table-info">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>ユーザーID</th>
                    <th>パスワード</th>
                    <th>管理者フラグ</th>
                    <th>入退会フラグ</th>
                    <th>編集</th>
                    <th>削除</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                    <?=$view?>
                </tbody>
            </table>
            <a href="../manage.php" class="btn btn-outline-info btn-rounded">元の画面に戻る</a>
          </div>
      </div>
    </div>

<!-- Main[End] -->

<?php include("html/footer.html");?>