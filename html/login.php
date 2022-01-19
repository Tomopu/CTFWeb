<?php
session_start();
$userid = $_POST['userid'];
$dsn = "mysql:host=localhost; dbname=hogehoge; charset=utf8";
$username = "hogehoge";
$password = "hogehoge";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM users WHERE userid = :userid";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->execute();
$member = $stmt->fetch();

if(password_verify($_POST['passwd'], $member['passwd'])) {
    $_SESSION['userid'] = $member['userid'];
    $msg = 'ログインしました。';
    $link = '<a href="index.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="login.php">戻る</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>