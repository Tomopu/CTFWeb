<?php
session_start();
$userid = $_SESSION['userid'];
if(isset($_SESSION['userid'])) { 
    $msg = 'こんにちは' . htmlspecialchars($userid, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
}else{
    $msg = 'ログインしていません。';
    $link = '<a href="login_form.php">ログイン</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
