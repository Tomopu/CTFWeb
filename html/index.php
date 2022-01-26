<?php
session_start();
$userid = $_SESSION['userid'];
// データベースへの接続
require("dbconnect.php");

$del_art = null;
if(isset($_SESSION['userid'])) { 
    $msg = 'こんにちは' . htmlspecialchars($userid, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
    $cre_art = '<a href="post_form.php">トピックを追加</a>';
    $del_art = '<a href="delete_article_form.php">トピックを削除</a>';
}else{
    $msg = 'ログインしていません。';
    $link = '<a href="login_form.php">ログイン</a>';
}
$sql = "SELECT * FROM users";
$stmt = $dbh->query($sql);
$content = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT title, post_content FROM posts";
$stmt = $dbh->query($sql);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, maximum-scale=2">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/base.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.6/marked.js"></script>
    <title>CTFweb</title>
</head>
<body>
    <header id="header" class="DownMove">
        <h1 id="header_logo"><a href="/">CTFWEB</a></h1>
        <nav id="pc_navi">
           <ul>
              <li><?php echo $msg; ?></li>
              <li><?php echo $link; ?></a></li>
           </ul>
        </nav>
    </header>

    <div id="main_visual">
        <div id="main_title">
        </div>
    </div>
    
    <div id="wrapper">
        
        <?php
        if(isset($cre_art)){
            print_r($cre_art."\n");
        }
        if(isset($del_art)){
            print_r($del_art."\n");
        }
        ?>
        <?php
        foreach($articles as $row){
            echo '<div class="topic_box">';
            echo '<p class="topic_title" style="color:blue; font-size:25px; padding-bottom: 10px">';
            echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
            echo '</p>';
            echo '<div id="content"></div>';
            echo htmlspecialchars($row['post_content'], ENT_QUOTES, 'UTF-8');
            echo '</div>';
        }
        ?>
    </div>
</body>

<script src="js/headerNavi.js"></script>
</html>
