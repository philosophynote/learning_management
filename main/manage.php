<?php
include("funcs.php");
session_start();
$username = $_SESSION["name"];
$fname = $_SESSION["fname"];
$userid = $_SESSION['user_id'];

if (isset($userid)) {//ログインしているとき
    $msg = 'こんにちは' . h($username) . 'さん';
    $img ='<img src="../img/'.$fname.'" alt="" width=200 height=100 class="rounded-circle"  loading="lazy">';
    $link = '<a href="logout.php" class="d-block btn btn-outline-info btn-rounded">ログアウト</a>';
} else {//ログインしていない時
    $msg = 'ログインしていません';
    $link = '<a href="toppage.php" class="d-block btn btn-outline-info btn-rounded">ログイン</a>';
}


$pdo = db_conn();


//該当するユーザの情報を引っ張る
$sql= "SELECT * FROM learn_tb JOIN user_table ON learn_tb.User_id = user_table.user_id WHERE learn_tb.User_id={$userid}";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$data_array=Array();
$Date=Array();
//データ表示
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
    $view.='<a class="btn btn-outline-info btn-rounded" href="delete.php?id='.$r["Learn_id"].'">';//シングルクォート
    $view.="削除";
    $view.='</a></td>';
    $view.='</tr>';
    $data_array[] = $r; 
  }
}
  foreach($data_array as $key => $val){
     $Date[$key] = $val["Date"];
}
array_multisort($Date, SORT_DESC, $data_array);

$json_data=json_encode($data_array);

