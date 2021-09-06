<?php
include("funcs.php");
$userid = $_SESSION['user_id'];
$date = $_POST["date"];

$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM learn_tb JOIN user_table ON learn_tb.User_id = user_table.user_id WHERE learn_tb.User_id={$userid} AND learn_tb.User_id={$date}");
$status = $stmt->execute();


?>