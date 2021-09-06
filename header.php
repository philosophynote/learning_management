
<?php


// $mail = $mail;
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
// include("funcs.php");
// $pdo = db_conn();


//２．データ登録SQL作成
// $stmt_l = $pdo->prepare("SELECT * FROM learn_tb");
// $status_l = $stmt_1->execute();
// $stmt_u = $pdo->prepare("SELECT * FROM user_table");
// $status_u = $stmt_u->execute();


// //３．データ表示
// if($status_u==false) {
//   sql_error($stmt_u);
// }else{
//   while($res = $stmt_u->fetch(PDO::FETCH_ASSOC)){
//     $name = $res['name']
//     $fname = $res["fname"]
//   }
// }

// $view="";
// if($status_l==false) {
//   sql_error($stmt_l);
// }else{
//   while($r = $stmt_l->fetch(PDO::FETCH_ASSOC)){
//     $view.='<tr><td>';
//     $view.=$r["Date"]."</td><td>";
//     $view.=$r["Input"]."</td><td>";
//     $view.=$r["Output"]."</td><td>";
//     $view.=$r["Contents"]."</td><td>";
//     $view.=$r["Thoughts"]."</td><td>";
//     $view.='<a class="btn btn-outline-info btn-rounded" href="detail.php?id='.$r["Learn_id"].'">';//シングルクォート
//     $view.="編集";
//     $view.='</a></td><td>';
//     // $view.='<button type="button" onclick=“location.href=\‘’.‘detail.php?id=’.$res[“Learn_id”].‘\’“>編集</button>';
//     // $view.='</button></td><td>';
//     $view.='<a class="btn btn-outline-info btn-rounded" href="delete.php?id='.$r["Learn_id"].'">';//シングルクォート
//     $view.="削除";
//     $view.='</a></td>';
//     // $view.='<button type=“button” onclick=“location.href=\‘’.‘delete.php?id=’.$res[“Learn_id”].‘\’“>削除</button>';
//     // $view.='</button></td>';   
//     $view.='</tr>';
//   }
// }
?>
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
                    <div class="profile-img">
                        <?php ?>
                        <!-- <img src="img/hada.jpeg" class="rounded-circle" height="80" alt="" loading="lazy" /> -->
                    </div>
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
                    <a href="user/userindex.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-cog fa-fw me-3"></i><span>Setting</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->