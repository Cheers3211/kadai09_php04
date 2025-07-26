<?php
sschk(); // ←これでログイン必須にする
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
<?php

//1. POSTデータ取得
$title   = $_POST['title'];
$url  = $_POST['url'];
$comment = $_POST['comment'];

//2. DB接続します
//*** function化する！  *****************
try {

    $db_name = '';
    $db_host = '';
    $db_id = '';
    $db_pw = '';
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//３．データ登録SQL作成

$stmt = $pdo->prepare('UPDATE ge_an_table SET
title = :title,
url = :url,
comment = :comment
WHERE id =:id;
');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR


$stmt->bindValue(':title', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $email, PDO::PARAM_STR);
$stmt->bindValue(':comment', $content, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: index.php');
    exit();
}
