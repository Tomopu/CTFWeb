<?php
$dsn = "mysql:host=mydb; dbname=user_table; charset=utf8";
$username = "phpadmin";
$password = "hogehoge";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}
?>
