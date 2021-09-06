// //ミリ秒を秒に直す関数
// let TotalTime = (StudyTime) => {
//     TotalHour = Math.floor(StudyTime / 1000 / 60 / 60);
//     TotalMinute = Math.floor(StudyTime / 1000 / 60) % 60;
//     TotalSecond = Math.floor(StudyTime / 1000) % 60;
//     return [TotalHour, TotalMinute, TotalSecond];
// }

// //学習記録テーブルを更新する関数
// const Reload = () => {
//     for (let i = 0; i < localStorage.length; i++) {
//         const Key = localStorage.key(i);//n番目のkey名を取得する
//         const DataList = JSON.parse(localStorage.getItem(Key));//値を取得
//         const Date = DataList["data0"];
//         const StudyTime = DataList["data1"];
//         const InputStudyTime = DataList["data2"];
//         const OutputStudyTime = DataList["data3"];
//         const Contents = DataList["data4"];
//         const Thoughts = DataList["data5"];
//         const Timelist = TotalTime(StudyTime);
//         const InputTimelist = TotalTime(InputStudyTime);
//         const OutputTimelist = TotalTime(OutputStudyTime);
//         const html = `<tr><td>${Date}</td><td>${Timelist[0]}時間${Timelist[1]}分${Timelist[2]}秒</td><td>${InputTimelist[0]}時間${InputTimelist[1]}分${InputTimelist[2]}秒</td><td>${OutputTimelist[0]}時間${OutputTimelist[1]}分${OutputTimelist[2]}秒</td><td>${Contents}</td><td>${Thoughts}</td></tr>`;
//         $("#table_id").find("#table_body").append(html);
//         $("#datatable_id").find("#table_body").append(html);
//     }
// };

// //学習記録を登録する関数
// const Register = () => {
//     const Date = $("#date").val();     //日付
//     const InputStudyTime = Number($("#typeInputHour").val()) * 3600000 + Number($("#typeInputMinute").val()) * 60000 + Number($("#typeInputSecond").val()) * 1000;  //インプット時間をミリ秒に変換する
//     const OutputStudyTime = Number($("#typeOutputHour").val()) * 3600000 + Number($("#typeOutputMinute").val()) * 60000 + Number($("#typeOutputSecond").val()) * 1000;  //アウトプット時間をミリ秒に変換する
//     const StudyTime = InputStudyTime + OutputStudyTime;
//     const Contents = $("#contents").val();  //内容
//     const Thoughts = $("#thoughts").val();  //感想
//     const DataList = { "data0": Date, "data1": StudyTime, "data2": InputStudyTime, "data3": OutputStudyTime, "data4": Contents, "data5": Thoughts } //列に変換
//     localStorage.setItem(Date, JSON.stringify(DataList)); //DBにセットする
//     const Timelist = TotalTime(StudyTime); //表示するためにミリ秒→時/分/秒に変換する
//     const html = `<tr><td>${Date}</td><td>${Timelist[0]}時間${Timelist[1]}分${Timelist[2]}秒</td><td>${Number($("#typeInputHour").val())}時間${Number($("#typeInputMinute").val())}分${Number($("#typeInputSecond").val())}秒</td><td>${Number($("#typeOutputHour").val())}時間${Number($("#typeOutputMinute").val())}分${Number($("#typeOutputSecond").val())}秒</td><td>${Contents}</td><td>${Thoughts}</td></tr>`;
//     $("#table_id").find("#table_body").append(html);
// }

// //グローバル変数として定義
// let CallDate = "";
// //学習記録を呼び出す関数
// const DataReload = () => {
//     const CallDate = $("#date").val();
//     const CallRow = JSON.parse(localStorage.getItem(CallDate));
//     if (CallRow === null) {
//         alert("該当する日付のデータは存在しません")
//     } else {
//         alert("データを呼び出しました")
//     };
//     const InputStudyTime = CallRow["data2"];
//     const OutputStudyTime = CallRow["data3"];
//     const Contents = CallRow["data4"];
//     const Thoughts = CallRow["data5"];
//     const InputTimelist = TotalTime(InputStudyTime);
//     const OutputTimelist = TotalTime(OutputStudyTime);
//     $("#typeInputHour").val(InputTimelist[0]);
//     $("#typeInputMinute").val(InputTimelist[1]);
//     $("#typeInputSecond").val(InputTimelist[2]);
//     $("#typeOutputHour").val(OutputTimelist[0]);
//     $("#typeOutputMinute").val(OutputTimelist[1]);
//     $("#typeOutputSecond").val(OutputTimelist[2]);
//     $("#contents").val(Contents);
//     $("#thoughts").val(Thoughts);
//     return CallDate;
// };

