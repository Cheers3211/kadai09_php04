<?php
// select.phpから送られてくるidを$id変数にいれる
$id = $_GET['id'];

try {
    $db_name = '';
    $db_host = '';
    $db_id = '';
    $db_pw = '';

    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

// データ取得
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div><a href="select.php">データ一覧</a></div>
    </nav>
</header>

<form method="POST" action="update.php">
    <fieldset>
        <legend>ブックマーク更新</legend>
        <label>書籍名：<input type="text" name="title" value="<?= htmlspecialchars($result['title'], ENT_QUOTES) ?>"></label><br>
        <label>書籍URL：<input type="text" name="url" value="<?= htmlspecialchars($result['url'], ENT_QUOTES) ?>"></label><br>
        <label>書籍コメント：<textarea name="comment" rows="4" cols="40"><?= htmlspecialchars($result['comment'], ENT_QUOTES) ?></textarea></label><br>
        <p>登録日時：<?= htmlspecialchars($result['indate'], ENT_QUOTES) ?></p>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
        <input type="submit" value="更新">
    </fieldset>
</form>
</body>
</html>
