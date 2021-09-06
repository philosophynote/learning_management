let start_flag = false;
let intervalid;
let to_timeup = 0; 
let backstart = 0; 
let audio = document.createElement('audio');
let input_submit = document.querySelector("input[type=submit]");
audio.id = 'sound';
audio.src = '../media/timer.mp3';



function set_timer(){
    let input_hour = document.querySelector("input[name=timerHour]");
    let input_minute = document.querySelector("input[name=timerMinute]");
    let input_second = document.querySelector("input[name=timerSecond]");
    to_timeup = Number(input_hour.value) * 3600000 + Number(input_minute.value) * 60000 + Number(input_second.value) * 1000;
    console.log(to_timeup);
    return to_timeup;
}

function count_start() {
    if (start_flag === false) {
        intervalid = setInterval(count_down, 1000); //50ミリ秒ごとにcountdown処理を行う -->
        console.log(intervalid); //記録(ID)をとる
        start_flag = true;
    }
};

function count_down() {
    if (to_timeup === 0) {
        audio.play();
        $('#timer').html('Time up!');
        $('#timer').addClass('text-danger');
        count_stop();
        // audio.pause();
        // audio.currentTime = 0;
    } else {
        to_timeup = to_timeup - 1000; //秒数を1ずつ減らす
        padding();
    }
}

function count_stop() {

    clearInterval(intervalid);
    start_flag = false;
}

function count_reset() {
    to_timeup = backstart;
    padding();
    // timer.style.color="black"; 
    $('#timer').removeClass('text-danger');
    clearInterval(intervalid);
    start_flag = false;
}

function padding() { //残り時間をミリ秒から秒に変換し、画面に表示する関数
    var hour = 0;
    var min = 0;
    var sec = 0;
    var timer = document.getElementById("timer");
    hour = Math.floor(to_timeup / 1000 / 60 / 60) % 24;
    min = Math.floor(to_timeup / 1000 / 60) % 60;
    sec = Math.floor(to_timeup / 1000) % 60;

    hour = ('0' + hour).slice(-2);
    min = ('0' + min).slice(-2);
    sec = ('0' + sec).slice(-2);
    timer.innerHTML = hour + ':' + min + ':' + sec;
};



$("#timerset").on('click', function () {
    set_timer()
    padding()
});

$("#timerstart").on('click', function () {
    count_start()
});

$("#timerstop").on('click', function () {
    count_stop()
    audio.pause()
    audio.currentTime = 0;
});

$("#timerreset").on('click', function () {
    count_reset()
});
