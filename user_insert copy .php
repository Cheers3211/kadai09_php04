<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// POSTデータの受け取り
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

// DB接続
try {
    $db_name = '';
        $db_host = '';
        $db_id = '';
        $db_pw = '';
    $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DBConnectionError: ' . $e->getMessage());
}

// SQL作成
$sql = 'INSERT INTO user_table(name, lid, lpw) VALUES(:name, :lid, :lpw)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); // ★暗号化は後で対応もOK
$status = $stmt->execute();
$lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT);


// 登録結果を表示
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError: ' . print_r($error, true));
} else {
    echo <<<EOT
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録完了</title>
    <style>
        body {
            background-color: #fce4ec;
            font-family: sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #c2185b;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #c2185b;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #ad1457;
        }
    </style>
</head>
<body>
    <h1>🎉 登録が完了しました！</h1>
    <p>ログイン画面へ進んでください。</p>
    <a href="login.php">ログインページへ</a>
</body>
</html>
EOT;
}
?>
