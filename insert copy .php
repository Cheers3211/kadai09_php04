<?php
session_start();
require_once('funcs.php');
sschk()；


ini_set('display_errors', 1);
error_reporting(E_ALL);

$title = $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];
function db_conn() {
try {


    $db_name = '';
    $db_host = '';
    $db_id = '';
    $db_pw = '';


    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DBConnectionError:' . $e->getMessage());
}

$stmt = $pdo->prepare('INSERT INTO gs_bm_table(title, url, comment)
                       VALUES(:title, :url, :comment)');
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    echo "登録成功！";
}
?>
