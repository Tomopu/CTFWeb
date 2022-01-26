<?php
session_start();
$userid = $_POST['userid'];
//　データベースへの接続
require("dbconnect.php");

$sql = "SELECT * FROM users WHERE userid = :userid";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':userid', $userid, PDO::PARAM_STR);
$stmt->execute();
$member = $stmt->fetch();

// if(password_verify($_POST['passwd'], $member['passwd'])) {
if($_POST['passwd'] == $member['passwd']){
    $_SESSION['userid'] = $member['userid'];
    header('Location:index.php');
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    header('Location:login_form.php?msg='. $msg);
    exit();
}
?>

<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
