<?php
session_start();
// データベースへの接続
require("dbconnect.php");

// データベースからデータを取得
try{
    $sql = "SELECT id, title, c_time FROM posts";
    $stmt = $dbh->query($sql);
    $article_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}
?>

<h1>トピックを削除</h1>

<?php
echo $_SESSION['userid'];

if(isset($_SESSION['userid'])) { 
?>
<p>削除したいと投稿のIDを入力してください。</p>
<form action="delete_article.php" method="post">
    <div>
        <label>ID: </label>
        <input type="text" name="id" required>
    </div>
    <input type="submit" value="submit">
</form>
<table>
    <tr>
        <td>ID</td><td>Title</td><td>Create time</td>
    </tr>
<?php
foreach($article_list as $row){
    echo '<tr>';
    echo '<td>'. htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'). '</td>';
    echo '<td>'. htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'). '</td>';
    echo '<td>'. htmlspecialchars($row['c_time'], ENT_QUOTES, 'UTF-8'). '</td>';
    echo '</tr>';
}
?>
</table>
<?php
}else{
?>
<p>あなたはログインしていません。<br>投稿を削除するには、ログインしてください。</p>
<?php
}
?>
<p><a href="index.php">戻る</a></p>