<?php
$userid = $_POST['userid'];
$passwd = $_POST['passwd'];
// データベースへの接続
require("dbconnect.php");

// USER IDがすでに登録されていないかの確認
$sql = "SELECT * FROM users WHERE userid = :userid";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->execute();
$member = $stmt->fetch();
if($member['userid'] === $userid){
    $msg = '同じUSER IDが存在します。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    // 同じIDがなければ登録
    $sql = "INSERT INTO users VALUES(:userid, :passwd)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindValue(':passwd', $passwd, PDO::PARAM_STR);
    $stmt->execute();
    $msg = '会員登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
}
?>

<h1><?php echo $msg; ?></h1>
<p><?php echo $link; ?></p>


