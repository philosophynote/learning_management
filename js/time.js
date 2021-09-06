$("#inputTime,#outputTime").on('input', function () {
    //入力されたインプット時間とアウトプット時間をミリ秒に変換する
    const inputTime = $("#inputTime").val() 
    const outputTime = $("#outputTime").val();
    //console.log(inputTime);

    let [input_hour, input_minute] = inputTime.split(':')
    let [output_hour, output_minute] = outputTime.split(':')
    let totalhour = Number(input_hour) + Number(output_hour);
    let totalminute = Number(input_minute) + Number(output_minute);
    if (totalminute > 59){
        totalhour+=1;
        totalminute = totalminute%60;
    }
    $("#totalHour").text(totalhour);
    $("#totalMinute").text(totalminute);
});

