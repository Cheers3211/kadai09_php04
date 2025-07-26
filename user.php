<?php
sschk()

try {
    $pdo = new PDO('mysql:dbname=midfan_php10;charset=utf8;host=mysql3108.db.sakura.ne.jp','midfan_php10','あなたのパスワード');
} catch (PDOException $e) {
    exit('DBConnectionError:'.$e->getMessage());
}

$stmt = $pdo->prepare('SELECT * FROM user_table');
$status = $stmt->execute();

$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<p>';
        $view .= h($result['id']) . ' : ' . h($result['name']) . ' / ' . h($result['lid']);
        $view .= '</p>';
    }
}

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー一覧</title>
</head>
<body>
    <h1>ユーザー一覧</h1>
    <div><?= $view ?></div>
</body>
</html>
