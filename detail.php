<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。

include("funcs.php");
session_start();
$pdo = db_conn();

$username = $_SESSION["name"];
$fname = $_SESSION["fname"];
$userid = $_SESSION['user_id'];
if (isset($userid)) {//ログインしているとき
    $msg = 'こんにちは' . h($username) . 'さん';
    $img ='<img src="./img/'.$fname.'" alt="" width=200 height=100 class="rounded-circle"  loading="lazy">';
    // $img ='<img src="./img/'.'hada.jpeg'.'" alt="" width=200 height=100 class="rounded-circle"  loading="lazy">';
    $link = '<a href="logout.php" class="d-block btn btn-outline-info btn-rounded">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="toppage.php" class="d-block btn btn-outline-info btn-rounded">ログイン</a>';
}

//GET受信
$id = $_GET["id"]; //id=**
// $id = 1;

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM learn_tb WHERE Learn_id=:Learn_id");
$stmt->bindValue(':Learn_id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  $r = $stmt->fetch();
}
?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"

-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>学習時間管理アプリ</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="icon" type="image/png" href="img/pencil.ico" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/admin.css" />
    <!-- <jQuery> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- flatpicker用 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <!-- テーブルソート用 -->
    <script src="js/jquery.tablesorter.min.js"></script>
    <!-- グラフ用 -->
    <script src="https://cdn.plot.ly/plotly-1.2.0.min.js"></script>
    <!-- googleカレンダー用 -->
    <link href='lib/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <!--Main Navigation-->
  <header>
      <!-- Sidebar -->
      <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
          <div class="position-sticky">
              <div class="list-group list-group-flush mx-3 mt-4 sticky-top" id="sidebar-list">
                  <p class="fs-5"><?php echo $msg ?></p>
                  <?php echo $img ?>
                  <br>
                  <?php echo $link ?>
                  <br>
                  <a href="#StopWatch" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                      <i class="fas fa-clock fa-fw me-3"></i><span>StopWatch</span>
                  </a>
                  <a href="#Timer" class="list-group-item list-group-item-action py-2 ripple">
                      <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Timer</span>
                  </a>
                  <a href="#Todolist" class="list-group-item list-group-item-action py-2 ripple">
                      <i class="fas fa-list fa-fw me-3"></i><span>TodoList</span>
                  </a>
                  <a href="#Diary" class="list-group-item list-group-item-action py-2 ripple"><i
                          class="fas fa-book fa-fw me-3"></i><span>Diary</span></a>
                  <a href="#Chart" class="list-group-item list-group-item-action py-2 ripple"><i
                          class="fas fa-chart-bar fa-fw me-3"></i><span>Chart</span></a>
                  <a href="#Calender" class="list-group-item list-group-item-action py-2 ripple">
                      <i class="fas fa-calendar-alt fa-fw me-3"></i><span>Calender</span>
                  </a>
                  <!-- <a href="user/userdetail.php?id=<//?php echo $userid ?>" class="list-group-item list-group-item-action py-2 ripple">
                      <i class="fas fa-cog fa-fw me-3"></i><span>Setting</span>
                  </a> -->
              </div>
          </div> 
      </nav>
      <!-- Sidebar -->
  </header>
    <!--Main Navigation-->

<!-- Main[Start] -->
  <main>
    <div class="container pt-4 main">
      <section class="mb-4" id="Diary">
        <div class="card">
          <div class="card-header text-center py-3 bg-info">
            <h5 class="mb-0 text-center">
              <strong>Diary</strong>
            </h5>
          </div>
          <div class="card-body">
            <div class="container">
            <form class="p-4" method="POST" action="update.php">
              <input type="hidden" name="user_id" value="<?=$userid?>">
              <div class="input-group date mb-3" id="datetimepicker1" data-target-input="nearest">
                <label for="datetimepicker1" class="pt-1 pr-1">日付</label>
                <input name="date" type="date" id="date" data-input class="form-control" data-target="#datetimepicker1"
                  style='background:white' value="<?=$r["Date"]?>" required/>
                <div class="input-group-text" data-target="#datetimepicker1" data-toggle="datetimepicker">
                  <i class="far fa-calendar-alt"></i>
                </div>
              </div>
              <br>
              <div class="d-flex justify-content-between">
                <label class="form-label" for="typeNumber">学習時間(インプット)</label>
                <div class="form-outline">
                  <input name="input" step="60" type="time" id="inputTime" class="form-control" value="<?=$r["Input"]?>" max="23:59" required/>
                </div>
                <label class="form-label" for="typeNumber">学習時間(アウトプット)</label>
                <div class="form-outline">
                  <input name="output" step="60" type="time" id="outputTime" class="form-control" value="<?=$r["Output"]?>"  max="23:59" required/>
                </div>
              </div>  
              <br>        
              <label class="pt-1 pr-1">学習時間(合計）</label>
              <br>
              <div class="row">
                <div class="col-1"></div>
                <div class="col-3">
                  <div class="d-flex justify-content-end">
                    <p id="totalHour"></p>
                    <p>時間</p>
                  </div>
                </div>
                <div class="col-1"></div>
                <div class="col-3">
                  <div class="d-flex justify-content-end">
                    <p id="totalMinute"></p>
                    <p>分</p>
                  </div>
                </div>
                <div class="col-1"></div>
              </div>
              <br>
              <label class="pt-1 pr-1">学習内容</label>
              <div class="form-outline">
                <br>
                <textarea name="contents" class="form-control" id="contents" rows="5" required><?=$r["Contents"]?></textarea>
                <label class="form-label" for="textAreaExample"></label>
              </div>
              <br>
              <label class="pt-1 pr-1">感想・反省</label>
              <div class="form-outline">
                <br>
                <textarea name="thoughts" class="form-control" id="thoughts" rows="5" required><?=$r["Thoughts"]?></textarea>
                <label class="form-label" for="textAreaExample"></label>
              </div>
              <input type="hidden" name="id" value="<?=$r["Learn_id"]?>">
              <br>
              <div class="d-flex justify-content-evenly">
                <input type="submit" class="btn btn-outline-info btn-rounded" value="登録">
              </div>
            </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
<!-- Main[End] -->

  <?php include("html/footer.html");?>
</body>
</html>



