
<?php
// DB接続関数
function db_conn() {
    try {
        $db_name = '';
        $db_host = '';
        $db_id = '';
        $db_pw = '';



        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DBConnectionError:'.$e->getMessage());
    }
}

// ログインチェック関数
function sschk(){
    session_start();
    if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
        exit("LOGIN ERROR");
    } else {
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit('SQLError:'.$error[2]);
}

?>
