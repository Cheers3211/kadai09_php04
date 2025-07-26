
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


function sschk(){
    session_start(); // セッションスタート、最初に必要！
    if (
        !isset($_SESSION["chk_ssid"]) ||  // セッションIDが存在しない or
        $_SESSION["chk_ssid"] !== session_id() // 現在のセッションIDと一致しない
    ) {
        exit("LOGIN ERROR");
    } else {
        session_regenerate_id(true); // セッションハイジャック対策（ID再生成）
        $_SESSION["chk_ssid"] = session_id(); // 現在のセッションIDを格納
    }
}

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

require_once('funcs.php');   // funcs.phpにsschk()が入ってる前提




$pdo = db_conn(); // DB接続

// データ取得
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
$status = $stmt->execute();

$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= '<a href="detail.php?id='.$result['id'].'">';
        $view .= $result['id'].' : '.$result['indate'].' : '.$result['title'];
        $view .= '</a>';
        $view .= '<a href="delete.php?id='.$result['id'].'">[削除]</a>';
        $view .= '</p>';
    }
}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブックマーク一覧（ログイン中）</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">データ登録</a> |
            <a href="logout.php">ログアウト</a>
        </nav>
    </header>
    <div>
        <?= $view ?>
    </div>
</body>
</html>
