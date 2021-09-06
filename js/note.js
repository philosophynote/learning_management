function hankaku2Zenkaku(str) {
    return str.replace(/[０-９]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}

$("#CallNoteDate").on("click", function () {
    CallDate = $("#NoteDate").val();
    const CallRow = JSON.parse(localStorage.getItem(CallDate));
    if (CallRow === null) {
        alert("該当する日付のデータは存在しません")
    } else {
        alert("データを呼び出しました")
    };
    const TotalStudyTime = CallRow["data1"];
    const Contents = CallRow["data4"];
    const Thoughts = CallRow["data5"];
    const TotalStudyTimelist = TotalTime(TotalStudyTime);
    let Month = String(Number(CallDate.split("/")[1]));
    let Day = String(Number(CallDate.split("/")[2]));
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
    $("#NoteContent").val(`学習時間：${TotalStudyTimelist[0]}時間${TotalStudyTimelist[1]}分${TotalStudyTimelist[2]}秒\n\n学習内容：${Contents}\n\n感想：${Thoughts}`);
});

$("#NoteClear").on("click", function () {
    $("#NoteDate").val("");
    $("#NoteTitle").val("");
    $("#NoteContent").val("");
});