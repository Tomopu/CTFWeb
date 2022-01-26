<?php
$id = $_POST['id'];

// データベースへの接続
require("dbconnect.php");

// テーブルから削除
try{
    $sql = "DELETE FROM posts WHERE id = :id;";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('id', $id, PDO::PARAM_INT);
    $stmt->execute();
    // 削除後リダイレクト
    header('Location:index.php');
} catch (PDOException $e) {
    $msg = $e->getMessage();
}
?>

<h1><?php echo $msg; ?></h1>