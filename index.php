<?php
require_once('funcs.php');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div>
                <div><a href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="insert.php">
        <div>
            <fieldset>
                <legend>ブックマーク登録</legend>
                <label>書籍名：<input type="text" name="title"></label><br>
                <label>書籍URL：<input type="text" name="url"></label><br>
                <label>書籍コメント：<input type="text" name="comment"></label><br>
                <label>登録日時：<input type="text" name="indate"></label><br>
                <label><textarea name="comment" rows="4" cols="40"></textarea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>
