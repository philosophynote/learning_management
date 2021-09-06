
<?php include("statics.php")?>

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
            <th>学習時間(直近1週間)</th>
            <th>学習時間(直近1か月)</th>
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

<!--Section: MiniStatics-->
<script>
//ミリ秒を秒に直す関数
// let TotalTime = (StudyTime) => {
//     TotalHour = Math.floor(StudyTime / 1000 / 60 / 60);
//     TotalMinute = Math.floor(StudyTime / 1000 / 60) % 60;
//     TotalSecond = Math.floor(StudyTime / 1000) % 60;
//     return [TotalHour, TotalMinute, TotalSecond];
// }

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
    //let time = [];
    //time = timecali("12:42","3:23")
    //console.log(time[0]);
    //console.log(time[1]);
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

    // //基本統計量表示 （合計値、平均値、最大値、最小値）

    // let SumTime_30_hour = 0;
    // let SumTime_30_minute = 0;
    // let total_hour_30 = 0;
    // let total_minute_30 = 0;
    // for (i = 0; i < TotalTime_30.length; i++) {
    //     let [total_hour_30, total_minute_30] = TotalTime_30[i].split(':')
    //     SumTime_30_hour+=Number(total_hour_30);
    //     SumTime_30_minute+=Number(total_minute_30);
    //     if (SumTime_30_minute > 59){
    //         SumTime_30_hour +=Math.floor(SumTime_30_minute/60);
    //         SumTime_30_minute = total_minute_30%60;
    //     }
    // }

    // let SumTime_30=0
    // SumTime_30=SumTime_30_hour*60+SumTime_30_minute;
    // let averagetime_30 = SumTime_30 / StudyDays_30
    // TotalTime_30_list=[];
    // for (i = 0; i < TotalTime_30.length; i++) {
    //     let [total_hour_30, total_minute_30] = TotalTime_30[i].split(':');
    //     let total_time =0;
    //     total_time=Number(total_hour_30*60)+Number(total_minute_30);
    //     TotalTime_30_list.push(total_time);
    // }
    // let maxtime_30 = Math.max.apply(null, TotalTime_30_list)
    // let mintime_30 = Math.min.apply(null, TotalTime_30_list)

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

    
    // total_all_hour =0;
    // total_all_minute =0;
    //総学習時間
    // for (i = 0; i < totalTime.length; i++) {
    //     let [total_all_hour, total_all_minute] = totalTime[i].split(':')
    //     total_all_hour+=Number(total_all_hour);
        
    //     total_all_minute+=Number(total_all_minute);
    //     if (total_all_minute > 59){
    //         total_all_hour +=Math.floor(total_all_minute/60);
    //         total_all_minute = total_all_minute%60;
    //     }
    //     console.log(total_all_hour)
    // }
    
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
    // input_hour_all=0
    // input_minute_all=0
    // for (i = 0; i < Input_array.length; i++) {
    //     let [input_hour_all, input_minute_all] = Input_array[i].split(':')
    //     input_hour_all=Number(input_hour_all);
    //     input_minute_all=Number(input_minute_all);
    //     if (input_minute_all > 59){
    //         input_hour_all +=Math.floor(input_minute_all/60);
    //         input_minute_all = input_minute_all%60;
    //     }
    // }
    // //output_hour_all=0
    // //output_minute_all=0
    // for (i = 0; i < Output_array.length; i++) {
    //     let [output_hour_all, output_minute_all] = Output_array[i].split(':')
    //     output_hour_all=Number(output_hour_all);
    //     output_minute_all=Number(output_minute_all);
    //     if (output_minute_all > 59){
    //         output_hour_all =Math.floor(output_minute_all/60);
    //         output_minute_all = output_minute_all%60;
    //     }
    // }
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

    // //基本統計量表示 （合計値、平均値、最大値、最小値）

    // for (let i = 0; i < StudyDays_7; i++) {
    //     Date_7.push(Date_array[i]);
    //     TotalTime_7.push(totalTime[i]);
    //     InputTime_7.push(Input_array[i]);
    //     OutputTime_7.push(Output_array[i]);
    // }

    // let SumTime_7_hour = 0;
    // let SumTime_7_minute = 0;
    // let total_minute = 0;
    // for (i = 0; i < TotalTime_7.length; i++) {
    //     let [total_hour, total_minute] = TotalTime_7[i].split(':')
    //     SumTime_7_hour+=Number(total_hour);
    //     SumTime_7_minute+=Number(total_minute);
    //     if (SumTime_7_minute > 59){
    //         SumTime_7_hour = SumTime_7_hour + Math.floor(SumTime_7_minute/60);
    //         SumTime_7_minute = total_minute%60;
    //     }
    // }

    // let SumTime_7=0
    // SumTime_7=SumTime_7_hour*60+SumTime_7_minute;
    // let averagetime_7 = SumTime_7 / StudyDays_7
    // TotalTime_7_list=[];
    // for (i = 0; i < TotalTime_7.length; i++) {
    //     let [total_hour, total_minute] = TotalTime_7[i].split(':');
    //     let total_time =0;
    //     total_time=Number(total_hour*60)+Number(total_minute);
    //     TotalTime_7_list.push(total_time);
    // }
    // //基本統計量表示 （合計値、平均値、最大値、最小値）

    // let SumTime_all_hour = 0;
    // let SumTime_all_minute = 0;
    // let total_hour_all = 0;
    // let total_minute_all = 0;
    // for (i = 0; i < Date_array.length; i++) {
    //     let [total_hour_all, total_minute_all] = TotalTime_all[i].split(':')
    //     SumTime_all_hour+=Number(total_hour_all);
    //     SumTime_all_minute+=Number(total_minute_all);
    //     if (SumTime_all_minute > 59){
    //         SumTime_all_hour +=Math.floor(SumTime_all_minute/60);
    //         SumTime_all_minute = total_minute_all%60;
    //     }
    // }

    // let SumTime_all=0
    // SumTime_all=SumTime_all_hour*60+SumTime_all_minute;
    // let averagetime_all = SumTime_all / Date_array.length;
    // TotalTime_all_list=[];
    // for (i = 0; i < TotalTime_all.length; i++) {
    //     let [total_hour_all, total_minute_all] = TotalTime_all[i].split(':');
    //     let total_time =0;
    //     total_time=Number(total_hour_all*60)+Number(total_minute_all);
    //     TotalTime_all_list   .push(total_time);
    // }
    // let averagetime_all = SumTime_all / Date_array.length;

</script>

<?php include("html/footer.html");?>