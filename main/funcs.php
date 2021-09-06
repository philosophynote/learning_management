<?php

ini_set( "display_errors", On );
error_reporting( E_ALL );

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        $db_name = $_SERVER['SERVER_NAME'] == "localhost" ? "learn_management" : $_ENV['db_name'];    //データベース名
        $db_id   = $_SERVER['SERVER_NAME'] == "localhost" ? "root" : $_ENV['db_id'];      //アカウント名
        $db_pw   = $_SERVER['SERVER_NAME'] == "localhost" ? "root" : $_ENV['db_pw'];      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = $_SERVER['SERVER_NAME'] == "localhost" ? "localhost" : $_ENV['db_host']; //DBホスト

        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    }catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}





//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();//$stmtの中にエラーLOGが残っているので引数で貰う
    exit("SQLError:".$error[2]);
}



//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

function verd($s){
    echo "<pre>";
    var_dump($s);
    echo "</pre>";
}
?>



