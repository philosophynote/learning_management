(function () {
    'use strict';

    //htmlのidからデータを取得
    //取得したデータを変数に代入

    // let timer = $('#timer').text();
    let start = $('#start').text();
    let stop = $('#stop').text();
    let reset = $('reset').text();

    //クリック時の時間を保持するための変数定義
    let startTime;

    //経過時刻を更新するための変数。 初めはだから0で初期化
    let elapsedTime = 0;

    //タイマーを止めるにはclearTimeoutを使う必要があり、そのためにはclearTimeoutの引数に渡すためのタイマーのidが必要
    let timerId;

    //タイマーをストップ -> 再開させたら0になってしまうのを避けるための変数。
    let timeToadd = 0;


    //ミリ秒の表示ではなく、分とか秒に直すための関数, 他のところからも呼び出すので別関数として作る
    //1minute = 60000ms
    //1hour = 60minutes = 3600000ms
    //文字列の末尾2桁を表示したいのでsliceで負の値(-2)引数で渡してやる。
    function updateTimetText() {

        //h(時間) = 360000ミリ秒で割った数の商
        const hour = Math.floor(elapsedTime / 3600000);
        const hh = ('0' + hour).slice(-2);
        //m(分) = 135200 / 60000ミリ秒で割った数の商　
        const minute = Math.floor((elapsedTime % 3600000 / 60000));
        const mm = ('0' + minute).slice(-2);
        //s(秒) = 1second = 1000ミリ秒
        const second = Math.floor(elapsedTime % 60000 / 1000);
        const ss = ('0' + second).slice(-2);
        //HTMLのid　timer部分に表示させる　
        $('#stopwatch').text(hh + ':' + mm + ':' + ss);
    }


    //再帰的に使える用の関数
    function countUp() {

        //timerId変数はsetTimeoutの返り値になるので代入する
        timerId = setTimeout(function () {

            //経過時刻は現在時刻をミリ秒で示すDate.now()からstartを押した時の時刻(startTime)を引く
            elapsedTime = Date.now() - startTime + timeToadd;
            updateTimetText()

            //countUp関数自身を呼ぶことで10ミリ秒毎に以下の計算を始める
            countUp();

            //1秒以下の時間を表示するために10ミリ秒後に始めるよう宣言
        }, 1000);
    }

    //startボタンにクリック時のイベントを追加(タイマースタートイベント)
    $("#watchstart").on('click', function () {

        //在時刻を示すDate.nowを代入
        startTime = Date.now();
        console.log(startTime);
        //再帰的に使えるように関数を作る
        countUp();
    });

    //stopボタンにクリック時のイベントを追加(タイマーストップイベント)
    $("#watchstop").on('click', function () {

        //タイマーを止めるにはclearTimeoutを使う必要があり、そのためにはclearTimeoutの引数に渡すためのタイマーのidが必要
        clearTimeout(timerId);


        //タイマーに表示される時間elapsedTimeが現在時刻かたスタートボタンを押した時刻を引いたものなので、
        //タイマーを再開させたら0になってしまう。elapsedTime = Date.now - startTime
        //それを回避するためには過去のスタート時間からストップ時間までの経過時間を足してあげなければならない。elapsedTime = Date.now - startTime + timeToadd (timeToadd = ストップを押した時刻(Date.now)から直近のスタート時刻(startTime)を引く)
        timeToadd += Date.now() - startTime;
    });

    //resetボタンにクリック時のイベントを追加(タイマーリセットイベント)
    $("#watchreset").on('click', function () {

        //経過時刻を更新するための変数elapsedTimeを0にしてあげつつ、updateTimetTextで0になったタイムを表示。
        elapsedTime = 0;

        //リセット時に0に初期化したいのでリセットを押した際に0を代入してあげる
        timeToadd = 0;

        //updateTimetTextで0になったタイムを表示
        updateTimetText();

    });
})();