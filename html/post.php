<?php
$title = $_POST['title'];
$post_content = $_POST['post_content'];

// データベースへの接続
require("dbconnect.php");

// データベースにページを保存
try{
    $sql = "INSERT INTO posts(title, post_content, c_time) VALUES(:title, :post_content, now())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('title', $title, PDO::PARAM_STR);
    $stmt->bindValue('post_content', $post_content, PDO::PARAM_STR);
    $stmt->execute();
    // 登録完了の通知
    $msg = '記事の投稿が完了しました';
    $link = '<a href="index.php">ホームに戻る</a>';
} catch (PDOException $e) {
    $msg = $e->getMessage();
}
?>

<h1><?php echo $msg; ?></h1>
<p><?php echo $link; ?></p>