// //Note更新用


// // const TatalStudyTime = CallRow["data2"];
// // const Contents = CallRow["data4"];
// // const Thoughts = CallRow["data5"];
// // const TotalStudeyTimelist = TotalTime(InputStudyTime);
// // $("#NoteTitle").val(``)
// // }


// //ページをリロードする度に学習記録テーブルを更新する
// $(document).ready(function () {
//     Reload();
// });

// // function Confirm() {
// // alert("データを読み込みました")
// // DataReload(
// // alert("データを一件削除してもよろしいでしょうか"));

// // };

//インプット時間とアウトプット時間が入力されたら合計時間に反映する
// $("#inputTime,#outputTime").on('input', function () {
//     //入力されたインプット時間とアウトプット時間をミリ秒に変換する
//     const TotalHour = Number($("#inputTime").val()) + Number($("#outputTime").val());
//     console.log(TotalHour)
//     //ミリ秒→時/分/秒に変換し、合計時間を表示する
//     const Timelist = TotalTime(StudyTime);
//     console.log(TotalHour);
//     $("#totalHour").text(Timelist[0]);
//     $("#totalMinute").text(Timelist[1]);
//     $("#totalSecond").text(Timelist[2]);
// });

// //更新・削除ボタンをdisabledしておく
// $("#update").prop("disabled", true);
// $("#remove").prop("disabled", true);

// //1.Save クリックイベント
// $("#save").on("click", function () {
//     Register();
//     alert("データを保存しました");
//     $("#date,#typeInputHour,#typeInputMinute, #typeInputSecond, #typeOutputHour,#typeOutputMinute,#typeOutputSecond,#contents,#thoughts").val("");
// });

// //2.clear クリックイベント
// $("#clear").on("click", function () {
//     alert("データを削除してもよろしいですか？")
//     localStorage.clear();
//     $("#table_id").find("#table_body").empty(); //中身を空にする
//     alert("データを削除しました")
// });

// //3.call クリックイベント
// $("#call").on("click", function () {
//     CallDate = DataReload()
//     $("#update").prop("disabled", false);
//     $("#remove").prop("disabled", false);
//     $("#update").on("click", function () {
//         alert("このデータを更新してもよろしいですか")
//         localStorage.removeItem(CallDate);
//         Register();
//         $("#date,#typeInputHour,#typeInputMinute, #typeInputSecond, #typeOutputHour,#typeOutputMinute,#typeOutputSecond,#contents,#thoughts").val("");
//         alert("データを更新しました");
//         Reload();
//     });
//     $("#remove").on("click", function () {
//         alert("このデータを削除してもよろしいですか")
//         localStorage.removeItem(CallDate);
//         $("#date,#typeInputHour,#typeInputMinute, #typeInputSecond, #typeOutputHour,#typeOutputMinute,#typeOutputSecond,#contents,#thoughts").val("");
//         alert("データを削除しました");
//         Reload();
//     });
// });
// //ここまでDiary



//この下からChart
//グラフ作成の準備(裏で学習記録を呼び出し、順に並び替える)
// let StudyTable = new Array();

// for (let i = 0; i < localStorage.length; i++) {
//     const Key = localStorage.key(i);
//     DataList = JSON.parse(localStorage.getItem(Key));
//     StudyTable.push(DataList);
// }
// StudyTable.sort(function (a, b) {
//     if (a.data0 > b.data0) {
//         return -1;
//     } else {
//         return 1;
//     }
// });

// // TESTER = $('#studyGraph_7');
// let StudyDays_7 = 0;
// //過去７日間のグラフを作成
// const Date_7 = new Array();
// const TotalTime_7 = new Array();
// const InputTime_7 = new Array();
// const OutputTime_7 = new Array();

// if (StudyTable.length >= 7) {
//     StudyDays_7 = 7;
// } else {
//     StudyDays_7 = StudyTable.length;
// };

