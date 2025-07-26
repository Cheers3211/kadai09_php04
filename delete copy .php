<?php
$id = $_GET['id'];
sschk(); // ←これでログイン必須にする
// DB接続
try {

    $db_name = 'midfan_php10';
    $db_host = 'mysql3108.db.sakura.ne.jp';
    $db_id = 'midfan_php10';
    $db_pw = 'xYdsyk-dogkas-4raxvi';

    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// データ削除SQL
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 実行後
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: select.php');
    exit();
}
?>
