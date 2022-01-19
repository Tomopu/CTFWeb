<?php
$userid = $_POST['userid'];
$passwd = $_POST['passwd'];
// データベースの設定
$dsn = "mysql:host=localhost; dbname=hogehoge, charset=utf8";
$username = "hogehoge";
$password = "hogehoge";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

// USER IDがすでに登録されていないかの確認
$sql = "SELECT * FROM users WHERE userid = :userid";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->execute();
$member = $stmt->fetch();
if($member['mail'] === $mail){
    $msg = '同じUSER IDが存在します。';
    $link = '<a href="signup.php>戻る</a>';
} else {
    // 同じIDがなければ登録
    $sql = "INSERT INTO users(userid, passwd) VALUES (:userid, :passwd)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindValue(':passwd', $passwd, PDO::PARAM_STR);
    $msg = '完飲登録が完了しました';
    $link = '<a href="login.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>