// for (let i = 0; i < StudyDays_7; i++) {
//     Date_7.unshift(StudyTable[i]["data0"]);
//     TotalTime_7.unshift(StudyTable[i]["data1"]);
//     InputTime_7.unshift(StudyTable[i]["data2"]);
//     OutputTime_7.unshift(StudyTable[i]["data3"]);
// }

// const Inputgraph_7 = {
//     x: Date_7,
//     y: InputTime_7,
//     name: 'インプット時間',
//     type: 'bar'
// };

// const Outputgraph_7 = {
//     x: Date_7,
//     y: OutputTime_7,
//     name: 'アウトプット時間',
//     type: 'bar'
// };

// let config = {
//     responsive: true,
//     showLink: true,
//     plotlyServerURL: "https://chart-studio.plotly.com"
// };

// let data_7 = [Inputgraph_7, Outputgraph_7];

// let layout_7 = { title: "学習時間(過去７日間)", barmode: 'stack' };

// Plotly.newPlot('studyGraph_7', data_7, layout_7, config);

// //基本統計量表示 （合計値、平均値、最大値、最小値）

// let SumTime_7 = 0;
// for (i = 0; i < TotalTime_7.length; i++) {
//     SumTime_7 = SumTime_7 + TotalTime_7[i];
// }

// let averagetime_7 = SumTime_7 / StudyDays_7
// let maxtime_7 = Math.max.apply(null, TotalTime_7)
// let mintime_7 = Math.min.apply(null, TotalTime_7)
// let Sumtime_7_list = TotalTime(SumTime_7)
// let averagetime_7_list = TotalTime(averagetime_7)
// let maxtime_7_list = TotalTime(maxtime_7)
// let mintime_7_list = TotalTime(mintime_7)
// $("#sum_7").text(`${Sumtime_7_list[0]} 時間${Sumtime_7_list[1]} 分${Sumtime_7_list[2]} 秒`);
// $("#average_7").text(`${averagetime_7_list[0]} 時間${averagetime_7_list[1]} 分${averagetime_7_list[2]} 秒`);
// $("#max_7").text(`${maxtime_7_list[0]} 時間${maxtime_7_list[1]} 分${maxtime_7_list[2]} 秒`);
// $("#min_7").text(`${mintime_7_list[0]} 時間${mintime_7_list[1]} 分${mintime_7_list[2]} 秒`);

// //過去30日間のグラフを作成
// let StudyDays_30 = 0;
// const Date_30 = new Array();
// const TotalTime_30 = new Array();
// const InputTime_30 = new Array();
// const OutputTime_30 = new Array();
// if (StudyTable.length >= 30) {
//     StudyDays_30 = 30;
// } else {
//     StudyDays_30 = StudyTable.length;
// };
// for (let i = 0; i < StudyDays_30; i++) {
//     Date_30.unshift(StudyTable[i]["data0"]);
//     TotalTime_30.unshift(StudyTable[i]["data1"]);
//     InputTime_30.unshift(StudyTable[i]["data2"]);
//     OutputTime_30.unshift(StudyTable[i]["data3"]);
// }

// const inputgraph_30 = {
//     x: Date_30,
//     y: InputTime_30,
//     name: 'インプット時間',
//     type: 'bar'
// };

// const outputgraph_30 = {
//     x: Date_30,
//     y: OutputTime_30,
//     name: 'アウトプット時間',
//     type: 'bar'
// };


// let data_30 = [inputgraph_30, outputgraph_30];

// let layout_30 = { title: "学習時間(過去30日間)", barmode: 'stack' };

// Plotly.newPlot('studyGraph_30', data_30, layout_30, config);



// let SumTime_30 = 0;
// for (i = 0; i < TotalTime_30.length; i++) {
//     SumTime_30 = SumTime_30 + TotalTime_30[i];
// }

// let averagetime_30 = SumTime_30 / StudyDays_30
// let maxtime_30 = Math.max.apply(null, TotalTime_30)
// let mintime_30 = Math.min.apply(null, TotalTime_30)
// let Sumtime_30_list = TotalTime(SumTime_30)
// let averagetime_30_list = TotalTime(averagetime_30)
// let maxtime_30_list = TotalTime(maxtime_30)
// let mintime_30_list = TotalTime(mintime_30)
// $("#sum_30").text(`${Sumtime_30_list[0]} 時間${Sumtime_30_list[1]} 分${Sumtime_30_list[2]} 秒`);
// $("#average_30").text(`${averagetime_30_list[0]} 時間${averagetime_30_list[1]} 分${averagetime_30_list[2]} 秒`);
// $("#max_30").text(`${maxtime_30_list[0]} 時間${maxtime_30_list[1]} 分${maxtime_30_list[2]} 秒`);
// $("#min_30").text(`${mintime_30_list[0]} 時間${mintime_30_list[1]} 分${mintime_30_list[2]} 秒`);