$_SESSION["user_id"]   = $userid;
$_SESSION["name"]      = $username;
$_SESSION["fname"]     = $fname;

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
    <link rel="icon" type="image/png" href="../img/pencil.ico" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/admin.css" />
    <!-- <jQuery> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- flatpicker用 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <!-- テーブルソート用 -->
    <script src="./js/jquery.tablesorter.min.js"></script>
    <!-- グラフ用 -->
    <script src="https://cdn.plot.ly/plotly-1.2.0.min.js"></script>
    <!-- googleカレンダー用 -->
    <link href='../lib/main.css' rel='stylesheet' />
    <link rel="stylesheet" href="../css/style.css" />
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
              </div>
          </div> 
      </nav>
      <!-- Sidebar -->
  </header>
    <!--Main Navigation-->

  <!--Main layout-->
  <main>
    <div class="container pt-4 main bgc" data-mdb-spy="scroll" data-mdb-target="#sidebar-list" data-mdb-offset="0">
      <?php include("../html/stopwatch.html");?>
      <?php include("../html/timer.html");?>
      <?php include("../html/todolist.html");?>
      <!--Section: Diary-->
      <section class="mb-4" id="Diary">
        <div class="card">
          <div class="card-header text-center py-3 bg-info">
            <h5 class="mb-0 text-center">
              <strong>Diary</strong>
            </h5>
          </div>
          <div class="card-body">
            <div class="container">
              <form class="p-4" method="POST" action="insert.php">
                <input type="hidden" name="user_id" value="<?=$userid?>">
                <div class="input-group date mb-3" id="datetimepicker1" data-target-input="nearest">
                  <label for="datetimepicker1" class="pt-1 pr-1">日付</label>
                  <input name="date" type="date" id="date" data-input class="form-control" data-target="#datetimepicker1"
                    style='background:white' required/>
                  <div class="input-group-text" data-target="#datetimepicker1" data-toggle="datetimepicker">
                    <i class="far fa-calendar-alt"></i>
                  </div>
                </div>
                <br>
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="typeNumber">学習時間(インプット)</label>
                  <div class="form-outline">
                    <input name="input" step="60" type="time" id="inputTime" class="form-control" value="00:00" max="23:59" required/>
                  </div>
                  <label class="form-label" for="typeNumber">学習時間(アウトプット)</label>
                  <div class="form-outline">
                    <input name="output" step="60" type="time" id="outputTime" class="form-control" value="00:00"  max="23:59" required/>
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
                <label class="pt-1 pr-1">学習内容</label>
                <div class="form-outline">
                  <br>
                  <textarea name="contents" class="form-control" id="contents" rows="5" required></textarea>
                  <label class="form-label" for="textAreaExample"></label>
                </div>
                <br>
                <label class="pt-1 pr-1">感想・反省</label>
                <div class="form-outline">
                  <br>
                  <textarea name="thoughts" class="form-control" id="thoughts" rows="5" required></textarea>
                  <label class="form-label" for="textAreaExample"></label>
                </div>
                <br>
                <div class="d-flex justify-content-evenly">
                  <input type="submit" class="btn btn-outline-info btn-rounded" value="登録">
                </div>
              </form>
              <br>
              <d class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header bg-info bg-gradient" id="headingOne">
                    <button class="accordion-button" type="button" data-mdb-toggle="collapse"
                      data-mdb-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      学習記録を広げる
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-mdb-parent="#accordionExample">
                    <div class="accordion-body">
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
                    </div>
                  </div>
                </div>
                <br>
                <?php include("note.php");?>
                <br>
              </div>
            </div>
          </div>
      </section>
      <!-- Section: Diary -->
      <section class="mb-4" id="Chart"> 
        <div class="card">
            <div class="card-header text-center py-3 bg-info">
            <h5 class="mb-0 text-center">
                <strong>Chart</strong>
            </h5>
            </div>
            <div class="card-body">
            <div>
                <div id="studyGraph_7" class="justify-content-between" ></div>
            </div>
            <div>
                <div id="studyGraph_30" class="justify-content-between"></div>
            </div>
            <br>
            <br>
            <table class="table text-center">
                <tr class="table-info ">
                <th>名称</th>
                <th>学習時間直近1週間</th>
                <th>学習時間直近1か月</th>
                </tr>
                <tr>
                <td>合計値</td>
                <td id="sum_7"></td>
                <td id="sum_30"></td>
                </tr>
                <tr>
                <td>平均値</td>
                <td id="average_7"></td>
                <td id="average_30"></td>
                </tr>
                <tr>
                <td>最大値</td>
                <td id="max_7"></td>
                <td id="max_30"></td>
                </tr>
                <tr>
                <td>最小値</td>
                <td id="min_7"></td>
                <td id="min_30"></td>
                </tr>
            </table>
            <br>
            </div>
            </div>
        </div>
      </section> 
    <!--Section: Stastics-->
    <!--Section: MiniStatics-->
      <section>
        <div class="row">
            <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <i class="fas fa-map-signs text-info fa-3x me-4"></i>
                    </div>
                    <div>
                        <h4>Average Learning Time</h4>
                        <p class="mb-0">Just do it!</p>
                    </div>
                    </div>
                    <div class="align-self-center">
                    <h2 class="h3 mb-0" id="average_all"></h2>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <i class="fas fa-chart-line text-warning fa-3x me-4"></i>
                    </div>
                    <div>
                        <h5>Cumulative Learning Time</h5>
                        <p class="mb-0">Curiousity Drives Us Forward.</p>
                    </div>
                    </div>
                    <div class="align-self-center">
                    <h2 class="h3 mb-0" id="sum_all"></h2>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
          <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <h2 class="h1 mb-0 me-4" id="OIR">1</h2>
                    </div>
                    <div>
                        <h4>Output/Input Ratio</h4>
                        <p class="mb-0">Deploy or Die!</p>
                    </div>
                    </div>
                    <div class="align-self-center">
                    <i class="fas fa-pen text-danger fa-3x"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-xl-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <h2 class="h1 mb-0 me-4" id="continus_days"></h2>
                    </div>
                    <div>
                        <h4>Cumulative days</h4>
                        <p class="mb-0">Yes, We Can!</p>
                    </div>
                    </div>
                    <div class="align-self-center">
                    <i class="far fa-user text-success fa-3x"></i>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
      </section>

      <?php include("../html/calender.html");?>
    </div>
  </main>
  <!--Main layout-->
  <script>
    let json_data = JSON.parse('<?php echo $json_data?>');
    const Date_array=[];
    const Input_array=[];
    const Output_array=[];
    const Contents_array=[];
    const Thoughts_array=[];
    for(i=0;i<json_data.length;i++){
        Date_array.push(json_data[i].Date);
        Input_array.push(json_data[i].Input);
        Output_array.push(json_data[i].Output);
        Contents_array.push(json_data[i].Contents);
        Thoughts_array.push(json_data[i].Thoughts);
    }
    const timecali = (a,b) =>{
        let [input_hour, input_minute] = a.split(':')
        let [output_hour, output_minute] = b.split(':')
        let totalhour = Number(input_hour) + Number(output_hour);
        let totalminute = Number(input_minute) + Number(output_minute);
        if (totalminute > 59){
            totalhour+=1;
            totalminute = totalminute%60;
        }        
        return [totalhour,totalminute];
    }
    totalTime=[];
    for (i=0;i<Input_array.length;i++){
        let [input_hour, input_minute] = Input_array[i].split(':')
        let [output_hour, output_minute] = Output_array[i].split(':')
        let totalhour = Number(input_hour) + Number(output_hour);
        let totalminute = Number(input_minute) + Number(output_minute);
        if (totalminute > 59){
            totalhour+=1;
            totalminute = totalminute%60;
        }
        let total = "";
        total=String(totalhour)+":"+String(totalminute);
        totalTime.push(total);
    }
    // //関数化    
    // // }
    TESTER = $('#studyGraph_7');
    let StudyDays_7 = 0;
    if (Date_array.length >= 7) {
        StudyDays_7 = 7;
    } else {
        StudyDays_7 = Date_array.length;
    };
    //過去７日間のグラフを作成
    const Date_7 = [];
    const TotalTime_7 = [];
    const InputTime_7 = [];
    const OutputTime_7 = [];

    for (i=0;i<StudyDays_7;i++){
        Date_7.push(Date_array[i]);
        let [input_hour, input_minute] = Input_array[i].split(':')
        let [output_hour, output_minute] = Output_array[i].split(':')
        let inputtime = Number(input_hour*60) + Number(input_minute);
        let outputtime = Number(output_hour*60) + Number(output_minute);
        let totaltime =inputtime + outputtime;
        InputTime_7.push(inputtime);
        OutputTime_7.push(outputtime);
        TotalTime_7.push(totaltime);
    } 
    


    const Inputgraph_7 = {
        x: Date_7,
        y: InputTime_7,
        name: 'インプット時間',
        type: 'bar'
    };

    const Outputgraph_7 = {
        x: Date_7,
        y: OutputTime_7,
        name: 'アウトプット時間',
        type: 'bar'
    };

    let config = {
        responsive: true,
        showLink: true,
        plotlyServerURL: "https://chart-studio.plotly.com"
    };

    let data_7 = [Inputgraph_7, Outputgraph_7];

    let layout_7 = { title: "学習時間(過去７日間 単位：分)", barmode: 'stack' };

    Plotly.newPlot('studyGraph_7', data_7, layout_7, config);


    let maxtime_7 = Math.max.apply(null, TotalTime_7)
    let mintime_7 = Math.min.apply(null, TotalTime_7)
    let SumTime_7 = TotalTime_7.reduce((sum, element) => sum + element, 0);
    let averagetime_7 = SumTime_7 / StudyDays_7;

    $("#sum_7").text(`${Math.floor(SumTime_7/60)} 時間${Math.floor(SumTime_7%60)} 分`);
    $("#average_7").text(`${Math.floor(SumTime_7 / StudyDays_7/60)} 時間${Math.floor(SumTime_7 / StudyDays_7%60)} 分`);
    $("#max_7").text(`${Math.floor(maxtime_7/60)} 時間${Math.floor(maxtime_7%60)} 分`);
    $("#min_7").text(`${Math.floor(mintime_7/60)} 時間${Math.floor(mintime_7%60)} 分`);

    //過去30日間のグラフを作成
    TESTER = $('#studyGraph_30');
    let StudyDays_30 = 0;
    if (Date_array.length >= 30) {
        StudyDays_30 = 30;
    } else {
        StudyDays_30 = Date_array.length;
    };
    
    const Date_30 = [];
    const TotalTime_30 = [];
    const InputTime_30 = [];
    const OutputTime_30 = [];

    for (i=0;i<StudyDays_30;i++){
        Date_30.push(Date_array[i]);
        let [input_hour, input_minute] = Input_array[i].split(':')
        let [output_hour, output_minute] = Output_array[i].split(':')
        let inputtime = Number(input_hour*60) + Number(input_minute);
        let outputtime = Number(output_hour*60) + Number(output_minute);
        let totaltime = inputtime + outputtime;
        InputTime_30.push(inputtime);
        OutputTime_30.push(outputtime);
        TotalTime_30.push(totaltime);
    } 

    const Inputgraph_30 = {
        x: Date_30,
        y: InputTime_30,
        name: 'インプット時間',
        type: 'bar'
    };

    const Outputgraph_30 = {
        x: Date_30,
        y: OutputTime_30,
        name: 'アウトプット時間',
        type: 'bar'
    };



    let data_30 = [Inputgraph_30, Outputgraph_30];

    let layout_30 = { title: "学習時間(過去30日間 単位：分)", barmode: 'stack' };

    Plotly.newPlot('studyGraph_30', data_30, layout_30, config);

    let maxtime_30 = Math.max.apply(null, TotalTime_30)
    let mintime_30 = Math.min.apply(null, TotalTime_30)
    let SumTime_30 = TotalTime_30.reduce((sum, element) => sum + element, 0);
    let averagetime_30 = SumTime_30 / StudyDays_30;
    
    $("#sum_30").text(`${Math.floor(SumTime_30/60)} 時間${Math.floor(SumTime_30%60)} 分`);
    $("#average_30").text(`${Math.floor(SumTime_30 / StudyDays_30/60)} 時間${Math.floor(SumTime_30 / StudyDays_30%60)} 分`);
    $("#max_30").text(`${Math.floor(maxtime_30/60)} 時間${Math.floor(maxtime_30%60)} 分`);
    $("#min_30").text(`${Math.floor(mintime_30/60)} 時間${Math.floor(mintime_30%60)} 分`);


    const TotalTime_all = [];
    const InputTime_all = [];
    const OutputTime_all = [];
    
    for (i=0;i<Date_array.length;i++){

        let [input_hour, input_minute] = Input_array[i].split(':')
        let [output_hour, output_minute] = Output_array[i].split(':')
        let inputtime = Number(input_hour*60) + Number(input_minute); 
        let outputtime = Number(output_hour*60) + Number(output_minute);
        let totaltime =inputtime + outputtime;
        InputTime_all.push(inputtime);
        OutputTime_all.push(outputtime);
        TotalTime_all.push(totaltime);
    } 

    let SumInputTime_all =0;
    let SumOutputTime_all =0;
    let SumTime_all = TotalTime_all.reduce((sum, element) => sum + element, 0);
    SumInputTime_all = InputTime_all.reduce((sum, element) => sum + element, 0);
    SumOutputTime_all = OutputTime_all.reduce((sum, element) => sum + element, 0);
    let averagetime_all = SumTime_all / Date_array.length;

    // averagetime_all=(total_all_hour*60+total_all_minute)/Date_array.length;
    let OIR = Math.round((SumOutputTime_all / SumInputTime_all));
    $("#sum_all").text(`${Math.floor(SumTime_all/60)} 時間${Math.floor(SumTime_all%60)} 分`);
    $("#average_all").text(`${Math.floor(averagetime_all/60)} 時間${Math.floor(averagetime_all%60)} 分`);
    $("#OIR").text(`${OIR}`)
    $("#continus_days").text(`${Date_array.length}日`);


    function hankaku2Zenkaku(str) {
      return str.replace(/[０-９]/g, function (s) {
          return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
      });
    }
    
    $("#CallNoteDate").on("click", function () {
        CallDate = $("#NoteDate").val().split('/').join('-');
        targetarray=Array();
        for (var i = 0; i <json_data.length;i++){
          if (CallDate==json_data[i].Date){
            targetarray.push(json_data[i]);
          }
        }
        const TargetInput = targetarray[0]["Input"];
        const TargetOutput = targetarray[0]["Output"];
        const Contents = targetarray[0]["Contents"];
        const Thoughts = targetarray[0]["Thoughts"];
        let Month = String(Number(CallDate.split("-")[1]));
        let Day = String(Number(CallDate.split("-")[2]));

        Month = Month.replace(/[0-9]/g,
            function (s) {
                return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
            }
        );
        Day = Day.replace(/[0-9]/g,
            function (s) {
                return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
            }
        );
        $("#NoteTitle").val(`【${Month}月${Day}日　学習記録】`);
        TotalStudyTimelist=timecali(TargetInput,TargetOutput);
        $("#NoteContent").val(`学習時間：${TotalStudyTimelist[0]}時間${TotalStudyTimelist[1]}分\n\n学習内容：${Contents}\n\n感想：${Thoughts}`);
    });

    $("#NoteClear").on("click", function () {
        $("#NoteDate").val("");
        $("#NoteTitle").val("");
        $("#NoteContent").val("");
    });

  </script>
<?php include("../html/footer.html");?>