// const Date_all = new Array();
// const TotalTime_all = new Array();
// const InputTime_all = new Array();
// const OutputTime_all = new Array();
// for (let i = 0; i < StudyTable.length; i++) {
//     Date_all.unshift(StudyTable[i]["data0"]);
//     TotalTime_all.unshift(StudyTable[i]["data1"]);
//     InputTime_all.unshift(StudyTable[i]["data2"]);
//     OutputTime_all.unshift(StudyTable[i]["data3"]);
// }

// let SumTime_all = 0;
// for (i = 0; i < TotalTime_all.length; i++) {
//     SumTime_all = SumTime_all + TotalTime_all[i];
// }

// let SumInputTime_all = 0;
// for (i = 0; i < InputTime_all.length; i++) {
//     SumInputTime_all = SumInputTime_all + InputTime_all[i];
// }


// let SumOutputTime_all = 0;
// for (i = 0; i < OutputTime_all.length; i++) {
//     SumOutputTime_all = SumOutputTime_all + OutputTime_all[i];
// }
// let OIR = Math.round((SumOutputTime_all / SumInputTime_all) * 10 * 10) / 10 / 10;

// let averagetime_all = SumTime_all / TotalTime_all.length;
// let Sumtime_all_list = TotalTime(SumTime_all);
// let averagetime_all_list = TotalTime(averagetime_all);
// $("#sum_all").text(`${Sumtime_all_list[0]} 時間${Sumtime_all_list[1]} 分${Sumtime_all_list[2]} 秒`);
// $("#average_all").text(`${averagetime_all_list[0]} 時間${averagetime_all_list[1]} 分${averagetime_all_list[2]} 秒`);
// $("#OIR").text(`${OIR}`)
// $("#continus_days").text(`${StudyTable.length}日`);

// //グラフ直下のミリ秒→時/分/秒への変換
// $("#TimeConvert").on('input', function () {
//     let milliSecondRecord = Number($(this).val())
//     console.log(milliSecondRecord);
//     let TimeRecord = TotalTime(milliSecondRecord)
//     $("#RecordHour").text(TimeRecord[0]);
//     $("#RecordMinute").text(TimeRecord[1]);
//     $("#RecordSecond").text(TimeRecord[2]);
// });

// function hankaku2Zenkaku(str) {
//     return str.replace(/[０-９]/g, function (s) {
//         return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
//     });
// }

// $("#CallNoteDate").on("click", function () {
//     CallDate = $("#NoteDate").val();
//     const CallRow = JSON.parse(localStorage.getItem(CallDate));
//     if (CallRow === null) {
//         alert("該当する日付のデータは存在しません")
//     } else {
//         alert("データを呼び出しました")
//     };
//     const TotalStudyTime = CallRow["data1"];
//     const Contents = CallRow["data4"];
//     const Thoughts = CallRow["data5"];
//     const TotalStudyTimelist = TotalTime(TotalStudyTime);
//     let Month = String(Number(CallDate.split("/")[1]));
//     let Day = String(Number(CallDate.split("/")[2]));
//     Month = Month.replace(/[0-9]/g,
//         function (s) {
//             return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
//         }
//     );
//     Day = Day.replace(/[0-9]/g,
//         function (s) {
//             return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
//         }
//     );
//     $("#NoteTitle").val(`【${Month}月${Day}日　学習記録】`);
//     $("#NoteContent").val(`学習時間：${TotalStudyTimelist[0]}時間${TotalStudyTimelist[1]}分${TotalStudyTimelist[2]}秒\n\n学習内容：${Contents}\n\n感想：${Thoughts}`);
// });

// $("#NoteClear").on("click", function () {
//     $("#NoteDate").val("");
//     $("#NoteTitle").val("");
//     $("#NoteContent").val("");
// });